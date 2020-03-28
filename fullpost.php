<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php
if(isset($_POST["Submit"])){
	$name =  $_POST["name"];
	$email =  $_POST["email"];
	$comment =  $_POST["comment"];
	$current = time();
	$datetime =  strftime("%B-%d-%Y %H:%M:%S",$current);
	$datetime;
	$postid=$_GET['id'];
	if(empty($name) || empty($email) || empty($comment)){
		$_SESSION['ErrorMessage']="All fields must be filled out";
	}
	elseif(strlen($comment)>500){
		$_SESSION['ErrorMessage']="Too long comment only 500 character will allow";
	}
	else {
		global $conn;
		$postid=$_GET['id'];
		$query  = "INSERT INTO comments(datetime,name,email,comment,addby,status,admin_id)
		VALUES('$datetime','$name','$email','$comment','peding','OFF','$postid')";
		$exec = $conn->query($query);
		if($exec){
			$_SESSION["SuccessMessage"] = "Comment submitted successfully";
			redirect("fullpost.php?id={$postid}");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
			redirect("fullpost.php?id={$postid}");
		}
	}
}
?>
<html>
<head>
<title>Full Blog Post</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/public.css">
<style type="text/css">
.col-sm-3{
	background-color: green;
}
</style>
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
<li class="active"><a href="Blog.php">Blog</a></li>
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
<div class= "line" style="height:10px; background:#27aae1;"></div>
<div class="container">
	<div class="blog-header">
		<h1>The complete resposive WEB Blog.</h1>
		<p class="lead">The complete block using PHP by Piyush Pipriye.</p>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<?php
			global $conn;
			if (isset($_GET['SearchButton'])) {
				$Search = $_GET['Search'];
				$view = "SELECT * FROM admin where datetime 
				LIKE '%$Search%' OR title LIKE '%$Search%' 
				OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
			}
			else{
				$posturl = $_GET["id"];
			$view = "SELECT * FROM admin where id='$posturl' ORDER BY datetime desc";}
			$exec = $conn->query($view);
			while ($data = mysqli_fetch_array($exec)) {
				$postid = $data["id"];
				$datetime = $data["datetime"];
				$title = $data["title"];
				$category = $data["category"];
				$author = $data["author"];
				$image = $data["images"];
				$post = $data["post"];
			?>
			<div> <?php echo Message();
						echo SuccessMessage(); ?> </div><br>
			<div class="blogpost thumbnail">
				<img class="img-responsive" style="height:300px;" src="upload/<?php echo $image; ?>">
				<div class="caption">
					<h1 id="heading"><?php echo htmlentities($title); ?></h1>
					<p class="description">Category : <?php echo htmlentities($category); ?> Published on <?php echo htmlentities($datetime); ?></p>
					<p class="post"><?php 
					echo nl2br($post); ?>
					</p>
				</div>
				</div>
			<?php } ?>
			<span class="fieldinfo">Share your thoughts about this post</span><br>
			<span class="fieldinfo">Comments</span>
			<?php 
				global $conn;
				$postid=$_GET["id"];
				$query="SELECT * FROM comments WHERE admin_id='$postid' AND status='ON'";
				$exec=$conn->query($query);
				while ($row=mysqli_fetch_array($exec)) {
					$comdate=$row['datetime'];
					$comname=$row['name'];
					$comuser=$row['comment'];
			?>
			<div class="commentblock">
				<img style="margin-left: 10px; margin-top: 10px;" src="images/comment.png" class="pull-left" width=70px; height=70px;>
				<p style="margin-left: 90px;" class="commentinfo"><?php echo$comname ;?></p>
				<p style="margin-left: 90px;" class="description"><?php echo$comdate ;?></p>
				<p style="margin-left: 90px;" class="comment"><?php echo$comuser ;?></p>
			</div>
			<hr>
			<?php } ?>
			<div>
<form action="fullpost.php?id=<?php echo $postid; ?>" method="post" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
<label for="name"><span class="fieldinfo">Enter Name:</span></label>
<input class="form-control" type="text" name="name" id="name" placeholder="Enter Name">
</div>
<div class="form-group">
<label for="email"><span class="fieldinfo">Enter Email:</span></label>
<input class="form-control" type="email" name="email" id="email" placeholder="Enter Email">
</div>
<div class="form-group">
<label for="comment"><span class="fieldinfo">Comment:</span></label>
<textarea class="form-control" name="comment" id="comment"></textarea>
</div>
<br>
<input class="btn btn-primary" type="Submit" name="Submit" value="Submit">
<br>
</fieldset>
</form>
<style>
.fieldinfo{
	color:rgb(251,174,44);
	font-family:Bitter,Georgia,"Times New Roman",Times,serif;
	font-size:1.2em;
}
.comment{
	margin-top: -2px;
	padding-bottom: 10px;
	font-size: 1.1em;
}
.commentinfo{
	color: #365899;
	font-family: sans-serif;
	font-weight: bold;
	padding-top: 10px;
}
.commentblock{
	background-color: #F6F7F9;
}
</style>
</div>
		</div>
		<div class="col-sm-offset-1 col-sm-3">
			<h2>Test</h2>
			<p>This is totally a web blog made with PHP. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
				ut labore et dolore magna aliqua.
				Please like share and subscribe the channel. <br>Hi everyone this is my first dynamic web blog so please comment it and like it. 
				I am a diploma student so you may ask queries regarding your project to me.
				Hi everyone this is my first dynamic web blog so please comment it and like it. I am a diploma student so you may ask queries 
				regarding your project to me. 
				Please like share and subscribe the channel. </p>
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
</body>
</html>