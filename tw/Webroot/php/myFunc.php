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
