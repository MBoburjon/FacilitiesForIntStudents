<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
	if(isset($_GET["id"])){
		$SearchIdFromUrl = $_GET["id"];
		global $ConnectingDB;

		$sql = "DELETE FROM admins WHERE id='$SearchIdFromUrl'";
		
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$_SESSION["SuccessMessage"] = "Admin Deleted Successfully ! ";
			Redirect_to("Admins.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try again !";
			Redirect_to("Admins.php");
			
		}
	}
?>
