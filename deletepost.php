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
	$admin = "Piyush Pipriye";
	$image  = $_FILES['Image']['name'];
	$target =  "upload/".basename($_FILES['Image']['name']);
		$id=$_GET['Delete'];
		global $conn;
		$query  = "DELETE FROM admin WHERE id='$id'";
		$exec = $conn->query($query);
		move_uploaded_file($_FILES["Image"]["tmp_name"],$target);
		if($exec){
			$_SESSION["SuccessMessage"] = "Post deleted successfully";
			redirect("dashboard.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			redirect("dashboard.php");
		}
	}
?>
<!DOCTYPE>
<html>
<head>
<title>Delete Post</title>
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
<h1>Delete Post</h1>
<div> <?php echo Message();
echo SuccessMessage(); ?> </div>
<div>
	<?php
	$search=$_GET['Delete'];
	global $conn;
	$sql = "SELECT * FROM admin WHERE id='$search'";
	$result = $conn->query($sql);
	while($datarow = $result->fetch_assoc()) {
        $title = $datarow["title"];
		$category = $datarow["category"];
		$image = $datarow["images"];
		$post = $datarow["post"];
    }
	?>
<form action="deletepost.php?Delete=<?php echo $search;?>" method="post" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
<label for="title"><span class="fieldinfo">Enter Title:</span></label>
<input disabled class="form-control" type="text" name="title" id="title" placeholder="Enter Title" value="<?php echo$title; ?>">
</div>
<div class="form-group">
	<span class="fieldinfo">Existing Category : </span>
	<?php echo$category; ?>
	<br>
<label for="category"><span class="fieldinfo">Select Category:</span></label>
<select disabled class="form-control" id= "category" name="category">
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
	<span class="fieldinfo">Existing Image : </span>
	<img src="upload/<?php echo$image; ?>" width=175px; height=75px;><br>
<label for="Image"><span class="fieldinfo">Select Image:</span></label>
<input class="form-control" disabled type="file" name="Image" id="Image">
</div>
<div class="form-group">
<label for="post"><span class="fieldinfo">Post:</span></label>
<textarea disabled class="form-control" name="post" id="post">
<?php echo$post; ?></textarea>
</div>
<br>
<input class="btn btn-danger btn-block" type="Submit" name="Submit" value="Delete Post">
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