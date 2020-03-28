<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php 
if(isset($_GET["id"])){
	$id=$_GET["id"];
	global $conn;
	$query="DELETE FROM admins_reg WHERE id='$id'";
	$exec=$conn->query($query);
	if($exec){
		$_SESSION["SuccessMessage"] = "Admin deleted successfully";
		redirect("admins.php");
	}
	else{
		$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
		redirect("admins.php");
	}
}
?>