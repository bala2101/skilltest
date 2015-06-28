<?php
include("connection.php");
$numberOfSeats = 250;
$count = 0;
if(isset($_POST["submit"])){  // PHP form validation
		if(!$_POST['firstName']){
			$error .= "</br>Please enter your First Name.";
		}
		if(!$_POST['lastName']){
			$error .= "</br>Please enter your Last Name.";
		}
		if(!$_POST['email']){
			$error .= "</br>Please enter your email";
		}
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$error = "</br>Please enter a valid email";
		}
		if($_POST['email'] AND filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$emailQuery = "SELECT * FROM users";
			$result = mysqli_query($conn, $emailQuery);
			
			if(!$result){
				
			} else {
				while($row = mysqli_fetch_array($result)){
					if($_POST['email'] == $row['Email']){
						$error = "</br>Email already exits. Please register with a new email";
						break;
					}
				}
			}
		}
		if($count>= $numberOfSeats){
				$error = "</br>Seats are filled out. Sorry for the inconvenience";
				$result = '<div class = "alert alert-danger"><strong>There were error(s) in your form:</strong>'.$error.'</div>';
		}
		if(isset($error)){ // Displaying error message with little bootstrap
			$result = '<div class = "alert alert-danger"><strong>There were error(s) in your form:</strong>'.$error.'</div>';
		} else { // Displaying success message with little bootstrap
			$result = '<div class = "alert alert-success"><strong>Thank you for registering, we will get back to you as soon as possible.</strong></div>';	
			
			$errmsg = "";
		
			if($errmsg == ""){
						$query = "INSERT INTO `users` VALUES ('','".mysqli_real_escape_string($conn, $_POST['firstName'])."','".mysqli_real_escape_string($conn, $_POST['lastName'])."','".mysqli_real_escape_string($conn, $_POST['email'])."')";
			
						mysqli_query($conn, $query);

			}		
				
		}
}
?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="Bala Jaswanth">
  <meta name="Description" content="A simple website">
  <title>Registration Form</title>
  <link href="style.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

 </head>
 <body>
  <div id = "container" class = "container">
  <div class = "row">
  <div class = "col-md-8 col-md-offset-3 jobbody">
	<div id = "header">
		<ul id='menu'> 
			<li><a href='index.php'>Fill Form</a></li>|
			<li><a href='data.php'>View Data</a></li>
		</ul>
	</div>
	<div id = "main" class = "regform">
		<h2>Please fill the following form. Only limited seats are available!</h2></br></br></br> 
		<?php  // displaying the error messages.
			if(isset($result)){
				echo $result;
			}
		?>
		<form method = "POST" name ="regform" enctype = "multipart/form-data" > 
			<table>
				<tr><td><label for = "fname">First Name</label></br></br></td><td><input type="text" name="firstName" class = "form-group" value = "<?php if(isset($_POST['firstName'])){echo $_POST['firstName']; } ?>" placeholder = "First Name" required></td></tr>
				<tr><td><label for = "lname">Last Name</label></br></br></td><td><input type="text" name="lastName" class = "form-group" value = "<?php if(isset($_POST['lastName'])){echo $_POST['lastName']; } ?>" placeholder = "Last Name" required></td></tr>
				<tr><td><label for = "email">Email</label></br></br></td><td><input type="email" name="email" class = "form-group" value = "<?php if(isset($_POST['email'])){echo $_POST['email']; } ?>" placeholder = "Email" required></td></tr>
				<tr><td></br></br><input type="submit" value ="Submit" name="submit" class="btn btn-success btn-lg"></td></tr>
			</table>
		</form>
	</div>
	<div id = "footer">
		<p>&copy; <script>new Date().getFullYear()</script> Bala Jaswanth. All rights reserved.</p>
	</div>
	</div>
	</div>
  </div>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 </body>
</html>
