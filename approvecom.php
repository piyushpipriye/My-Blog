<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php 
if(isset($_GET["id"])){
	$id=$_GET["id"];
	global $conn;
	$admin =$_SESSION["user"];
	$query="UPDATE comments SET status='on', addby='$admin' WHERE id='$id'";
	$exec=$conn->query($query);
	if($exec){
		$_SESSION["SuccessMessage"] = "Comments approved successfully";
		redirect("comments.php");
	}
	else{
		$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
		redirect("comments.php");
	}
}
?>