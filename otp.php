<?php
  session_start();
  if($_SESSION['is_login']){
    //keep user on page
  }else{
    header("Location: student&teacherLogin.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-png" href="S6.png" />
	<title>Otp Page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="otp.css?v=<?php echo time(); ?>">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<form action="logout.php" method="POST" style="background:rgba(255,255,255,0)">
      	<button type="submit" class="buttonlogout" >LogOut <i class="fa fa-sign-out" ></i></button>
    </form>
	<div class="right">
    </div>
	<div class="left">
		<form  method="post">
			<div class="container">
				<h1>ENTER PASSKEY</h1>
					<div class="userInput">
						<input type="text" id="ist" name="no1" maxlength="1" onkeyup="clickEvent(this,'sec')">
						<input type="text" id="sec" name="no2" maxlength="1" onkeyup="clickEvent(this,'third')">
						<input type="text" id="third" name="no3"  maxlength="1" onkeyup="clickEvent(this,'fourth')">
						<input type="text" id="fourth" name="no4" maxlength="1" >
					</div>
				<button name="btn_otp" >Verify</button>
			</div>
		</form> 
		<?php
			$host="localhost";
			$user="root";
			$password="";
			$db="sas";
			$con=mysqli_connect($host,$user,$password,$db);
			if(isset($_POST['btn_otp']))
			{
				$no1=$_POST['no1'];
				$no2=$_POST['no2'];
				$no3=$_POST['no3'];
				$no4=$_POST['no4'];
				if(isset($no1) && isset($no2) && isset($no3) && isset($no4))
				{
					$num=$no1.$no2.$no3.$no4;
				}
				$sql="select * from tbl_qrdetails where passkey='$num'";
				$result=mysqli_query($con,$sql);
				$teacher_id="";
				while ($row = mysqli_fetch_array($result))
				{
					$teacher_id=$row['teacher_id'];
					date_default_timezone_set('Asia/Kolkata');
					$date1=date("Y-m-d");
					$time1=date("H:i:s");
					$time=$row['start_time'];
					$date=$row['date'];
					$duration=$row['duration'];
					$to_time = strtotime("$time");
					$from_time = strtotime("$time1");
					$sub_time= round(abs($to_time - $from_time) / 3600,2). " hour";
				}
				if (mysqli_num_rows($result)==1 )
				{
					
					if ($date1 == $date)
					{
						if($sub_time<$duration)
						{
							echo "timmed in";
							echo $sub_time;
							$_SESSION['passkey']=$num;
							$_SESSION['is_otp']=true;
							$_SESSION['teacher_qr_id']=$teacher_id;
							header("Location: Scanner.php");
						}
						else
						{
							echo '<script type ="text/JavaScript">';  
							echo 'swal({title: "Time`s Up!",
										icon: "error",
										button: "OK",});';
							echo '</script>';
					
						}
					}
					else
					{
						echo '<script type ="text/JavaScript">';  
						echo 'swal({title: "Plz Enter Todays Passkey!",
									icon: "error",
									button: "OK",});';
						echo '</script>';
					}
				}
				else
				{
					echo '<script type ="text/JavaScript">';  
							echo 'swal({title: "Wrong Passkey",
								
								icon: "error",
								button: "OK",});';
                    echo '</script>';
				}
			
			}
		
		?>
		<script>
			function clickEvent(first,last)
			{
				if(first.value.length)
				{
					document.getElementById(last).focus();
				}
			}	
		</script>	
	</div>	
</body>
</html>