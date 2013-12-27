<?php
header('Content-Type: text/html; charset=Shift_JIS');
ob_start();

$data = file_get_contents("data.prn");
$array = explode("\n", $data);
$len = count($array);
for ($i = 0; $i < $len; $i++) {
	file_put_contents(sprintf("./data/data%d.txt", $i), $array[$i]);
}
echo "保存作業が終了でしました。";

$output = ob_get_contents();
ob_end_clean();
echo mb_convert_encoding($output, "SJIS", "UTF-8");
