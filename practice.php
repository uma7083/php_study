<?php
	header('Content-Type: text/html; charset=Shift_JIS');
	ob_start();

	$output = ob_get_contents();
	ob_end_clean();
	echo mb_convert_encoding($output, "SJIS", "UTF-8");
