<?
session_start();
error_log("Logging out for user {$_SESSION['id']}");
session_unset();
session_destroy();

header("Location: /");
exit();
?>
