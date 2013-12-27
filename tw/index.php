<!DOCTYPE html>
<?php
	session_start();//			セッション開始
	if (!isset($_GET['controller'])) {
		echo "localhost/tmp?controller=****";
		exit(1);
	}
	$contName = $_GET['controller'];
	if (!isset($_GET['method'])) {
		echo "localhost/tmp?method=****";
		exit(1);
	}
	$methodName = $_GET['method'];
?>

<html lang = 'ja'>
	<head>
		<meta charset = 'UTF-8'>
		<script src = "./Webroot/js/jquery-2.0.2.min.js"></script>
		<script src = "./Webroot/js/form.js"></script>
		<title><?php echo $title ?></title>
	</head>

	<body>
<style>
body {
	background-image: url("./Webroot/img/back.gif")
}
</style>
<img src = "./Webroot/img/droid.png" width = "128px" height = "128px"/>
<br>

<?php
	//	必要なファイル準備
	include('./Config/database.php');
	
	//	TODO	ファイルの存在判定の追加
	//	コントローラー
	include('./Controller/AppController.php');
	include('./Controller/'.$contName.'Controller.php');
	eval('$main = new ' . $contName . 'Controller();');

	//	モデル
	include('./Model/AppModel.php');
	foreach($main->tables as $value) {
		include('./Model/' . $value . 'Model.php');
	}
	$main->connectDB($dbInfo);
	//	メソッド実行
	$main->beforeFilter();
	eval('$main->' . $methodName . '();');
	$main->closeDB();

	//	ビュー
	include('./View/' . $contName . '/' . $methodName . '.php');
?>
<br>
<img src = "./Webroot/img/droid.png" width = "128px" height = "128px"/>
<br>
<i>Portions of this page are reproduced from work created and shared by Google and used according to terms described in the Creative Commons 3.0 Attribution License. </i>
	</body>
</html>
