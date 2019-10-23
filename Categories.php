<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 
	$_SESSION["TrackingUrl"] = $_SERVER["PHP_SELF"];
	confirmLogin(); 
?>
<?php
if(isset($_POST["Submit"])){
	$Category = $_POST["CategoryTitle"];
	$Admin = $_SESSION["UserName"];
	
	
	//Getting CurrentTime
	date_default_timezone_set("Asia/Seoul");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	
	if(empty($Category)){
		$_SESSION["ErrorMessage"] = "All fields must be filled out";
		Redirect_to("Categories.php"); 
	}
	elseif(strlen($Category)<3){
		$_SESSION["ErrorMessage"] = "Category title should be greater than 2 characters";
		Redirect_to("Categories.php"); 
	}
	elseif(strlen($Category)>49){
		$_SESSION["ErrorMessage"] = "Category title should be less than 50 characters";
		Redirect_to("Categories.php"); 
	}
	else{
		
		$sql = "INSERT INTO category(title, author, datetime)";
		$sql .= "VALUES(:categoryName, :adminName, :dateTime)";
		$stmt = $ConnectingDB->prepare($sql);
		
		$stmt->bindValue(':categoryName', $Category);
		$stmt->bindValue(':adminName', $Admin);
		$stmt->bindValue(':dateTime', $DateTime);
		
		$Execute=$stmt->execute();
		
		if($Execute){
			$_SESSION["SuccessMessage"] = "Category with id : ".$ConnectingDB->lastInsertId()."added Successfully";
			Redirect_to("Categories.php"); 
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			Redirect_to("Categories.php");
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
	
	
	<title>Categories</title>
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
					<h1><i class="fas fa-edit" style="color:#27aae1;"></i> ManageCategories </h1>
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
				<form class="" action="Categories.php" method="post">
					<div class="card bg-secondary text-light mb-3">
						<div class="card-header">
							<h1> Add New Category </h1>
						</div>
						<div class="card-body bg-dark">
							<div class="form-group">
								<label for="title"><span class="FieldInfo"> Category title: </span></label>
								<input class="form-control" type="text" name="CategoryTitle" id="title" placeholder="Type Title here" value="">
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
				
				<!-- Table list of categories -->
				<h2>Existing Categories</h2>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>No. </th>
							<th>Category Name </th>
							<th>Creator Name </th>
							<th>Date&Time </th>
							<th>Delete</th>
					
						
							
						</tr>
					</thead>
					<?php 
						$ConnectingDB;
						$sql = "SELECT * FROM category ORDER BY id desc";
						
						$Execute = $ConnectingDB->query($sql);
						
						$SrNo = 0;
						while($DataRows = $Execute->fetch()){
							$CategoryId = $DataRows["id"];
							$CategoryName = $DataRows["title"];
							$DateTime = $DataRows["datetime"];
							$Creator = $DataRows["author"];
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
							<td><?php echo htmlentities($CategoryName); ?></td>
							<td><?php echo htmlentities($Creator); ?></td>
							<td><?php echo htmlentities($DateTime); ?></td>
							<td><a class="btn btn-danger" href="DeleteCategory.php?id=<?php echo $CategoryId; ?>">Delete</a></td>
							
						</tr>
					</tbody>
						<?php } ?>
				</table>
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
