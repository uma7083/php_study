<h1>ログイン</h1>
<form action = "./?controller=Login&method=judge" method = "post" onsubmit = "return autoFormCheck(this);">
	<p>ユーザー名:<br>
		<input type = "text" name = "user_name" pattern = "^[a-zA-Z\d_-]{4,16}$" size = "16" maxlength = "16"/>
	</p>
	<p>パスワード: <br>
		<input type = "password" name = "password" pattern = "^[a-zA-Z\d_-]{4,16}$" size = "16" maxlength = "16"/>
	</p>
	<input type = "submit" value="送信する"/>
	<input type = "reset" value="リセット"/>
</form>

<h1>新規ユーザー登録</h1>
<form action = "./?controller=Login&method=upload" method = "post" onsubmit = "return autoFormCheck(this);">
	<p>登録ユーザー名:<br>
		<input type = "text" name = "user_name" pattern = "^[a-zA-Z\d_-]{4,16}$" size = "16" maxlength = "16"/>
	</p>
	<p>パスワード:<br>
		<input type = "password" name = "password1" pattern = "^[a-zA-Z\d_-]{4,16}$" size = "16" maxlength = "16"/>
	</p>
	<p>パスワード(確認):<br>
		<input type = "password" name = "password2" pattern = "^[a-zA-Z\d_-]{4,16}$" data-equal-check = "true" size = "16" maxlength = "16"/>
	</p>
	<input type = "submit" value="送信する"/>
	<input type = "reset" value="リセット"/>
</form>
