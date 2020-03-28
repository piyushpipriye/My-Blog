<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<html>
<head>
<title>Blog Page</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/public.css">
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
<div class = "line" style="height:10px; background:#27aae1;"></div>
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
			$view = "SELECT * FROM admin ORDER BY datetime desc";}
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
			<div class="blogpost thumbnail">
				<img class="img-responsive" style="height:300px;" src="upload/<?php echo $image; ?>">
				<div class="caption">
					<h1 id="heading"><?php echo htmlentities($title); ?></h1>
					<p class="description">Category : <?php echo htmlentities($category); ?> Published on <?php echo htmlentities($datetime); ?></p>
					<p class="post"><?php 
					if (strlen($post)>150){$post=substr($post,0,150).'...';}
					echo htmlentities($post); ?></p>
				</div>
				<a href="fullpost.php?id=<?php echo$postid?>"><span class="btn btn-info">Read More &rsaquo;</span></a>
			</div>
			<?php } ?>
		</div>
		<div class="col-sm-offset-1 col-sm-3">
			<style type="text/css">.imagei{
			max-width: 150px;
			margin: 0 auto;
			display: block;
			}</style>
			<h2>About Me</h2>
			<img class="img-responsive img-circle imagei" src="images/piyush.jpg" >
			<p>This is totally a web blog made with PHP. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
				ut labore et dolore magna aliqua.
				Please like share and subscribe the channel. <br>Hi everyone this is my first dynamic web blog so please comment it and like it. 
				I am a diploma student so you may ask queries regarding your project to me.
				Hi everyone this is my first dynamic web blog so please comment it and like it. I am a diploma student so you may ask queries 
				regarding your project to me. 
				Please like share and subscribe the channel. </p>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Categories</h2>
					</div>
					<div class="panel-boby">
						<?php 
						global $conn;
						$query="SELECT * FROM category ORDER BY datetime desc";
						$exec=$conn->query($query);
						while ($row=mysqli_fetch_array($exec)) {
							$id=$row['id'];
							$name=$row['name'];
						?>
						&nbsp;&nbsp;&nbsp;
						<span id="heading"><?php echo$name."<br>"; ?></span>
						<?php } ?>
					</div>
					<div class="panel-footer">
						
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Posts</h2>
					</div>
					<div class="panel-boby">
						<?php 
						global $conn;
						$query="SELECT * FROM admin ORDER BY datetime desc LIMIT 0,4";
						$exec=$conn->query($query);
						while ($row=mysqli_fetch_array($exec)) {
							$id=$row['id'];
							$title=$row['title'];
							$datetime=$row['datetime'];
							$image=$row['images'];
							if (strlen($datetime)>11){$datetime=substr($datetime,0,11);}
						?>
						<div>
							<img class="pull-left" style="margin-top: 10px; margin-left: 10px" src="upload/<?php echo htmlentities($image);?>" width=70; height=65;>
							<p id="heading" style="margin-left: 90px"><?php echo htmlentities($title);?></p>
							<p class="description" tyle="margin-left: 90px"><?php echo htmlentities($datetime);?></p><hr>
						</div>
						<?php } ?>
					</div>
					<div class="panel-footer">
						
					</div>
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
</body>
</html>