<?php
$con = mysqli_connect('localhost','root','','department');
if($con==TRUE)
	//echo "Connection Success";
if ($con->connect_error) {
    die("Error: " . mysqli_connect_error());
}
?>