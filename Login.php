<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
	if(isset($_SESSION["UserId"])){
		Redirect_to("Dashboard.php");
	}
	if(isset($_POST["Submit"])){
		$Username = $_POST["Username"];
		$Password = $_POST["Password"];
		
		if(empty($Username)||empty($Password)){
			$_SESSION["ErrorMessage"] = "All fields must be filled out";
			Redirect_to("Login.php"); 
		}

		else{
			$FoundAccount = Login_Attempt($Username, $Password);
			if($FoundAccount){
				$_SESSION["UserId"] = $FoundAccount["id"];
				$_SESSION["UserName"] = $FoundAccount["username"];
				
				$_SESSION["SuccessMessage"] = "Welcome {$Username} !";
				if(isset($_SESSION["TrackingUrl"])){
					Redirect_to($_SESSION["TrackingUrl"]);
				}
				else{
					Redirect_to("Posts.php");
				}
			}
			else{
				$_SESSION["ErrorMessage"] = "Incorrect Username/Password";
				Redirect_to("Login.php");
			}
			
			
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/Styles.css">
	
	
	<title>Login</title>
</head>
<body >
	<!-- Navbar -->
	<div style="height:10px; background:#27aae1;"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a href="#" class="navbar-brand">ISSPM.com</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapseCMS">
				<span class="navbar-toggler-icon"><span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapseCMS">
			
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
				
				</div>
			</div>
		</div>
	</header>
	<!-- End of Header -->
	
	<!-- Main area -->
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="offset-sm-3 col-sm-6" style="min-height:400px;">
				<?php 
					echo ErrorMessage();
					echo SuccessMessage();
				?>
				<div class="card bg-secondary text-light">
					<div class="card-header">
						<h4>Welcome ! </h4>
					</div>
						<div class="card-body bg-dark">
		
						<form class="" action="Login.php" method="post">
							<div class="form-group">
								<label for="username"><span class="FieldInfo">Username:</span></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" class="form-control" name="Username" id="username" value="">
									
								</div>	
							</div>
						
							<div class="form-group">
								<label for="password"><span class="FieldInfo">Password:</span></label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>
									</div>
									<input type="password" class="form-control" name="Password" id="password" value="">
									
								</div>	
							</div>
							
							<input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
						</form>
				</div>
			</div>
		</div>
	</section>
	<!-- End of Main Area -->
	
	
	<!-- Footer -->
	<footer class="bg-dark text-white">
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="lead text-center"> Theme By | mukhammadboburjon@gmail.com | <span id='year'></span> &copy; ----All rights Reserved.</p>
					<p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="#" target="_blank"> This site is only used for Helping Students purpose mukhammadboburjon@gmail.com have all the rights. no one is allow to distribute copies other then <br>&trade; Bigboss </a></p>
         
				</div>
			</div> 
		</div>
	</footer>
	<!-- End of Footer -->


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/1c183f24b2.js" crossorigin="anonymous"></script>
<script>
	$('#year').text(new Date().getFullYear());
	
</script>
</body>
</html>
