<?php
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





