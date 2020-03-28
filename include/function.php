<?php
function redirect($new_location){
	header("Location:".$new_location);
	exit;
}
function login($User,$Pass){
	global $conn;
	$query="SELECT * FROM admins_reg WHERE username='$User' AND password='$Pass'";
	$exec=$conn->query($query);
	if($admin=mysqli_fetch_assoc($exec)){
		return $admin;
	}
	else{
		return null;
	}
}
function loged(){
	if(isset($_SESSION["id"])){
		return true;
	}
}
function clog(){
	if(!loged()){
		$_SESSION['ErrorMessage']="Login required";
		redirect("login.php");
	}
}
?>