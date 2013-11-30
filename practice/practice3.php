<?php
header('Content-Type: text/plain; charset=Shift_JIS');
ob_start();

$cntMax = 51;
for ($i = 1; $i <= $cntMax; $i++)
	echo $i . PHP_EOL;

$output = ob_get_contents();
ob_end_clean();
echo mb_convert_encoding($output, "SJIS", "UTF-8");
