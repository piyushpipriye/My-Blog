<?php require_once("include/DB.php"); ?>
<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php 
if(isset($_GET["id"])){
	$id=$_GET["id"];
	global $conn;
	$query="UPDATE comments SET status='off' WHERE id='$id'";
	$exec=$conn->query($query);
	if($exec){
		$_SESSION["SuccessMessage"] = "Comments dis-approved successfully";
		redirect("comments.php");
	}
	else{
		$_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
		redirect("comments.php");
	}
}
?>