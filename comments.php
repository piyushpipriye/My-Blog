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
<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
<li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
<li><a href="category.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
<li><a href="admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
<li class="active"><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
</ul>
</div>
<div class="col-sm-10">
	<div> <?php echo Message(); 
			echo SuccessMessage();?> </div>
<h1>Un-Approved Comments</h1>
<div class="table-responsive">
	<table class="table table-stripped table-hover">
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Date</th>
			<th>Comment</th>
			<th>Approve</th>
			<th>Delete</th>
			<th>Details</th>
		</tr>
		<tr>
		<?php
			global $conn;
			$view = "SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
			$exec  =  $conn->query($view);
			$sr = 0; 
			while ($data = mysqli_fetch_array($exec)) {
				$postid = $data["id"];
				$datetime = $data["datetime"];
				$name = $data["name"];
				$comment = $data["comment"];
				$admin_id = $data["admin_id"];
				$sr++;
				if(strlen($name)>10){$name = substr($name,0,10).'...';}
		?>
			<td><?php echo htmlentities($sr);?></td>
			<td style="color: #5e5eff;"><?php echo htmlentities($name);?></td>
			<td><?php echo htmlentities($datetime);?></td>
			<td><?php echo htmlentities($comment);?></td>
			<td><a href="approvecom.php?id=<?php echo$postid?>"><span class="btn btn-success">Approve</span></a></td>
			<td><a href="deletecom.php?id=<?php echo$postid?>"><span class="btn btn-danger">Delete</span></a></td>
			<td><a href="fullpost.php?id=<?php echo $admin_id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
		</tr>
		<?php } ?>
	</table>
</div>

<h1>Approved Comments</h1>
<div class="table-responsive">
	<table class="table table-stripped table-hover">
		<tr>
			<th>No.</th>
			<th>Name</th>
			<th>Date</th>
			<th>Comment</th>
			<th>Approved By</th>
			<th>Revert Approve</th>
			<th>Delete</th>
			<th>Details</th>
		</tr>
		<tr>
		<?php
			global $conn;
			$view = "SELECT * FROM comments WHERE status='on' ORDER BY datetime desc";
			$exec  =  $conn->query($view);
			$sr = 0; 
			while ($data = mysqli_fetch_array($exec)) {
				$postid = $data["id"];
				$datetime = $data["datetime"];
				$name = $data["name"];
				$comment = $data["comment"];
				$addby = $data["addby"];
				$admin_id = $data["admin_id"];
				$sr++;
				if(strlen($name)>10){$name = substr($name,0,10).'...';}
		?>
			<td><?php echo htmlentities($sr);?></td>
			<td style="color: #5e5eff;"><?php echo htmlentities($name);?></td>
			<td><?php echo htmlentities($datetime);?></td>
			<td><?php echo htmlentities($comment);?></td>
			<td><?php echo htmlentities($addby);?></td>
			<td><a href="disapprovecom.php?id=<?php echo$postid?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
			<td><a href="deletecom.php?id=<?php echo$postid?>"><span class="btn btn-danger">Delete</span></a></td>
			<td><a href="fullpost.php?id=<?php echo $admin_id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
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
<div style="height:10px; background:#27AAF1;"></div>
</body>
</html>