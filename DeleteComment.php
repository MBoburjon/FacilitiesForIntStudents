<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
	if(isset($_GET["id"])){
		$SearchIdFromUrl = $_GET["id"];
		global $ConnectingDB;

		$sql = "DELETE FROM comments WHERE id='$SearchIdFromUrl'";
		
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$_SESSION["SuccessMessage"] = "Comment Deleted Successfully ! ";
			Redirect_to("Comments.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try again !";
			Redirect_to("Comments.php");
			
		}
	}
?>
