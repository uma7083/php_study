<?php
	header('Content-Type: text/plain; charset=Shift_JIS');
	ob_start();

	//	$dataが存在する場合はその値、存在しない場合はデフォルト値を代入
	function dVal(&$data, $default = null) {
		return $data = isset($data) ? $data : $default;
	}

	/* argv[0]	practice2.php
	 * argv[1]	数値1
	 * argv[2]	数値2
	 * argv[3]	文字出力形式(ex. %f, %.3f)
	 */	
	$a = dVal($argv[1], 8);
	$b = dVal($argv[2], 5);
	$ans = dVal($argv[3], "%s");

	if ($b == 0) throw new Exception("devide by zero"); 
	$add = $a + $b;
	$sub = $a - $b;
	$mul = $a * $b;
	$div = $a / $b;
	printf("和:".$ans."%s", $add, PHP_EOL);
	printf("差:".$ans."%s", $sub, PHP_EOL);
	printf("積:".$ans."%s", $mul, PHP_EOL);
	printf("商:".$ans."%s", $div, PHP_EOL);

	$output = ob_get_contents();
	ob_end_clean();
	echo mb_convert_encoding($output, "SJIS", "UTF-8");
