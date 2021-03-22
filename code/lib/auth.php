<?php
if (!$_SESSION['authenticated']) {
	error_log("Redirect: Location: /login.php!");
	// exit;
	header ("Location: /login.php");
	die();
}
?>
