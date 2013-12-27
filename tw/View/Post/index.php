<?php
	echo $main->user['name'] . "さんがログイン中";
	echo "<br>";
	echo "<br>";

	foreach($main->contents as $key => $value) {
		$contents = $value['contents'];
		$created = $value['created'];
		echo "<hr>";
		echo "投稿日時:";
		echo $created;
		echo "だよ";
		echo "<br>";
		echo $contents;
		echo "<hr>";
	}
?>
<form action = "./?controller=Login&method=logout" method = "post">
	<input type = "submit" value = "ログアウト"/>
</form>
<form action = "./?controller=Post&method=upload" method = "post">
	<textarea name = "contents" pattern = ".+" rows = "10" cols = "48"></textarea>
	<br>
	<input type = "submit" value = "送信"/>
	<input type = "reset" value = "リセット"/>
</form>
