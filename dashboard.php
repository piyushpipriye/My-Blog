<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php clog() ?>
<!DOCTYPE>
<html>
<head>
<title>Admin Dashboard</title>
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
	<br><br>
<ul class="nav nav-pills nav-stacked" id="sidemenu">
<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
<li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
<li><a href="category.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
<li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;
	<?php
				global $conn;
				$view = "SELECT * FROM comments WHERE status='off'";
				$result=$conn->query($view);
				$cnt=mysqli_num_rows($result);
				if($cnt>0){
				?>
				<span class="label pull-right label-warning">
				<?php echo $cnt;	?>
				</span>
				<?php } ?>Comments</a></li>
<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
</ul>
</div>
<div class="col-sm-10">
	<div> <?php echo Message(); 
			echo SuccessMessage();?> </div>
<h1>Admin Dashboard</h1>
<div>
	<div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<th>NO.</th>
			<th>Post</th>
			<th>Date & Time</th>
			<th>Author</th>
			<th>Category</th>
			<th>Banner</th>
			<th>Comments</th>
			<th>Action</th>
			<th>Details</th>
		</tr>
		<?php  
			global $conn;
			$view = "SELECT * FROM admin ORDER BY datetime desc";
			$exec  =  $conn->query($view);
			$sr = 0; 
			while ($data = mysqli_fetch_array($exec)) {
				$postid = $data["id"];
				$datetime = $data["datetime"];
				$title = $data["title"];
				$category = $data["category"];
				$author = $data["author"];
				$image = $data["images"];
				$post = $data["post"];
				$sr++;
		?>
		<tr>
			<td><?php echo$sr;?></td>
			<td style="color:#5e5eff"><?php 
			if(strlen($title)>20){$title = substr($title,0,20).'..';}
			echo$title;?></td>
			<td><?php 
			if(strlen($datetime)>11){$datetime = substr($datetime,0,11).'..';}
			echo$datetime;?></td>
			<td><?php 
			if(strlen($author)>6){$author = substr($author,0,6).'..';}
			echo$author;?></td>
			<td><?php 
			if(strlen($category)>8){$category = substr($category,0,8).'..';}
			echo$category;?></td>
			<td><img src="upload/<?php echo$image;?>" width="170"; height="75px"></td>
			<td>
				<?php
				global $conn;
				$view = "SELECT * FROM comments WHERE admin_id='$postid' AND status='on'";
				$result=$conn->query($view);
				$cnt=mysqli_num_rows($result);
				if($cnt>0){
				?>
				<span class="label pull-right label-success">
				<?php echo $cnt;	?>
				</span>
				<?php } ?>



				<?php
				global $conn;
				$view = "SELECT * FROM comments WHERE admin_id='$postid' AND status='off'";
				$result=$conn->query($view);
				$cnt=mysqli_num_rows($result);
				if($cnt>0){
				?>
				<span class="label pull-left label-danger">
				<?php echo $cnt;	?>
				</span>
				<?php } ?>
			</td>
			<td><a href="editpost.php?Edit=<?php echo$postid?>"><span class="btn btn-warning">Edit</span></a>
			<a href="deletepost.php?Delete=<?php echo$postid?>"><span class="btn btn-danger">Delete</span></a></td>
			<td><a href="fullpost.php?id=<?php echo$postid?>"b target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
		</tr>
		<?php }  ?>
	</table>
	</div>
</div>
</div>
</div>
</div>
<div id="Footer">
<hr><p>Theme By | Piyush Pipriye | &copy;2016-2020 ---All right reserved. </p>
<a style="color:white; text-decoration: none; cursor: pointer; font-weight:bold;" href="https://github.com/piyushpipriye" target="_blank">
<p>This is the site only used for study purpose piyushpipriye have all the rights. no one is allow copies other then <br>&trade; piyushpipriye
&trade; Udemy &trade; Skillshare; &trade; Stackskills </p></a><hr>
</div>
<div style="height:10px; background:#27AAF1;">
</div>
</body>
</html>