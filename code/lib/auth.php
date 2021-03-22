<?php
error_log("message");
if (!$_SESSION['authenticated']) {
	error_log("Redirect!");
	// exit;
	header ("Location: /login.php");
	die();
}
?>
