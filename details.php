<?php 
	session_start();
?>
<?php 
	$conn=mysqli_connect('localhost','varsha','abc123456','login');
	if(!$conn){
	echo "Connection error".mysqli_connect_error();
	}
	$req_email=mysqli_real_escape_string($conn,$_POST['req_email']);
	$sql="SELECT * FROM user where email='$req_email'";
	$res=mysqli_query($conn,$sql);
	$users=mysqli_fetch_all($res,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
</head>
<body style="background-color: Cornsilk;" ><center>
	<div style="padding-top: 300px">
		<p>Details of required user(<?php echo $req_email; ?>) : </p>
		<?php foreach ($users as $row): ?>
			Name:<?php echo $row['name']."<br>"; ?>
			Email:<?php echo $row['email']."<br>"; ?>
			Phone number: <?php echo $row['phno']."<br>"; ?>
			Gender:<?php echo $row['gender']."<br><br><br><br>"; ?>
		<?php endforeach ?></div></center>
</body>
</html>