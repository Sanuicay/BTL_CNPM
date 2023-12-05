<?php 
session_start();

include("connection.php");
include("functions.php");
require_once 'vendor/autoload.php';

$user_data = check_login($con);

if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $copies = $_POST['copies'];

    if ($file['error'] > 0) {
        echo "Error: " . $file["error"] . "<br>";
    } else {
        $filename = $file['name'];
        $filetype = $file['type'];
        $filepath = 'uploads/' . $filename;

        move_uploaded_file($file['tmp_name'], $filepath);

        if ($filetype == 'application/pdf') {
            $pdf = new \setasign\Fpdi\Fpdi();
            $pages = $pdf->setSourceFile($filepath);
        } elseif ($filetype == 'application/msword' || $filetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($filepath);
            $sections = $phpWord->getSections();
            $pages = count($sections);
        }

        $total_pages = $pages * $copies;

        if($total_pages > $user_data['user_page_left']){
            echo "Không đủ trang in";
            echo "<br>";
            echo "<a href='purchase_page.php'>Mua thêm trang in ?</a>";
            echo "<a href='index.php'>Thoát</a>";
        } else {
            if ($total_pages > 0) {
                $query = "UPDATE users SET user_page_left = user_page_left - '$total_pages' WHERE user_id = '".$user_data['user_id']."' LIMIT 1";
                mysqli_query($con, $query);
            
                if (isset($_GET['printer_name'])) {
                    list($selected_printer, $printer_status) = explode(' - ', $_GET['printer_name']);
                    if ($printer_status != 'FAILED') {
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $date = date('d/m/Y, H:i:s');
                        $query = "UPDATE users SET user_print_history = CONCAT('[$date] In $total_pages trang ở máy $selected_printer <br>\n', user_print_history) WHERE user_id = '".$user_data['user_id']."' LIMIT 1";
                        mysqli_query($con, $query);

                        echo "<script>
                        setTimeout(function() {
                            alert('Đang in tài liệu, vui lòng đợi trong giây lát');
                        }, 1000);
                        setTimeout(function() {
                            alert('Đã in xong');
                            window.location.href = 'print_history.php';
                        }, 5000);
                        </script>";
                        unlink($filepath);
                    }
                }
            } else {
                echo "Invalid number of pages";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>In tài liệu</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/body.css">
    <link rel="stylesheet" href="css/choose_a_printer.css">
</head>
<body>

	<div class="header">
		<a href="index.php">Quay về Trang chủ</a>
	</div>
    <br>
    <div class="content">
    <h2>Chọn máy in:</h2>

    <?php
    $query = "SELECT * FROM printers";
    $result = mysqli_query($con, $query);

    echo "<form method='get' action=''>";
    echo "<select id='printer_name' name='printer_name' onchange='getSelectedValue()'>";

    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['printer_name'] . " - " . $row['printer_status'] . "'>" . $row['printer_name'] . " - " . $row['printer_status'] . "</option>";
    }

    echo "</select>";
    echo "<br>";
    echo "<input type='submit' value='Chọn'>";
    echo "</form>";

    if (isset($_GET['printer_name'])) {
        list($selected_printer, $printer_status) = explode(' - ', $_GET['printer_name']);
        if ($printer_status != 'OK') {
            echo "Không thể chọn máy in này.";
        } else {
            echo "Đã chọn: " . $selected_printer;
            echo "<br>";

        }
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <h2>Chọn 1 File Word hoặc PDF</h2>
        <input type="file" name="file" id="file" accept=".doc,.docx,.pdf">
        <br>
        <h2>Số lượng bản in:</h2>
        <input type="number" name="copies" id="copies" min="1" required>
        <br>
        <h2>Chọn cỡ giấy: </h2>
        <input type="radio" id="A5" name="paper_size" value="A5">
        <label for="A4">A5</label>
        <input type="radio" id="A4" name="paper_size" value="A4">
        <label for="A4">A4</label>
        <input type="radio" id="A3" name="paper_size" value="A3">
        <label for="A3">A3</label>
        <br>
        <h2>Chọn kiểu in: </h2>
        <input type="radio" id="portrait" name="orientation" value="portrait">
        <label for="portrait">Dọc</label>
        <input type="radio" id="landscape" name="orientation" value="landscape">
        <label for="landscape">Ngang</label>
        <br>
        <input type="submit" name="submit" value="Xác nhận in">
    </form>
    <br>
    <a href="customer_service.php">Gặp vấn dề?</a>
    </div>
</body>
</html>
