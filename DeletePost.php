<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 
	$_SESSION["TrackingUrl"] = $_SERVER["PHP_SELF"];
	confirmLogin(); 
?>
<?php

$IdFromUrl = $_GET["id"];

//Fetching Existing Data of choosen post
$ConnectingDB;

$sql = "SELECT * FROM posts WHERE id='$IdFromUrl'";
$stmt = $ConnectingDB->query($sql);
				
while ($DataRows = $stmt->fetch()) {
	$TitleToBeUpdated = $DataRows["title"];
	$CategoryToBeUpdated = $DataRows["category"];
	$ImageToBeUpdated = $DataRows["image"];
	$PostToBeUpdated = $DataRows["post"];
}
				
	
if(isset($_POST["Submit"])){
		$ConnectingDB;
		$sql = "DELETE FROM posts WHERE id='$IdFromUrl'";
		$Execute = $ConnectingDB->query($sql);
		
		if($Execute){
			$TargetPathToDeleteImage = "Upload/$ImageToBeUpdated";
			unlink($TargetPathToDeleteImage);
			
			$_SESSION["SuccessMessage"] = "Post with id : ".$IdFromUrl."Post Deleted Successfully";
			Redirect_to("Posts.php"); 
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			Redirect_to("Posts.php");
		}
	
} //end of Submit button Processing

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/Styles.css">
	
	
	<title> Delete	Post</title>
</head>
<body>
	<!-- Navbar -->
	<div style="height:10px; background:#27aae1;"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a href="#" class="navbar-brand">ISSPM.com</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapseCMS">
				<span class="navbar-toggler-icon"><span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapseCMS">
			<ul class="navbar-nav mr-auto">
				<li class="navbar-item">
					<a href="Home.php" class="nav-link"><i class="fas fa-home text-success"></i> Home</a>
				</li>
				<li class="navbar-item">
					<a href="NewDis.php" class="nav-link">News/DiscussionBoard</a>
				</li>
				<li class="navbar-item">
					<a href="Universities.php" class="nav-link">Universities</a>
				</li>
				<li class="navbar-item">
					<a href="Transportation.php" class="nav-link">Transportation</a>
				</li>
				
				<li class="navbar-item">
					<a href="Accommodations.php" class="nav-link">Accomodations</a>
				</li>
				<li class="navbar-item">
					<a href="JobPosts.php" class="nav-link">Job Posts</a>
				</li>

			</ul>
			<ul class="navbar-nav" ml-auto>
				<li class="navbar-itme"><a href="logout.php" class="nav-link"><i class="fas fa-user-times text-danger"></i> Log out</a></li>
			</ul>
			</div>
		</div>
	</nav>
	<div style="height:10px; background:#27aae1;"></div>
	<!-- Navbar end -->
	
	<!-- Header -->
	<header class="bg-dark text-white py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1><i class="fas fa-trash-alt" style="color:#27aae1;"></i> Delete Post </h1>
				</div>
			</div>
		</div>
	</header>
	<!-- End of Header -->
	
	<!-- Main Area -->
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-lg-1 col-lg-10" style="min-height:400px;">
		
				<form class="" action="DeletePost.php?id=<?php echo $IdFromUrl; ?>" method="post" enctype="multipart/form-data" >
					<div class="card bg-secondary text-light mb-3">

						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"><span class="FieldInfo"> Post Title: </span></label>
								<input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type Title here" value="<?php echo $TitleToBeUpdated ?> " >
							</div>
							<div class="form-group">
								<span class="FieldInfo"> Existing Category: </span>
								<?php echo $CategoryToBeUpdated; ?>
								<br>
								
							</div>
							<div class="form-group">
							
								<span class="FieldInfo"> Existing Image: </span>
								<img class="mb-1" src="Upload/<?php echo $ImageToBeUpdated; ?>" width="160px"; height="70px";>
								
								
							</div>
							<div class="form-group">
								<label for="Post"><span class="FieldInfo"> Post: </span></label>
								<textarea disabled class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
									<?php echo $PostToBeUpdated; ?>
								</textarea>
							</div>
							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Bact To Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-danger btn-block">
										<i class="fas fa-trash"></i> Delete
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<!-- End of Main Area -->
	
	
	<!-- Footer -->
	<footer class="bg-dark text-white">
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="lead text-center"> Theme By | info@isspm.com | <span id='year'></span> &copy; ----All rights Reserved.</p>
					<p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="#" target="_blank"> This site is only used for Helping Students purpose info@isspm.com have all the rights. no one is allow to distribute copies other then <br>&trade; isspm.com </a></p>
         
				</div>
			</div> 
		</div>
	</footer>
	<!-- End of Footer -->
	
	<div style="height:10px; background:#27aae1;"></div>
	

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/1c183f24b2.js" crossorigin="anonymous"></script>
<script>
	$('#year').text(new Date().getFullYear());
	
</script>
</body>
</html>
