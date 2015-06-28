<?php
$sqluser = "root";
$sqlpassword = "root";
$database = "task2";

$conn= mysqli_connect("localhost", $sqluser, $sqlpassword); // establishing connection to the database

if (!mysqli_select_db($conn, $database)) { // check if the database exits or not. If not, create a new database
	$qquery = "CREATE DATABASE `".$database."`";
    if(mysqli_query($conn, $qquery)){}else{echo "Error creating database:".mysqli_error($conn);}
    mysqli_select_db($conn, $database) or die( "Unable to select database");
}

$queryCreateUserTable = "CREATE TABLE IF NOT EXISTS users(Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, Firstname TEXT NOT NULL, Lastname TEXT NOT NULL, Email VARCHAR(50) NOT NULL)";

if(mysqli_query($conn, $queryCreateUserTable)){}else{echo "Error creating data table:".mysqli_error($conn);}
?>