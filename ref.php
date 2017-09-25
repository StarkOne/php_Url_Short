<?php 
	session_start();
	require_once "form.php";
	$v = new Url();
	if(isset($_POST['url'])){
		$urlN = $_POST['url'];
		if($a = $v->make($urlN)) {
			$_SESSION['feedback'] = "Ваша ссылка: http://phpurl.local/{$a}";
			echo $_SESSION['feedback'];
		} else {
			$_SESSION['feedback'] = "Error";
		}
	}
?>