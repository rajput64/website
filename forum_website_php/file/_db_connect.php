<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "forum_website";

$conn = mysqli_connect($servername,$username,$password,$db);

if(!$conn){
    die("error connecting database: " .mysqli_connect_error());
}

?>