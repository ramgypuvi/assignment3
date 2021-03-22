<?php 
require_once('templates/page_header.php');
require_once('lib/auth.php');
?>
<?php
$aid = $_GET['aid'];
if ($_GET['token'] == $_SESSION['token']) {
	error_log("Deleting article by user {$_SESSION['id']}: ");
	$result = delete_article($dbconn, $aid);
	#echo "result=".$result."<br>";
	# Check result
	
}
header("Location: /admin.php");	

?>

