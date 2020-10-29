<?php session_start(); ?>
<?php
		$conn=mysqli_connect('localhost','varsha','abc123456','login');
		if(!$conn){
			echo "Connection error".mysqli_connect_error();
		}

		$name=$email=$phno=$gender="";
		$errors=array('name'=>'','email'=>'','phno'=>'','gender'=>'');

		if(isset($_POST['submit'])){
			if(empty($_POST['name'])){
				$errors['name']='Name is required <br>';
			}
			else{
				$name=$_POST['name'];
				if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
					$errors['name'] ='Enter a valid name <br>';
				}
			}
			if(empty($_POST['email'])){
				$errors['email']='Email is required <br>';
			}
			else{
				$email=$_POST['email'];
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$errors['email']='Enter a valid email<br>';
				}
			}
			if(empty($_POST['phno'])){
				$errors['phno']='Phone number is required <br>';
			}
			else{
				$phno=$_POST['phno'];
				if(!preg_match('/^[1-9]{10}$/', $phno)){
					$errors['phno']='Enter a valid phone number';
				}
			}
			if(empty($_POST['gender'])){
				$errors['gender']='Gender is required <br>';
			}
			else{
				$gender=$_POST['gender'];
			}

		if(array_filter($errors)){

			//errors
			}
		else{
				$name=mysqli_real_escape_string($conn,$_POST['name']);
				$email=mysqli_real_escape_string($conn,$_POST['email']);
				$phno=mysqli_real_escape_string($conn,$_POST['phno']);
				$gender=mysqli_real_escape_string($conn,$_POST['gender']);

				$query_email="SELECT email FROM user WHERE email='$email'";
				$res_email=mysqli_query($conn,$query_email);
				if(mysqli_num_rows($res_email)>0){
					$errors['email']='User already exists!!';
				}
				else{
					$query="INSERT INTO user(name,email,phno,gender) VALUES('$name','$email','$phno','$gender')";
					
					if(mysqli_query($conn,$query)){
						header('location:next.php');
						exit();
					}
					else{
						echo "Query error".mysqli_error($conn);
					}
				}
			}
		}
		mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body style="background-color: Cornsilk;" ><center>
	<div style="padding-top: 300px">
	<form action="submission_form.php" method="POST">
		<label>Name:</label>
		<input type="text" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>" >
		<div style="color: red"><?php echo $errors['name']; ?></div>
		<label>Email Id:</label>
		<input type="text" name="email" placeholder="Enter your email"  value="<?php echo htmlspecialchars($email); ?>">
		<div style="color: red"><?php echo $errors['email']; ?></div>
		<label>Phone no:</label>
		<input type="text" name="phno" maxlength="10" value="<?php echo htmlspecialchars($phno); ?>" >
		<div style="color: red"><?php echo $errors['phno']; ?></div>
		<label>Gender:</label>
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="female">Female
		<div style="color: red"><?php echo $errors['gender']; ?></div>
		<button type="submit" name="submit" value="submit">Submit</button>		
	</form></div></center>
</body>
</html>