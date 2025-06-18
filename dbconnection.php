<?php
$server = "localhost";
$username = "";
$password = "";
$database = "";

$conn = new mysqli($server, $username, $password, $database);


if ($conn->connect_error) {
    echo"error";
    die("Connection failed: " . $conn->connect_error);
}
else
{ 
	
}

?>