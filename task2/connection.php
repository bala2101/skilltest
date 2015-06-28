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

$queryCreateDataTable = "CREATE TABLE IF NOT EXISTS data(Id MEDIUMINT NOT NULL PRIMARY KEY AUTO_INCREMENT, Act INT, Title VARCHAR(500) NOT NULL, Month TEXT(10), Year INT, Date VARCHAR(11), Time VARCHAR(20), pdfoglozony VARCHAR(50), pdfxadfs VARCHAR(50), wiza VARCHAR(50), wizaxml VARCHAR(50), pozycja VARCHAR(50), pdfsource VARCHAR(50), lapx VARCHAR(50), htmlfile VARCHAR(50), flag TEXT NOT NULL)"; // check if the data table exits or not. If not, create a new profile table.

if(mysqli_query($conn, $queryCreateDataTable)){}else{echo "Error creating data table:".mysqli_error($conn);}
?>