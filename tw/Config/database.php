<?php
$seaver_name = $_SERVER['SERVER_NAME'];
if($seaver_name === "localhost"){// ローカルドメイン
	$dbInfo = array(
		'name'     => 'tw',
		'host'     => 'localhost',
		'user'     => 'root',
		'password' => 'root'
	);
}
else {//	グローバルドメイン
	$dbInfo = array(
		'name'     => '',
		'host'     => '',
		'user'     => '',
		'password' => ''
	);
}
