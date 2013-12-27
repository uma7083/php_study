<?php
class PostController extends AppController {
	public $tables = array('users', 'posts');

	public function beforeFilter() {
		$this->isLogin();
	}

	public function index() {
		$user = $_SESSION['user'];
		$contentsData = $this->users->query("SELECT * FROM POSTS WHERE user_id = %s ORDER BY created DESC;", $user['id']);

		$contents = array();
		foreach ($contentsData as $value) {
			$contents[] = array('contents' => $value[2], 'created' => $value[3]);
		}

		$user = $_SESSION['user'];
		$this->set("user", $user);
		$this->set("contents", $contents);
	}
	public function upload() {
		if (!(isset($_POST['contents']))) {
			$this->redirect('Post', 'index');
		}
		$user = $_SESSION['user'];
		$contents = $_POST['contents'];
		$result = $this->users->query("INSERT INTO POSTS (user_id, contents, created) values(%d, '%s', SYSDATE());", $user['id'], $contents);
		$this->redirect('Post', 'index');
	}
}





