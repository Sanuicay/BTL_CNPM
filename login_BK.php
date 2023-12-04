<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //something was posted

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)){
        $query = "select * from users where user_name = '$username' limit 1";
        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password){
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        
        echo "<script>alert('Sai tên tài khoản hoặc mật khẩu!');</script>";
    }else{
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
	    <title>HCMUT &#8211; Central Authentication Service</title>
        
		
        <link type="text/css" rel="stylesheet" href="css/cas.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <link rel="icon" href="/cas/favicon.ico" type="image/x-icon" />
	</head>
	<body id="cas" class="fl-theme-iphone">
    <div class="flc-screenNavigator-view-container">
        <div class="fl-screenNavigator-view">
            <div id="header" class="flc-screenNavigator-navbar fl-navbar fl-table">
              <div id="app-name" class="fl-table-cell">
                <img alt="BK" src="images/bk_logo.png">
                <h1>DỊCH VỤ XÁC THỰC TẬP TRUNG</h1>
                
              </div>
            </div>		
            <div id="content" class="fl-screenNavigator-scroll-container">




  <div class="box fl-panel" id="login">
			<form id="fm1" class="fm-v clearfix" method="post">
                  
                <!-- Congratulations on bringing CAS online!  The default authentication handler authenticates where usernames equal passwords: go ahead, try it out. -->
                
                    <h2>Nhập thông tin tài khoản của bạn</h2>
                    <div class="row fl-controls-left">
                        <label for="username" class="fl-label"><span class="accesskey">T</span>ên tài khoản</label>
						<input id="username" name="username" class="required" tabindex="1" accesskey="u" type="text" value="" autocomplete="false"/>
                    </div>
                    <div class="row fl-controls-left">
                        <label for="password" class="fl-label"><span class="accesskey">M</span>ật khẩu</label>
						
						
						<input id="password" name="password" class="required" tabindex="2" accesskey="p" type="password" value="" autocomplete="off"/>
                    </div>
                    <div class="row check">
                        <input id="warn" name="warn" value="true" tabindex="3" accesskey="w" type="checkbox" />
                        <label for="warn"><span class="accesskey">C</span>ảnh báo trước khi tôi đăng nhập vào các trang web khác.</label>
                    </div> 
                    <div class="row btn-row">
						<input type="hidden" name="lt" value="LT-10200470-UnFYGlteCaySxW4Eq1N6mWmDbCwW41" />
						<input type="hidden" name="execution" value="e2s1" />
						<input type="hidden" name="_eventId" value="submit" />
                        <input class="btn-submit" name="submit" value="Đăng nhập" tabindex="4" type="submit" />
						<input class="btn-reset" name="reset" value="Xóa" tabindex="5" type="reset" />
                    </div>
                    <div class="row support">
	                    <ul>
	                		<li class="first">
	                			<!-- <a href="https://account.hcmut.edu.vn/">Thay đổi mật khẩu?</a>  -->
	                		</li>
	                	</ul>
	            </div>
            </form>
          </div>
            <div id="sidebar">
				<div class="sidebar-content">
                <div id="list-languages" class="fl-panel">
                
					
                    
                  <h3>Ngôn ngữ</h3>
                  
                     
                     
                        
						<ul
							><li class="first"><a href="login?service=https%3A%2F%2Fe-learning.hcmut.edu.vn%2Flogin%2Findex.php%3FauthCAS%3DCAS&locale=vi">Tiếng Việt</a></li
							><li><a href="login?service=https%3A%2F%2Fe-learning.hcmut.edu.vn%2Flogin%2Findex.php%3FauthCAS%3DCAS&locale=en">Tiếng Anh	</a></li
						></ul>
                     
                   
                </div>
                <div id="list-notes" class="fl-panel">
                	<h3>Lưu ý</h3>
                	<p class="fl-panel fl-note fl-bevel-white fl-font-size-80">Trang đăng nhập này cho phép đăng nhập một lần đến nhiều hệ thống web ở trường Đại học Bách Khoa Tp.HCM. Điều này có nghĩa là bạn chỉ đăng nhập một lần cho những hệ thống web đã đăng ký với hệ thống xác thực quản lý truy cập tập trung.

                    </p>
                	<p class="fl-panel fl-note fl-bevel-white fl-font-size-80">Bạn cần dùng tài khoản HCMUT để đăng nhập. Tài khoản HCMUT cho phép truy cập đến nhiều tài nguyên bao gồm hệ thống thông tin, thư điện tử, ... </p>
                	<p class="fl-panel fl-note fl-bevel-white fl-font-size-80">Vì lý do an ninh, bạn hãy Thoát khỏi trình duyệt Web khi bạn kết thúc việc truy cập các dịch vụ đòi hỏi xác thực!</p>
                </div>
                
                <div id="list-supports" class="fl-panel">
                	<h3>Hỗ trợ kỹ thuật</h3>
                	<ul>
                		<li class="first">
                			E-mail: <a href="mailto:support@hcmut.edu.vn">support@hcmut.edu.vn</a>
                		</li>
                		<li>
                			ĐT: (84-8) 38647256 - 5200
                		</li>
                	</ul>
				</div>                
			  </div>
            </div>



</div>
                <div id="footer" class="fl-panel fl-note fl-bevel-white fl-font-size-80">
                	<a id="hcmut" href="http://www.hcmut.edu.vn" title="go to HCMUT home page"></a>
                    <div id="copyright">
                        <p>Bản quyền &copy; 2011 - 2012 Đại học Bách Khoa Tp. Hồ Chí Minh.</p>
                        <p>Được hỗ trợ bởi <a href="http://www.jasig.org/cas">Jasig CAS 3.5.1</a></p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/cas/js/cas.js"></script>
    </body>
</html>


