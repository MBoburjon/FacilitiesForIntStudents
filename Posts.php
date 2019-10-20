<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
	$_SESSION["TrackingUrl"] = $_SERVER["PHP_SELF"];
	confirmLogin(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/Styles.css">
	
	
	<title>Posts</title>
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
				<li class="navbar-itme"><a href="Logout.php" class="nav-link"><i class="fas fa-user-times text-danger"></i> Log out</a></li>
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
					<h1><i class="fas fa-blog" style="color:#27aae1;"></i> Blog Post </h1>
					<?php 
						echo ErrorMessage();
						echo SuccessMessage();
					?>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="AddNewPost.php" class="btn btn-primary btn-block">
						<i class="fas fa-edit"> Add New Post </i>
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="Categories.php" class="btn btn-info btn-block">
						<i class="fas fa-folder-plus"> Add New Category </i>
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="Admins.php" class="btn btn-warning btn-block">
						<i class="fas fa-edit"> Add New Admin </i>
					</a>
				</div>
				<div class="col-lg-3 mb-2">
					<a href="Comments.php" class="btn btn-success btn-block">
						<i class="fas fa-check"> Approve Comments </i>
					</a>
				</div>
			</div>
		</div>
	</header>
	<!-- End of Header -->
	
	
	
	<!-- Main Area -->
	<section class="container py-2 mb-4">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Category</th>
						<th>Date&Time</th>
						<th>Author</th>
						<th>Banner</th>
						<th>Comments</th>
						<th>Action</th>
						<th>Live Preview</th>
					</tr>
					</thead>
					<?php
						$ConnectingDB;
						$sql = "SELECT * FROM posts";
						$stmt = $ConnectingDB->query($sql);
						$iter = 0;
						while ($DataRows = $stmt->fetch()){
							$Id = $DataRows["id"];
							$DateTime = $DataRows["datetime"];
							$PostTitle = $DataRows["title"];
							$Category = $DataRows["category"];
							$Admin = $DataRows["author"];
							$Image = $DataRows["image"];
							$PostText = $DataRows["post"];
						$iter++;
							
						
					?>
					<tbody>
					<tr>
						<td><?php echo $iter ?></td>
						<td>
							<?php if(strlen($PostTitle) > 20){
								$PostTitle = substr($PostTitle, 0, 10)."...";
							}
							echo $PostTitle ?>
						</td>
						<td>
							<?php if(strlen($Category) > 7){
								$Category = substr($Category, 0, 7)."...";
							}
							echo $Category ?>
						</td>
						<td>
							<?php if(strlen($DateTime) > 11){
								$DateTime = substr($DateTime, 0, 11)."...";
							}
							echo $DateTime ?>
						</td>
						<td>
							<?php if(strlen($Admin) > 6){
								$Admin = substr($Admin, 0, 6)."...";
							}
							echo $Admin ?>
						
						</td>
						<td><img src="Upload/<?php echo $Image ?>" width="170px;" height="50px"></td>
						<td> Comments </td>
						<td>
							<a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning"> Edit </span></a>
							<a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger"> Delete </span></a>					
						</td>
						<td> 
							<a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary"> Live Preview </span></a> 
						</td>
					</tr>
					</tbody>
					<?php } ?>
				</table>
						
			</div>
		</div>
	</section>
	
	
	<!-- Main Area End -->
	
	
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
