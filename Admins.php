<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 
	$_SESSION["TrackingUrl"] = $_SERVER["PHP_SELF"];
	confirmLogin(); 
?>
<?php
if(isset($_POST["Submit"])){
	$UserName = $_POST["UserName"];
	$Password = $_POST["Password"];
	$ConfirmPassword = $_POST["ConfirmPassword"];
	$Admin = $_SESSION["UserName"];
	$Email = $_POST["EmailAddress"];
	
	//Getting CurrentTime
	date_default_timezone_set("Asia/Seoul");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	
	if(empty($UserName) || empty($Password) || empty($ConfirmPassword)){
		$_SESSION["ErrorMessage"] = "All fields must be filled out";
		Redirect_to("Admins.php"); 
	}
	elseif(strlen($Password)<8){
		$_SESSION["ErrorMessage"] = "Password should be greater than 7 characters";
		Redirect_to("Admins.php"); 
	}
	elseif($Password !== $ConfirmPassword){
		$_SESSION["ErrorMessage"] = "Password and Confirm Password should match";
		Redirect_to("Admins.php"); 
	}
	elseif(CheckUserNameExistence($UserName)){
		$_SESSION["ErrorMessage"] = "Username Exists. Try Another One! ";
		Redirect_to("Admins.php"); 
	}
	else{
		$ConnectingDB;
		
		$sql = "INSERT INTO admins(datetime, username, password, email, addedby)";
		$sql .= "VALUES(:dateTime, :userName, :passWord, :eMail, :addedBy)";
		$stmt = $ConnectingDB->prepare($sql);
		
		
		$stmt->bindValue(':dateTime', $DateTime);
		$stmt->bindValue(':userName', $UserName);
		$stmt->bindValue(':passWord', $Password);
		$stmt->bindValue(':eMail', $Email);
		$stmt->bindValue(':addedBy', $Admin);
		
		$Execute=$stmt->execute();
		
		if($Execute){
			$_SESSION["SuccessMessage"] = "New Admin with the name of {$UserName} added Successfully";
			Redirect_to("Admins.php"); 
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			Redirect_to("Admins.php");
		}
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
	
	
	<title>Admins</title>
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
					<h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage Admins </h1>
				</div>
			</div>
		</div>
	</header>
	<!-- End of Header -->
	
	<!-- Main Area -->
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-lg-1 col-lg-10" style="min-height:400px;">
			<?php 
				echo ErrorMessage();
				echo SuccessMessage();
			?>
				<form class="" action="Admins.php" method="post">
					<div class="card bg-secondary text-light mb-3">
						<div class="card-header">
							<h1> Add New Admin </h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="username"><span class="FieldInfo"> Username: </span></label>
								<input class="form-control" type="text" name="UserName" id="username" placeholder="Type Title here" value="">
							</div>
							
							<div class="form-group">
									
								<label for="Email"><span class="FieldInfo"> E-mail (Optional): </span></label>
								<input class="form-control" type="email" name="EmailAddress" placeholder="address@email.com" value="">
									
							</div>
							
							<div class="form-group">
								<label for="Password"><span class="FieldInfo"> Password: </span></label>
								<input class="form-control" type="password" name="Password" id="Password" value="" required minlength="7">
							</div>
							
						
							<div class="form-group">
								<label for="ConfirmPassword"><span class="FieldInfo"> Confirm Password: </span></label>
								<input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" value="" required minlength="7">
							</div>
							<div class="row">
								<div class="col-lg-6 mb-2">
									<a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Bact To Dashboard</a>
								</div>
								<div class="col-lg-6 mb-2">
									<button type="submit" name="Submit" class="btn btn-success btn-block">
										<i class="fas fa-check"></i> Publish
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