<?php
class AppModel {
	public $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function query() {
		$args = func_get_args();
		$evalStr = '$result = $this->db->query($args[0]';
		for ($i = 1 ; $i < count($args); $i++) {
			$evalStr .= ', $args[' . $i . ']';
		}
		$evalStr .= ');';
		eval($evalStr);//	実行

		return $result ? $this->db->fetch_all($result) : array();
	}

	public function count() {
		return $this->db->affected_rows();
	}

	public function id() {
		return $this->db->insert_id();
	}
}
