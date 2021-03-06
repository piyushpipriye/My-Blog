<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php clog() ?>
<?php
if(isset($_POST["Submit"])){
	$title =  $_POST["title"];
	$category =  $_POST["category"];
	$post =  $_POST["post"];
	$current = time();
	$datetime =  strftime("%B-%d-%Y %H:%M:%S",$current);
	$datetime;
	$admin = $_SESSION["user"];
	$image  = $_FILES['Image']['name'];
	$target =  "upload/".basename($_FILES['Image']['name']);
	if(empty($title)){
		$_SESSION['ErrorMessage']="All fields must be filled out";
		redirect("addnewpost.php");
	}
	elseif(strlen($title)<2){
		$_SESSION['ErrorMessage']="Too short title  ";
		redirect("addnewpost.php");
	}
	else {
		global $conn;
		$query  = "INSERT INTO admin(datetime,title,category,author,images,post)
		VALUES('$datetime','$title','$category','$admin','$image','$post')";
		$exec = $conn->query($query);
		move_uploaded_file($_FILES["Image"]["tmp_name"],$target);
		if($exec){
			$_SESSION["SuccessMessage"] = "Post added successfully";
			redirect("addnewpost.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			redirect("addnewpost.php");
		}
	}
}
?>
<!DOCTYPE>
<html>
<head>
<title>Add New Post</title>
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
<li class="active"><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
<li><a href="category.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
<li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
</ul>
</div>
<div class="col-sm-10">
<h1>Add New Post</h1>
<div> <?php echo Message();
echo SuccessMessage(); ?> </div>
<div>
<form action="addnewpost.php" method="post" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
<label for="title"><span class="fieldinfo">Enter Title:</span></label>
<input class="form-control" type="text" name="title" id="title" placeholder="Enter Title">
</div>
<div class="form-group">
<label for="category"><span class="fieldinfo">Select Category:</span></label>
<select class="form-control" id= "category" name="category">
<?php
global $conn;
$view = "SELECT * FROM category ORDER BY datetime desc";
$exec  = $conn->query($view);
while($data=mysqli_fetch_array($exec)){
	$id = $data["id"];
	$name = $data["name"];
?>
<option><?php echo $name ?></option>
<?php } ?> 
</select>
</div>
<div class="form-group">
<label for="Image"><span class="fieldinfo">Select Image:</span></label>
<input class="form-control" type="file" name="Image" id="Image">
</div>
<div class="form-group">
<label for="post"><span class="fieldinfo">Post:</span></label>
<textarea class="form-control" name="post" id="post"></textarea>
</div>
<br>
<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">
<br>
</fieldset>
</form>
<style>
.fieldinfo{
	color:rgb(251,174,44);
	font-family:Bitter,Georgia,"Times New Roman",Times,serif;
	font-size:1.2em;
}
</style>
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