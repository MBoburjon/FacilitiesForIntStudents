<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 

	$_SESSION["UserId"] = null;
	$_SESSION["UserName"] = null;
	session_destroy();
	
	Redirect_to("Login.php");
	
	

?>