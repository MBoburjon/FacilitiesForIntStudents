<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/Styles.css">
	
	
	<title>Blog</title>
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
					<a href="Blog.php" class="nav-link"><i class="fas fa-home text-success"></i> Home</a>
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
				<form class="form-inline d-none d-sm-block" action="Blog.php">
					<div class="form-group">
						<input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
						<button  class="btn btn-primary" name="SearchButton">Go</button>
						
					</div>
				</form>
			</ul>
			<!--
			<ul class="navbar-nav" ml-auto>
				<li class="navbar-itme"><a href="logout.php" class="nav-link"><i class="fas fa-user-times text-danger"></i> Log out</a></li>
			</ul> -->
			
			
			</div>
		</div>
	</nav>
	<div style="height:10px; background:#27aae1;"></div>
	<!-- Navbar end -->
	
	<!-- Header -->
	<div class="container">
		<div class="row mt-4">
			<!-- Main Area -->
	
	
			<div class="col-sm-8">
				<?php 
					echo ErrorMessage();
					echo SuccessMessage();
				?>
				<?php 
					$ConnectingDB;
					if(isset($_GET["SearchButton"])){
						$Search = $_GET["Search"];
						$sql = "SELECT * FROM posts 
								WHERE datetime LIKE :search 
								OR title LIKE :search 
								OR category LIKE :search 
								OR post LIKE :search";
								
						$stmt = $ConnectingDB->prepare($sql);
						$stmt->bindValue(':search','%'.$Search.'%');
						$stmt->execute();
						
					}
					else{
						$sql = "SELECT * FROM posts ORDER BY id desc";
						$stmt = $ConnectingDB->query($sql);
					}
					
					while($DataRows = $stmt->fetch()){
						$PostId = $DataRows["id"];
						$DateTime = $DataRows["datetime"];
						$PostTitle = $DataRows["title"];
						$Category = $DataRows["category"];
						$Author = $DataRows["author"];
						$Image = $DataRows["image"];
						$PostDescription = $DataRows["post"];	
					
				?>
				
				<div class="card">
					<img src="Upload/<?php echo $Image; ?>" style="max-height:450px;" class="image-fluid card-img-top"/>
					<div class="card-body">
						<h4 class="card-title"><?php echo htmlentities($PostTitle) ?></h4>
						<small class="text-muted">Written by <?php echo htmlentities($Author); ?> On <?php echo htmlentities($DateTime); ?></small>
						<span style="float:right;" class="badge badge-dark text-light">Comments 20</span>
						
						<hr>
						<p class="card-text">
							<?php
								if(strlen($PostDescription) > 150){
									$PostDescription = substr($PostDescription, 0, 150)."...";
									
								}
								echo htmlentities($PostDescription); 
							
							?>
						</p>
						<a href="FullPost.php?id=<?php echo htmlentities($PostId); ?>" style="float:right;">
							<span class="btn btn-info"> Read More >></span>
						</a>
					</div>
				</div>
					<?php } ?>
			</div>
					
			<!-- End of Main Area -->
			
			
			<!-- Side Area -->
			<div class="col-sm-4">
			
			</div>
			<!-- End of Side Area -->
			
		</div>
	</div>
	
	<!-- End of Header -->
	
	
	
	<br>
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
