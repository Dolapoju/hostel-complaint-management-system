<?php
$servername="yourservername";
$username="yourusername";
$password="yourpassword";
$database="complaint_management";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

?>