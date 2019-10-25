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
	
	
	<title>Dashboard</title>
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
					<a href="Posts.php" class="nav-link"><i class="fas fa-home text-success"></i> Home</a>
				</li>
				<li class="navbar-item">
					<a href="Dashboard.php" class="nav-link">Dashboard</a>
				</li>
				
				<li class="navbar-item">
					<a href="Blog.php" class="nav-link">Blog page</a>
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
					<h1><i class="fas fa-cog" style="color:#27aae1;"></i> Dashboard					</h1>
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
			<?php 
				echo ErrorMessage();
				echo SuccessMessage();
			?>
			<!-- left Side Area -->
			<div class="col-lg-2 d-none d-md-block">
				<div class="card text-center bg-dark text-white mb-3">
					<div class="card-body">
						<h1 class="lead">Posts</h1>
						<h4 class="display-5">
							<i class="fab fa-readme"></i>
							<?php 
								TotalPosts();
							?>
						</h4>
					</div>
				</div>
				<div class="card text-center bg-dark text-white mb-3">
					<div class="card-body">
						<h1 class="lead">Categories</h1>
						<h4 class="display-5">
							<i class="fas fa-folder"></i>
							<?php 
								TotalCategories();
							?>
						</h4>
					</div>
				</div>
				<div class="card text-center bg-dark text-white mb-3">
					<div class="card-body">
						<h1 class="lead">Admins</h1>
						<h4 class="display-5">
							<i class="fas fa-users"></i>
							<?php 
								TotalAdmins();
							?>
						</h4>
					</div>
				</div>
				<div class="card text-center bg-dark text-white mb-3">
					<div class="card-body">
						<h1 class="lead">Comments</h1>
						<h4 class="display-5">
							<i class="fas fa-comments"></i>
							<?php 
								TotalComments();
							?>
						</h4>
					</div>
				</div>
			</div>
			<!-- End of left Side Area -->
			
			<!-- right Side Area -->
			<div class="col-lg-10">
				<h1> Top Posts </h1>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No.</th>
							<th>Title</th>
							<th>Date&Time</th>
							<th>Author</th>
							<th>Comments</th>
							<th>Details</th>
						</tr>
					</thead>
					<?php
						$SrNo = 0;
						$ConnectingDB;
						$sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
						$stmt = $ConnectingDB->query($sql);
						while($DataRows = $stmt->fetch()){
							$PostId = $DataRows["id"];
							$DateTime = $DataRows["datetime"];
							$Title = $DataRows["title"];
							$Author = $DataRows["author"];
							$SrNo++;
						
					?>
					<tbody>
						<tr>
							<td><?php echo htmlentities($SrNo); ?></td>
							<td><?php echo htmlentities($Title); ?></td>
							<td><?php echo htmlentities($DateTime); ?></td>
							<td><?php echo htmlentities($Author); ?></td>
							<td>
								<span class="badge badge-success">
									<?php 
										
										CountApproved($PostId);
									?>
								</span>
								<span class="badge badge-danger">
									<?php 
										Dis_Approved($PostId);
									?>
								</span>
							</td>
							<td><a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Preview</span></a></td>
						</tr>
					</tbody>
						<?php } ?>
				</table>
			</div>
			<!-- End of right Side Area -->
			
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
