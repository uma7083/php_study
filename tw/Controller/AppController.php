<?php
//	素敵なデザインのvar_dump
function d() {
	echo '<pre style="background:#eeeeff;color:#333;border:2px double #ccc;margin:2px;padding:4px;font-family:monospace;font-size:12px">';
	foreach (func_get_args() as $v) var_dump($v);
	echo '</pre>';
}

//	$dataに値がある場合はその値、ない場合はデフォルトの値を代入
function defVal(&$data, $default = null) {
	return $data = isset($data) ? $data : $default;
}

/*

	データベース接続用クラス

*/
class mysqliDB {
	//	プロパティの宣言
	public $name	= null;
	public $host	= null;
	public $user	= null;
	public $pass	= null;

	public $link	= null;
	public $msg		= "";
	public $result	= null;

	public $debug	= false;

	//	コンストラクタ
	public function __construct($array = array()) {
		$this->name	= 'sampledb';
		$this->host	= 'localhost';
		$this->user	= 'root';
		$this->pass	= 'root';

		if (isset($array['name'])) $this->name = $array['name'];
		if (isset($array['host'])) $this->host = $array['host'];
		if (isset($array['user'])) $this->user = $array['user'];
		if (isset($array['pass'])) $this->pass = $array['pass'];

		if (!isset($array['auto']) || $array['auto'] == true) $this->auto_connect();//	自動接続
		if (!isset($array['p']) || $array['p'] == true) $this->name .= 'p:';//			持続的接続
		if (isset($array['sql'])) $this->query($array['sql']);//						クエリー
		if (isset($array['debug'])) $this->debug = $array['debug'];//					デバッグモード

		$this->msg = "データベースクラス生成成功";
		$this->debug_echo();
	}

	//	エラー判定メッセージ
	public function error_check($var = true, $common_msg = "", $ok_msg = "", $error_msg = "") {
		$this->msg = $common_msg.($var ? $ok_msg : $error_msg.mysqli_error($this->link));
		$this->debug_echo();
		return null;
	}

	//	データベース接続
	public function connect() {
		$this->link = mysqli_connect($this->host, $this->user, $this->pass);
		$this->error_check($this->link, "データベース接続", "成功", "失敗");
		return $this->link;
	}
	//	データベース選択
	public function select_db() {
		$db = mysqli_select_db($this->link, $this->name);
		$this->error_check($db, "データベース選択", "成功", "失敗");
		return $db;
	}
	//	データベース文字コード指定
	public function set_charset($charCode = 'utf8') {
		mysqli_set_charset($this->link, $charCode);
		$this->error_check(true, "クエリー文字コード変更成功");
		return true;
	}
	//	クエリー送信
	/*
	public function query($sql) {
		$this->result = mysqli_query($this->link, $sql);
		$this->error_check($this->result, "クエリー送信", "成功", "失敗");
		return $this->result;
	}
	*/
	//	安全なクエリー送信
	public function query() {
		$args = func_get_args();
		$evalStr = '$sql = sprintf($args[0]';
		for ($i = 1 ; $i < count($args); $i++) {
			$evalStr .= ', mysqli_real_escape_string($this->link, $args[' . $i . '])';
		}
		$evalStr .= ');';
		eval($evalStr);//	実行

		$this->result = mysqli_query($this->link, $sql);
		$this->error_check($this->result, "クエリー送信", "成功", "失敗");
		return $this->result;
	}

	//	データベース切断
	public function close() {
		$close = mysqli_close($this->link);
		$this->error_check($close, "データベース切断", "成功", "失敗");
		return $close;
	}

	//	自動接続
	public function auto_connect() {
		if (!$this->connect())		return false;
		if (!$this->select_db())	return false;
		if (!$this->set_charset())	return false;
		$this->error_check(true, "データベース自動接続成功");
		return true;
	}
	//	自動切断
	public function auto_close() {
		if (!$this->close())		return false;
		$this->error_check(true, "データベース自動切断成功");
		return true;
	}

	//	デバッグモード
	public function debug_echo() {
		if ($this->debug) echo $this->get_msg();
		return $this->debug;
	}
	//	メッセージ取得
	public function get_msg() {
		return $this->msg."<br />\n";
	}



	//	レコード取得
	public function fetch_assoc($result = null) {
		defVal($result, $this->result);
		return mysqli_fetch_assoc($result);
	}
	//	全レコード取得
	public function fetch_all($result = null) {
		defVal($result, $this->result);
		return mysqli_fetch_all($result);
	}
	//	レコード数取得
	public function affected_rows() {
		return mysqli_affected_rows($this->link);
	}
	//	レコードid取得
	public function insert_id() {
		return mysqli_insert_id($this->link);
	}
}

class AppController {
	public $db;
	public $dbs;
	public $tables = array();

	public function connectDB($dbInfo) {
		$this->db = new mysqliDB($dbInfo);

		//	先頭を大文字に変換してクラスを生成
		foreach($this->tables as $value) {
			eval('$this->' . $value . ' = new ' . ucfirst($value) . 'Model($this->db);');
		}
	}

	public function closeDB() {
		$this->db->auto_close();
	}

	public function beforeFilter() {
	}

	protected function set($varName, $varContents) {
		//	${$varName}
		$this->$varName = $varContents;
	}

	protected function error($str) {
		echo $str;
		exit();
	}

	protected function redirect($cont, $method) {
		$url = './?controller=' . $cont . '&method=' . $method;
		header('Location: ' . $url);
		exit();
	}


	protected function isLogin() {
		if (!isset($_SESSION['user'])) {
//			$this->error("不正アクセスです。");
			$this->redirect('Login', 'login');
		}
		return true;
	}
}





