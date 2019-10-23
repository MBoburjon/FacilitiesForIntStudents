<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
	if(isset($_GET["id"])){
		$SearchIdFromUrl = $_GET["id"];
		global $ConnectingDB;

		$sql = "DELETE FROM category WHERE id='$SearchIdFromUrl'";
		
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$_SESSION["SuccessMessage"] = "Category Deleted Successfully ! ";
			Redirect_to("Categories.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try again !";
			Redirect_to("Categories.php");
			
		}
	}
?>
