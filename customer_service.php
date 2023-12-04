<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Service</title>
</head>
<body>
    <h1>GG</h1>
    <br>
    <a href="index.php">Về Trang chủ</a>
    <br>
</body>
</html>


