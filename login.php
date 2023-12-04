<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$error_message = '';
		//something was posted

		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			$error_message = '<div class="error">Wrong username or password!</div>';
		}else
		{
			$error_message = '<div class="error">Wrong username or password!</div>';
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f0f0f0;
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}
		#box {
			background-color: white;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.1);
			padding: 20px;
			width: 300px;
		}
		#box h1 {
			text-align: center;
			color: #333;
		}
		#box input[type="text"], #box input[type="password"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
            box-sizing: border-box; /* Ensures padding doesn't add to total width */
            font-size: 16px; /* Increases font size */
		}
		#box input[type="submit"] {
			width: 100%;
			padding: 10px;
			border-radius: 5px;
			border: none;
			color: white;
			background-color: #007BFF;
            cursor:pointer; /* Changes the cursor on hover */
            transition-duration: 0.4s; /* Adds a transition effect */
		}
        #box input[type="submit"]:hover {
            background-color: #0056b3; /* Changes color on hover */
        }
		.error {
    		color: red;
    		font-weight: bold;
		}
	</style>
</head>
<body>
    <div id="box">
        <form method="post">
            <h1>Login</h1>
            <input type="text" name="user_name" placeholder="Nhập BK ID">
            <input type="password" name="password" placeholder="********">
			<?php 
            if (!empty($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

