<?php
//	昇順
function asc(&$a, &$b) {
	if ($a > $b) {
		swap($a, $b);
	}
}
function desc(&$a, &$b) {
	asc($b, $a);
}

function swap(&$a, &$b) {
	$temp = $a;
	$a = $b;
	$b = $temp;
}

function bubble_sort(&$nums) {
	$len  = count($nums);
	for ($i = 0; $i < $len; $i++) {
		for ($j = $i + 1; $j < $len; $j++) {
			if ($nums[$i] > $nums[$j]) {
				swap($nums[$i], $nums[$j]);
			}
		}
	}
}

//	再帰版バブルソート
function bubble_sort_r(&$nums, $s_index = 1) {
	$e_index = count($nums);
	if ($s_index >= $e_index) return;
	for ($i = $s_index - 1; $i >= 0; $i--) {
		asc($nums[$i], $nums[$i + 1]);//	昇順
//		desc($nums[$i], $nums[$i + 1]);//	降順
	}
	bubble_sort_r($nums, $s_index + 1);
}

function print_array($nums) {
	foreach($nums as $value) {
		echo $value . ' ';
	}
	echo PHP_EOL;
}

function win_start() {
	header('Content-Type: text/plain; charset=Shift_JIS');
	ob_start();
}

function win_end() {
	$output = ob_get_contents();
	ob_end_clean();
	echo mb_convert_encoding($output, "SJIS", "UTF-8");
}


win_start();
$num_array = array(1, 4, 5, 72, 668, -1, 35, 226);
print_array($num_array);
//bubble_sort($num_array);
bubble_sort_r($num_array);
print_array($num_array);
win_end();