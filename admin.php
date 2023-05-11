<?php
session_start();
	if(isset($_POST['btn_admin']))
	{
		$username=$_POST['uname'];
		$userpwd=$_POST['upwd'];
		if($username=="admin" && $userpwd=="admin")
		{
			$_SESSION['is_login']=true;
			header("Location: attend.php");
		}
	}


?>




<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-png" href="S6.png" />
	<title>Admin</title>
	<link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body> 
	<button onclick ="myFunction()" name="home" class="goback"><i class='fas fa-house-user' style='font-size:40px'></i><br>Home</button>
	
	<script>
		function myFunction(){ 
			location.replace("student&teacherLogin.php")
		}
	</script>
	<div class="container">
		<div class="img">
			<img src="bg.png">
		</div>
		<div class="login-content">
			<form method="post">
				<img src="avatar.png">
				<h3 class="title">Welcome Admin !!</h3>
                <br>
                <br>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Admin ID</h5>
           		   		<input type="text" class="input" name="uname" require autocomplete="off">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="upwd" require>
            	   </div>
            	</div>
            	<input type="submit" class="btn"  name="btn_admin"value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="admin.js"></script>
</body>
</html>

