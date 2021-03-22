<?php include("templates/page_header.php");?>
<?php include("lib/auth.php") ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$aid = $_GET['aid'];	
	
	$result=get_article($dbconn, $aid);

	$row = pg_fetch_array($result, 0);
	
	if ($_SESSION['role'] !== 'admin' && $_SESSION['username'] !==  $row['author']) {
		error_log("Wrong role! You must be admin. ");
		error_log("Redirect: Location: /admin.php");
		header("Location: /admin.php");
		die();
	}
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and $_SESSION['token'] == $_POST['token']) {

	$title = $_POST['title'];
	$content = $_POST['content'];
	$aid = urldecode($_POST['aid']);
	$result=update_article($dbconn, $title, $content, $aid);
	error_log("Editing article $aid by user {$_SESSION['id']}: ");
	Header ("Location: /");
}
?>

<!doctype html>
<html lang="en">
<head>
	<title>New Post</title>
	<?php include("templates/header.php"); ?>
</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

<h2>New Post</h2>

<form action='#' method='POST'>
	<input type="hidden" value="<?php echo urlencode($aid) ?>" name="aid">
	<input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
	<div class="form-group">
	<label for="inputTitle" class="sr-only">Post Title</label>
	<input type="text" id="inputTitle" required autofocus name='title' value="<?php echo $row['title'] ?>">
	</div>
	<div class="form-group">
	<label for="inputContent" class="sr-only">Post Content</label>
	<textarea name='content' id="inputContent"><?php echo $row['content'] ?></textarea>
	</div>
	<input type="submit" value="Update" name="submit" class="btn btn-primary">
</form>
<br>

	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
