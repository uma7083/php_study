<?php
	header('Content-Type: text/html; charset=Shift_JIS');
	ob_start();
?>
<?php
	class Person {
		var $firstName;
		var $lastName;

		public function __construct($lastName = "", $firstName = "") {
			$this->setLastName($lastName);
			$this->setFirstName($firstName);
		}

		public function printFirstName($preStr = "名前:") {
			print($preStr . $this->firstName);
		}

		public function printLastName($preStr = "苗字:") {
			print($preStr . $this->lastName);
		}

		public function printLastFirstName($preStr = "苗字と名前:", $midStr = " ") {
			$this->printLastName($preStr);
			$this->printFirstName($midStr);
		}

		public function printFirstLastName($preStr = "名前と苗字:", $midStr = " ") {
			$this->printFirstName($preStr);
			$this->printLastName($midStr);
		}

		public function getFirstName() {
			return $this->firstName;
		}
		public function getLastName() {
			return $this->lastName;
		}
		public function setFirstName($firstName) {
			$this->firstName = $firstName;
		}
		public function setLastName($lastName) {
			$this->lastName = $lastName;
		}
	}

	function println($str = "") {
		print($str . PHP_EOL);
	}
?>
<?php
	$person = new Person("shouhei", "yamaguchi");
	$person->printFirstName();
	println();
	$person->printLastName();
	println();
	$person->printLastFirstName();
	println();
	$person->printFirstLastName();
	println();
?>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	echo mb_convert_encoding($output, "SJIS", "UTF-8");
?>