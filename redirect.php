<?php
require_once "form.php";
if(isset($_GET['code'])){
	$s = new Url;
	$c = $_GET['code'];
	if($url = $s->getUrl($c)){
		header("Location: {$url}");
		die();
	}
	header("Location: index.php");
}
?>
