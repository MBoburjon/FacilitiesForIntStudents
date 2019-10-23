<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $PostIdFromUrl = $_GET["id"]; ?>
<?php
if(isset($_POST["Submit"])){
	$Name = $_POST["CommenterName"];
	$Email = $_POST["CommenterEmail"];
	$Comment = $_POST["CommenterThoughts"];
	//Getting CurrentTime
	date_default_timezone_set("Asia/Seoul");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	
	if(empty($Name)||empty($Email)||empty($Comment)){
		$_SESSION["ErrorMessage"] = "All fields must be filled out";
		Redirect_to("FullPost.php?id={$PostIdFromUrl}"); 
	}
	elseif(strlen($Comment)>500){
		$_SESSION["ErrorMessage"] = "Comment lenght should be less than 500 characters";
		Redirect_to("FullPost.php?id={$PostIdFromUrl}"); 
	}

	else{
		
		$sql = "INSERT INTO comments(datetime, name, email, comment, approvedby, status, post_id)";
		$sql .= "VALUES(:dateTime, :name, :email, :comment, 'Pending', 'OFF', :postIdFromUrl)";
		$stmt = $ConnectingDB->prepare($sql);
		
		$stmt->bindValue(':name', $Name);
		$stmt->bindValue(':email', $Email);
		$stmt->bindValue(':dateTime', $DateTime);
		$stmt->bindValue(':comment', $Comment);
		$stmt->bindValue(':postIdFromUrl', $PostIdFromUrl);
		$Execute=$stmt->execute();
		
		if($Execute){
			$_SESSION["SuccessMessage"] = "Comment submitted Successfully";
			Redirect_to("FullPost.php?id={$PostIdFromUrl}"); 
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			Redirect_to("FullPost.php?id={$PostIdFromUrl}"); 
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
	
	
	<title>FullPost</title>
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
						$sql = "SELECT * FROM posts WHERE datetime LIKE :search OR title LIKE :search OR category LIKE :search OR post LIKE :search";
						
						$stmt = $ConnectingDB->prepare($sql);
						$stmt->bindValue(':search','%'.$Search.'%');
						$stmt->execute();
						
					}
					else{
						$PostIdFromUrl = $_GET["id"];
						if(!isset($PostIdFromUrl)){
							$_SESSION["ErrorMessage"] = "Bad Request !";
							Redirect_to("Blog.php");
						}
						$sql = "SELECT * FROM posts WHERE id= '$PostIdFromUrl'";
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
						<small class="text-muted">
							Category: <span class="font-weight-bold"><?php echo htmlentities($Category); ?></span>
							& Written by <span class="font-weight-bold"><?php echo htmlentities($Author); ?></span>
							On <span class="font-weight-bold"><?php echo htmlentities($DateTime); ?></span>
						</small>
						
						<hr>
						<p class="card-text">
							<?php echo htmlentities($PostDescription); ?>
						</p>
						
					</div>
				</div>
					<?php } ?>
					<!-- comment area -->
				<!-- Fetching comment from database -->
				<br>
					<span class="FieldInfo">Comment </span>
				<br>
				<br>
				<?php 
					$ConnectingDB;
					$sql = "SELECT * FROM comments WHERE post_id='$PostIdFromUrl' AND status='ON'";
					
					$stmt = $ConnectingDB->query($sql);
					
					while($DataRows = $stmt->fetch()){
						
						$CommentDate = $DataRows["datetime"];
						$CommenterName = $DataRows["name"];
						$Comment = $DataRows["comment"];
						
					

				?>
				<div>
				
					<div class="media" style="background-color:#eafafa;">
						<img class="d-block img-fluid" src="images/comment.png" alt="">
						<div class="media-body ml-2">
							<h6 class="lead"><?php echo $CommenterName; ?></h6>
							<p class="small"><?php echo $CommentDate; ?></p>
							<p><?php echo $Comment; ?></p>
							
						</div>
					</div>
				</div>
				<hr>
					<?php } ?>
				<!-- end of fetching existing comment -->
					
				<div class="">
					<form class="" action="FullPost.php?id=<?php echo htmlentities($PostIdFromUrl); ?>" method="post">
						<div class="card mb-3">
							<div class="card-header">
								<h5 class="FieldInfo"> Share your Thoughts about this post </h5>
								
							</div>
							
							<div class="card-body">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
										</div>
										<input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-envelope"></i></span>
										</div>
										<input class="form-control" type="email" name="CommenterEmail" placeholder="Email" value="">
									</div>
								</div>
								
								<div class="form-group">
									<textarea name="CommenterThoughts" class="form-control" rows="8" cols="80">
									</textarea>
								</div>
								
								<div class="">
									<button type="submit" name="Submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- end of comment area -->
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
