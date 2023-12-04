<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lịch sử mua trang</title>
    <link rel="stylesheet" type="text/css" href="css/history.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/body.css">
</head>
<body>
	<div class="header">
		<a href="info.php">Quay về Tài khoản</a>
	</div>

    <div class="content">
        <div class="history">
            <h2>Lịch sử mua trang in:</h2>
            <br>
            <?php 
                if ($user_data['user_purchase_history'] == "") {
                    echo "No purchase history";
                } else {
                    $logs = explode("\n", $user_data['user_purchase_history']);
                    foreach ($logs as $log) {
                        echo "<div class='log'>" . $log . "</div>";
                    }
                } 
            ?>
        </div>
    </div>

</body>
</html>