<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/body.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>

	<div class="header">
		<a href="index.php">Trang chủ</a>
		<a href="info.php">Tài khoản</a>
	</div>

    <a class="logout" href="logout.php">Đăng xuất</a>

    <h1>Xin chào, <?php echo $user_data['user_realname']; ?></h1>
	<a href="choose_a_printer.php"><img src="images/print_image.jpg" alt="Printing History"></a>
	
</script>
</body>
</html>