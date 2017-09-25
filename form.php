<?php  
	require_once "data.php";
	class Url 
	{
		protected $datab;
		function __construct()
		{
			$this->datab = new MySQLi(HOST, USER, PASSWORD,DATABASE);
		}

		protected function genCode($n) {
			return base_convert($n * rand(1,100), 10, 36);
		}

		public function make($url) {
			$url = trim($url);

			if(!filter_var($url, FILTER_VALIDATE_URL)) {
				return "";
			}
			$url = $this->datab->escape_string($url);

			$ex = $this->datab->query("SELECT code FROM links WHERE url = '{$url}'");

			if($ex->num_rows) {
				return $ex->fetch_object()->code;
			} else {
				$this->datab->query("INSERT INTO links (url, created) VALUES ('{$url}', NOW())");
				$c = $this->genCode($this->datab->insert_id);

				$this->datab->query("UPDATE links SET code = '{$c}' WHERE url = '{$url}'");

				return $c;
			}
		}

		public function getUrl($c) {
			$c = $this->datab->escape_string($c);
			$c = $this->datab->query("SELECT url FROM links WHERE code = '$c'");

			if($c->num_rows) {
				return $c->fetch_object()->url;
			}
			return '';
		}
	}
?>