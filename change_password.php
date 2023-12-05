<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $login = $_POST['login'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    if(!empty($login) && !empty($oldpassword) && !empty($newpassword) && !empty($confirmpassword)){
        $query = "select * from users where user_name = '$login' limit 1";
        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $oldpassword){
                    if($newpassword === $confirmpassword){
                        $query = "update users set password = '$newpassword' where user_name = '$login' limit 1";
                        mysqli_query($con, $query);
                        echo "<script>alert('Đổi mật khẩu thành công!');</script>";
                    } else {
                        echo "<script>alert('Mật khẩu mới không khớp!');</script>";
                    }
                } else {
                    echo "<script>alert('Sai mật khẩu cũ!');</script>";
                }
            }
        }
    }else{
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change password</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content=
  "width=device-width, initial-scale=1.0">
  <meta name="author" content="LDAP Tool Box">
  <link rel="stylesheet" type="text/css" href=
  "css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href=
  "css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href=
  "css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href=
  "css/self-service-password.css">
  <link href="images/favicon.ico" rel="icon" type="image/x-icon">
  <link href="images/favicon.ico" rel="shortcut icon">
</head>
<body>
  <div class="container">
    <div class="panel panel-success">
      <div class="panel-body">
        <div class="navbar-wrapper">
          <div class="navbar navbar-default navbar-static-top"
          role="navigation">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle"
                data-toggle="collapse" data-target=
                ".navbar-collapse"><span class="sr-only">Toggle
                navigation</span></button> <a class="navbar-brand"
                href="index.php"> Change password</a>
              </div>
              <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="">
                    <a href="?action=sendtoken" data-toggle=
                    "menu-popover" data-content=
                    "Email a password reset link">Reset Password by
                    Email</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="result alert alert-success">
          <p>Change your password</p>
        </div>
        <div class="alert alert-info">
          <form action="#" method="post" class="form-horizontal">
            <div class="form-group">
              <label for="login" class=
              "col-sm-4 control-label">Username</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="text" name="login" id="login" value=
                  "" class="form-control" placeholder="Username">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="oldpassword" class=
              "col-sm-4 control-label">Old password</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="password" name="oldpassword" id=
                  "oldpassword" class="form-control" placeholder=
                  "Old password">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="newpassword" class=
              "col-sm-4 control-label">New password</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="password" name="newpassword" id=
                  "newpassword" class="form-control" placeholder=
                  "New password">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="confirmpassword" class=
              "col-sm-4 control-label">Confirm</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="password" name="confirmpassword" id=
                  "confirmpassword" class="form-control"
                  placeholder="Confirm">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class=
                "btn btn-success">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.3.1.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script>

    $(document).ready(function(){
        // Menu links popovers
        $('[data-toggle="menu-popover"]').popover({
            trigger: 'hover',
            placement: 'bottom',
            container: 'body' // Allows the popover to be larger than the menu button
        });
    });
  </script>
</body>
</html>