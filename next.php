<?php 
	session_start();
?>

<?php if(isset($_POST['go'])){
	header("location:details.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
</head>
<body style="background-color: Cornsilk;" ><center>
	<div style="padding-top: 300px">
	<p><?php echo "Details Submitted!!"; ?></p>
	<p>To know the details, enter the email id of the user</p>
	<form action="details.php" method="POST">
		<input type="text" name="req_email" required="required" placeholder="Enter the email id">
		<button type="submit" name="go">Go</button>
	</form></div></center>
</body>
</html>