<?php
			session_start();
			$host="localhost";
			$user="root";
			$password="";
			$db="sas";
			$con=mysqli_connect($host,$user,$password,$db);
			//Login for Student
			if(isset($_POST['btn_student']))//student log in
			{
				if(isset($_POST['student_id']))
				{
					$sid=$_POST['student_id'];
					$sql="select * from tbl_student where student_id='$sid'";
					$result=mysqli_query($con,$sql);
					if(mysqli_num_rows($result)==1)
					{
						$_SESSION['is_login']=true;
						$_SESSION['student_id']=$sid;
						header("Location: otp.php");//If login Suesses go to page for otp
					}
					else
					{
						echo '<script type ="text/JavaScript">';  
						echo 'swal({title: "Enter proper Student id ",
							
							icon: "error",
							button: "OK",});';
						echo '</script>';
							}
				
				}
			}
			if(isset($_POST['btn_teacher']))//Teacher login
			{

		
				if(isset($_POST['teacher_id']))//Teacher login
				{
					$tid=$_POST['teacher_id'];
					$tpwd=$_POST['password'];
					$sql="select * from tbl_teacher where teacher_id='$tid' and teacher_password='$tpwd'";
					$result=mysqli_query($con,$sql);
					if(mysqli_num_rows($result)==1)
					{
						$_SESSION['is_login']=true;
						$_SESSION['teacher_id']=$tid;
						header("Location: generate.php");//If login suesses go to page for generate otp
					}
					else
					{
						echo '<script type ="text/JavaScript">';  
						echo 'swal({title: "Enter proper id and password ",
							
							icon: "error",
							button: "OK",});';
						echo '</script>';
							}
				
				}
			}
			if(isset($_POST['btn_admin']))//for admin page
			{

				header("Location: admin.php");
			}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<link rel="shortcut icon" type="image/x-png" href="S6.png" />
    <title>sign in and sign up</title>

	<link rel="stylesheet" href="student&teacherlogin.css?v=<?php echo time(); ?>">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body >
	<form method="POST" style="background:rgba(255,255,255,0)">
		<button type="submit" class="buttonadmin" name="btn_admin"><img src="admin_icon.webp" height="80" width="100"></button>
	</form>	
	<div class="animation">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_AMIePv.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
	</div>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="#" method="post">
				<h3>Sign in For Student</h3>
				<div class="input-field">
					<i class="fa fa-user"></i>
					<input type="Text" name="student_id" placeholder="Student id" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" />
				</div>
				<button name="btn_student">Log in</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="#" method="post">
				<h3>Sign in For Teacher</h3>
				<div class="input-field">
					<i class="fa fa-user"></i>
					<input type="Text" name="teacher id" placeholder="Teacher Id" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off"/>
				</div>
				<div class="input-field">
					<i class='fa fas fa-lock'></i>
					<input type="password" name="password" placeholder="Password"/>
				</div>
				<button name="btn_teacher"><span>Log In </span></button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>For Tecaher</h1>
							<p>click the below button </p>
					<button class="ghost" id="signIn">Teacher</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>For Student</h1>
							<p>click the below button to make your Attendance</p>
					<button class="ghost" id="signUp">Student</button>
				</div>
			</div>
		</div>
	</div>

<script src="student&teacherlogin.js"></script> 
</body>
</html>
