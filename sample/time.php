<?php
header('Content-Type: text/html; charset=Shift_JIS');

ob_start();

function measure() { 
	list($m, $s) = explode(' ', microtime()); 
	return ((float)$m + (float)$s); 
}

$start = measure();
//	測定処理開始
$summary = 0;
for ($i = 0; $i < 20000000; $i++) {
	$summary += $i;
	if ($summary > 100000) $summary = 0;
}
$end = measure();
//	測定処理終了
echo ($end - $start).PHP_EOL;
echo $summary;

$output = ob_get_contents();
ob_end_clean();
echo mb_convert_encoding($output, "SJIS", "UTF-8");
