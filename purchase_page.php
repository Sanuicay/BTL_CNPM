<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Mua trang in</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="css/purchase_page.css">
</head>
<body>
	<div class="header">
		<a href="info.php">Quay về Tài khoản</a>
	</div>

    <div class="content">
        <h2>Nhập số trang in muốn mua</h2>
        <form method="post">
            <input type="number" name="pages" required>
            <br>
            <input type="submit" value="Thanh toán qua BKPay">
        </form>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $pages = $_POST['pages'];
            if ($pages > 0) {
                $query = "update users set user_page_left = user_page_left + '$pages' where user_id = '".$user_data['user_id']."' limit 1";
                mysqli_query($con, $query);
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = date('d-m-Y, H:i:s');
                $query = "update users set user_purchase_history = concat('[$date] Đã mua $pages trang <br>\n', user_purchase_history) where user_id = '".$user_data['user_id']."' limit 1";
                mysqli_query($con, $query);
                header("Location: info.php");
                die;
            } else {
                echo "<p style='color:red'>Số trang không hợp lệ</p>";
            }
        }
    ?>
    </div>
</body>
</html>
