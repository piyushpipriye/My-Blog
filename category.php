<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php clog() ?>
<?php
if(isset($_POST["Submit"])){
	$category =  $_POST["cate"];
	$current = time();
	$datetime =  strftime("%B-%d-%Y %H:%M:%S",$current);
	$datetime;
	$admin = $_SESSION["user"];
	if(empty($category)){
		$_SESSION['ErrorMessage']="All fields must be filled out";
		redirect("dashboard.php");
	}
	elseif(strlen($category>99)){
		$_SESSION['ErrorMessage']="Too long name ";
		redirect("category.php");
	}
	else {
		global $conn;
		$query  = "INSERT INTO category(datetime,name,creatornm)
		VALUES('$datetime','$category','$admin')";
		$exec = $conn->query($query);
		if($exec){
			$_SESSION["SuccessMessage"] = "Category added successfully";
			redirect("category.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Category failed to add";
			redirect("category.php");
		}
	}
}
?>
<!DOCTYPE>
<html>
<head>
<title>Add New Category</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/adminstyle.css">
</head>
<body>
	<div style="height:10px; background:#27aae1;"></div>
<nav class="navbar navbar-inverse" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
<span class="sr-only" > Toggle Navigation</span>
<span class="icon-bar"> </span>
<span class="icon-bar"> </span>
<span class="icon-bar"> </span></button>
<a class="navbar-brand" href="Blog.php">
<img style="margin-top:-15px;" src="images/piyush.jpg" width=200; height=50;></a>
</div>
<div class="collapse navbar-collapse" id="collapse">
<ul class="nav navbar-nav">
<li><a href="home.php">Home</a></li>
<li><a href="Blog.php">Blog</a></li>
<li><a href="about.php">About</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>
<form class="navbar-form navbar-right" action="Blog.php"> 
<div class="form-group">
<input type="text" class="form-control" placeholder="Search" name="Search">
</div>
<button class="btn btn-default" name="SearchButton">Search</button>
</form>
</div>
</div>
</nav>
<div class="line" style="height:10px; background:#27aae1;"></div>
<div class="container-fluid">
<div class="row">
<div class="col-sm-2">
<h1></h1>
<ul class="nav nav-pills nav-stacked" id="sidemenu">
<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
<li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
<li class="active"><a href="category.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
<li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
</ul>
</div>
<div class="col-sm-10">
<h1>Manage Categories</h1>
<div> <?php echo Message();
echo SuccessMessage(); ?> </div>
<div>
<form action="category.php" method="post">
<fieldset>
<div class="form-group">
<label for="categoryname"><span class="fieldinfo">Enter Name:</span></label>
<style>
.fieldinfo{
	color:rgb(251,174,44);
	font-family:Bitter,Georgia,"Times New Roman",Times,serif;
	font-size:1.2em;
}
</style>
<input class="form-control" type="text" name="cate" id="categoryname" placeholder="Enter name">
</div>
<br>
<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
<br>
</fieldset>
</form>
</div>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
<th>Sr. No.</th>
<th>Date & Time</th>
<th>Category Name</th>
<th>Creator Name</th>
<th>Action</th>
</tr>
<?php
global $conn;
$view = "SELECT * FROM category ORDER BY datetime desc";
$exec  = $conn->query($view);
$sr = 0;
while($data=mysqli_fetch_array($exec)){
	$id = $data["id"];
	$datetime = $data["datetime"];
	$name = $data["name"];
	$creatornm = $data["creatornm"];
	$sr++;
?>
<tr>
<td><?php echo $sr ; ?> </td>
<td><?php echo $datetime ; ?> </td>
<td><?php echo $name ; ?> </td>
<td><?php echo $creatornm ; ?> </td>
<td><a href="deletecat.php?id=<?php echo$id?>"><span class="btn btn-danger">Delete</span></a></td>
</tr>
<?php } ?>
</table>
</div>
</div>
</div>
</div>
<div id="Footer">
<hr><p>Theme By | Piyush Pipriye | &copy;2016-2020 ---All right reserved. </p>
<a style="color:white; text-decoration: none; cursor: pointer; font-weight:bold;" href="github.com/piyushpipriye">
<p>This is the site only used for study purpose piyushpipriye have all the rights. no one is allow copies other then <br>&trade; piyushpipriye
&trade; Udemy &trade; Skillshare; &trade; Stackskills </p></a><hr>
</div>
<div style="height:10px; background:#27AAF1;">
</div>
</body>
</html>