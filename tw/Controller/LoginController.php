<?php
class LoginController extends AppController {
	public $tables = array('users');

	public function beforeFilter() {
	}

	public function index() {
	}
	public function login() {
	}
	public function judge() {
		if (!(isset($_POST['user_name']) && isset($_POST['password']))) {
			$this->redirect('Login', 'login');
		}
		$userName = $_POST['user_name'];
		$password = $_POST['password'];

		$loginData = $this->users->query("SELECT * FROM USERS WHERE name = '%s' AND password = '%s';", $userName, $password);

		if (empty($loginData)) {
			$this->error("それは違うよ");
		}
		$userArray = array('id' => $loginData[0][0], 'name' => $userName);
		$_SESSION['user'] = $userArray;
		$this->redirect('Post', 'index');
	}
	public function upload() {
		if (!(isset($_POST['user_name']) && isset($_POST['password1'])&& isset($_POST['password2']))) {
			$this->redirect('Login', 'login');
		}
		$userName = $_POST['user_name'];
		$password = $_POST['password1'];

		$result = $this->users->query("INSERT INTO USERS (name, password) values('%s', '%s');", $userName, $password);
		$count = $this->users->count();
		if ($count == -1) {
			d("ユーザー名が重複しています。");
			$this->redirect('Post', 'index');
		}
		d("登録に成功しました。");
		$userArray = array('id' => $this->users->id, 'name' => $userName);
		$_SESSION['user'] = $userArray;
		$this->redirect('Post', 'index');
	}
	public function logout() {
		unset($_SESSION['user']);
		$this->redirect('Login', 'login');
	}
}





