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
	
	
	<title>Comments</title>
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
					<h1><i class="fas fa-comments" style="color: #27aae1"></i> Manage Comments </h1>
				</div>
			</div>
		</div>
	</header>
	<!-- End of Header -->
	
	<section class="container py-2 mb-4">
		<div class="row" style="min-height:30px;">
			<div class="col-lg-12" style="min-height:400px;">
				<?php 
					echo SuccessMessage();
					echo ErrorMessage();
				?>
				<h2>Un-Approved Comments</h2>
				<!-- table for Approving comments-->
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. </th>
							<th>Name </th>
							<th>Date&Time </th>
							<th>Comment </th>
							<th>Approve </th>
							<th>Delete </th>
							<th>Details </th>
						
							
						</tr>
					</thead>
					<?php 
						$ConnectingDB;
						$sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
						
						$Execute = $ConnectingDB->query($sql);
						
						$SrNo = 0;
						while($DataRows = $Execute->fetch()){
							$CommentId = $DataRows["id"];
							$CommentorName = $DataRows["name"];
							$CommentDate = $DataRows["datetime"];
							$Comment = $DataRows["comment"];
							$CommentPostId = $DataRows["post_id"];
							$SrNo++;
						/*if(strlen($CommentorName) > 7){
							$CommentorName = substr($Category, 0, 7)."...";
						}
						if(strlen($CommentDate) > 11){
							$CommentDate = substr($CommentDate, 0, 11)."...";
						}*/
						
					?>
					<tbody>
						<tr>
							<td><?php echo htmlentities($SrNo); ?></td>
							<td><?php echo htmlentities($CommentorName); ?></td>
							<td><?php echo htmlentities($CommentDate); ?></td>
							<td><?php echo htmlentities($Comment); ?></td>
							<td><a class="btn btn-success" href="ApproveComment.php?id=<?php echo $CommentId; ?>">Approve</a></td>
							<td><a class="btn btn-danger" href="DeleteComment.php?id=<?php echo $CommentId; ?>">Delete</a></td>
							<td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>"target="_blank">Live Preview</a></td>
							
						</tr>
					</tbody>
						<?php } ?>
				</table>
				<!-- end of table for Approving comments-->				
				
				<!-- table for Disaproving Comments -->
				<h2>Un-Approved Comments</h2>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. </th>
							<th>Name </th>
							<th>Date&Time </th>
							<th>Comment </th>
							<th>Revert</th>
							<th>Delete </th>
							<th>Details </th>
						
							
						</tr>
					</thead>
					<?php 
						$ConnectingDB;
						$sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
						
						$Execute = $ConnectingDB->query($sql);
						
						$SrNo = 0;
						while($DataRows = $Execute->fetch()){
							$CommentId = $DataRows["id"];
							$CommentorName = $DataRows["name"];
							$CommentDate = $DataRows["datetime"];
							$Comment = $DataRows["comment"];
							$CommentPostId = $DataRows["post_id"];
							$SrNo++;
						/*if(strlen($CommentorName) > 7){
							$CommentorName = substr($Category, 0, 7)."...";
						}
						if(strlen($CommentDate) > 11){
							$CommentDate = substr($CommentDate, 0, 11)."...";
						}*/
						
					?>
					<tbody>
						<tr>
							<td><?php echo htmlentities($SrNo); ?></td>
							<td><?php echo htmlentities($CommentorName); ?></td>
							<td><?php echo htmlentities($CommentDate); ?></td>
							<td><?php echo htmlentities($Comment); ?></td>
							<td><a class="btn btn-warning" href="DisApproveComment.php?id=<?php echo $CommentId; ?>">Dis-Approve</a></td>
							<td><a class="btn btn-danger" href="DeleteComment.php?id=<?php echo $CommentId; ?>">Delete</a></td>
							<td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
							
						</tr>
					</tbody>
						<?php } ?>
				</table>
				<!-- end of Disaproving Comments table -->
				
			</div>
		</div>
	</section>
	
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
