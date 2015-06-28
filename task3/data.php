<?php
include("connection.php");

$query="SELECT Firstname,Lastname FROM users"; 
	
	$result = mysqli_query($conn,$query);

?>

<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="Bala Jaswanth">
  <meta name="Description" content="A simple website">
  <title>Reserved Candidates</title>
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
		<h2>Applied Candidates</h2></br></br></br> 
		
		<div id = "data">
			<form name = "data">
				<table>
					<tr>
						<th>S.No</th>
						<th>Firstname</th>
						<th>Lastname</th>
					</tr>
<?php
		$count=0;
		if(!$result){
			echo "<p>No candidate registered yet.</p>";
		} else {
			while($row = mysqli_fetch_array($result)){ 
				$count++;
				echo "<tr>".
					 "<td>".$count."</td>".
					 "<td>".$row['Firstname']."</td>".
					 "<td>".$row['Lastname']."</td>".
					 "</tr>";
			}
		}
	
?>
		</table>
		</form>
	</div>
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
