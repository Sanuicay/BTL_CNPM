<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/body.css">
	<link rel="stylesheet" href="css/info.css">
</head>
<body>
	<div class="header">
		<a href="index.php"> Quay về Trang chủ</a>
	</div>

    <h1>
    Thông tin tài khoản
    </h1>
	Tên: <?php echo $user_data['user_realname']; ?><br>
    ID: <?php echo $user_data['user_name']; ?><br>
    Số trang in còn lại: <?php echo $user_data['user_page_left']; ?><br>

    <div class="content">
        <a href="print_history.php"><img src="images/print_history_image.jpg" alt="Printing History"></a>
        <a href="purchase_page.php"><img src="images/purchase_page_image.jpg" alt="Purchase Page"></a> 
        <a href="purchase_page_history.php"><img src="images/purchase_history_image.jpg" alt="Purchase History"></a> 
    </div>

</body>
</html>


