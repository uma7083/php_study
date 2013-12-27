/*

	form.js

*/
/*
	自動フォームチェック
	基本構造
	<form actin = "PHPファイルパス" method = "post" onsubmit = "return autoFormCheck(this);">
		<要素>
			<input type = "" name = "" pattern = ""/>
		<要素>
		...
		<要素>
			<input type = "" name = "" pattern = ""/>//	主
		<要素>
		<要素>
			<input type = "" name = "" pattern = "" data-equal-check = "true"/>//	従
		<要素>
		...
		<要素>
			<input type = "" name = "" pattern = ""/>
		<要素>
	</form>
*/
function autoFormCheck(element) {
	var alertMessage = "赤い文字の部分を直してください。";//	警告ダイアログメッセージ
	var result = true;

	$(element).find('input').each(function(i) {
		var patternStr = this.getAttribute('pattern');
		if (patternStr !== null) {//	パターン判定が存在するかどうか
			var pattern = (new Function('return /' + patternStr + '/i'))();//	Object型に変換(正規表現方にするために//追加)
			var value   = this.value;//		値
			if (value === null) {
				this.value = '';
				value = '';
			}
			var parentElement = this.parentNode;//	親element(この場合はinputテキストの内容を示したelement)

//			var equalCheckFlag = (this.getAttribute('data-equal-check') === null) || ($(parentElement).prev().children('input')[0].value === value);//	前値一致確認項目
			//	無駄なやり方なので、解決策模索
			/*
				①for文で回しておけば配列の1コ前にアクセスすれば良い
			*/
			var equalCheckFlag = (this.getAttribute('data-equal-check') === null) || ($(element).find('input')[i - 1].value === value);//	前値一致確認項目
			if (pattern.test(value) && equalCheckFlag) {//	一致
				//	黒・細字
				parentElement.style.color = "black";
				parentElement.style.fontWeight = "normal";
			}
			else {//	不一致
				//	赤・太字
				parentElement.style.color = "red";
				parentElement.style.fontWeight = "bold";
				result = false;
			}
		}
	});
	if (result === false) alert(alertMessage);
	return result;
}
