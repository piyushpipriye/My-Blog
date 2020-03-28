<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php
if(isset($_POST["Submit"])){
	$Username =  $_POST["Username"];
	$Password =  $_POST["Password"];
	if(empty($Username) || empty($Password)){
		$_SESSION['ErrorMessage']="All fields must be filled out";
		redirect("login.php");
	}
	else {
		$found=login($Username,$Password);
		$_SESSION["id"]=$found["id"];
		$_SESSION["user"]=$found["username"];
		if($found){
			$_SESSION['SuccessMessage']="Welcome {$_SESSION["user"]}";
			redirect("dashboard.php");
		}
		else{
			$_SESSION['ErrorMessage']="Invalid credentials";
			redirect("login.php");
		}
	}
}
?>
<!DOCTYPE>
<html>
<head>
<title>Log-in</title>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/adminstyle.css">
<style>
.fieldinfo{
	color:rgb(251,174,44);
	font-family:Bitter,Georgia,"Times New Roman",Times,serif;
	font-size:1.2em;
}
body{
	background-color: #ffffff;
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

</div>
</div>
</nav>
<div class="line" style="height:10px; background:#27aae1;"></div>
<div class="container-fluid">
<div class="row">
<div class="col-sm-offset-4 col-sm-4">
	<br><br><br><br>
	<div> <?php echo Message();
echo SuccessMessage(); ?> </div>
<h2>Welcome Back</h2>
<div>
<form action="login.php" method="post">
<fieldset>
<div class="form-group">
<label for="Username"><span class="fieldinfo">Username:</span></label>
<div class="input-group input-group-lg">
<span class="input-group-addon">
			<span class="glyphicon glyphicon-envelope text-primary"></span>
		</span>
<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
</div>
</div>
<div class="form-group">
<label for="Password"><span class="fieldinfo">Password:</span></label>
<div class="input-group input-group-lg">
<span class="input-group-addon">
			<span class="glyphicon glyphicon-lock text-primary"></span>
		</span>
<input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
</div>
</div>
<br>
<input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
<br>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>