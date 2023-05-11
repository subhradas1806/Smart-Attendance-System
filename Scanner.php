
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-png" href="S6.png" />
    <title>QR code scanner</title>
    <link rel="stylesheet" type="text/css" href="scanner.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
</head>
<body>

    <?php
        session_start();
        $host="localhost";
        $user="root";
        $password="";
        $db="sas";		
        $con=mysqli_connect($host,$user,$password,$db);
        $teacher_id=$_SESSION['teacher_qr_id'];
        $passkey=$_SESSION['passkey'];
        $sql1="select teacher_name from tbl_teacher where teacher_id='$teacher_id'";
        $result1=mysqli_query($con,$sql1);
        $row = mysqli_fetch_assoc($result1);
        $teacher_name=$row['teacher_name'];
        if(isset($_POST['btn_Scanner']))
        {
            if(isset($_POST['subject_code']))
            {
                $department_id=$_POST['department_id'];
                $subject_code=$_POST['subject_code'];
                $duration=$_POST['duration'];
                $student_id=$_SESSION['student_id'];
                date_default_timezone_set('Asia/Kolkata');
                $date1=date("Y-m-d");
                $time1=date("H:i:s");
                $sql3="SELECT * FROM `tbl_qrdetails` where passkey=$passkey and teacher_id='$teacher_id' and subject_code='$subject_code' and department_id='$department_id' and date='$date1';";
                $result3=mysqli_query($con,$sql3);
                if(mysqli_num_rows($result3)==1)
                {

                    $sql2="select * from tbl_attendance where student_id='$student_id' and teacher_id='$teacher_id' and subject_code='$subject_code' and attendance_date='$date1' and department_id='$department_id';";
                    $result2=mysqli_query($con,$sql2);
                    if(mysqli_num_rows($result2)>=1)//cheak if the student scan or not
                    {
                        echo '<script type ="text/JavaScript">';  
						echo 'swal({title: "You have already give your attendance",
								
								icon: "error",
								button: "OK",}).then(function() {
                                    window.location = "student&teacherLogin.php";
                                });';
                        echo '</script>';
                        
                    }
                    else
                    {
                        if(isset($_POST['subject_code']))
                        {
                            $sql="INSERT INTO `tbl_attendance` (`attendance_id`,`student_id`,`teacher_id`,`department_id`,`subject_code`,`attendance_date`,`attendance_time`,`attendance_hours`)VALUES(NULL,'$student_id','$teacher_id','$department_id','$subject_code','$date1',' $time1','$duration');";
                            $result=mysqli_query($con,$sql);
                            if($result==1)
                            {
                                header("Location: student&teacherLogin.php");
                            }else{
                                echo "error";
                            }

                        }
                        else
                        {
                            header("Location: student&teacherLogin.php");
                        }
                        
                    }
                    
                }
                else
                    {
                        echo '<script type ="text/JavaScript">';  
							echo 'swal({title: "Qr not scanned!",
								
								icon: "error",
								button: "OK",}).then(function() {
                                    window.location = "student&teacherLogin.php";
                                });';
                            echo '</script>';
                    }
            }
        }
    ?>
   
    <div class="scanner">
    <div class ="left">
        <div class="qr">
            <video width="100%" height="100%" id="MyCameraOpen"></video>
        </div>
        <h3>Scanning ....</h3><br>
    </div>
    </div>
    <div class ="right">
        <form method="post">
            <span style="color:white">Teacher name: </span>
            <input type="text"  value="<?php echo $teacher_name ?>" readonly><br></br>
            <span style="color:white">Department name: </span>
            <input type="text"  id="department_id" name="department_id" readonly><br><br>
            <span style="color:white">Subject code: </span>
            <input type="text" id="subject_code" name="subject_code" readonly><br><br>
            <span style="color:white">Duration:     </span>
            <input type="text" id="duration" name="duration" readonly><br><br>
            <button  name="btn_Scanner" class="buttonlogout">Close <i class='fas fa-power-off'></i></button>
        </form>
    </div>
    
    <script>
            //step 1 start camera section
            var video = document.getElementById("MyCameraOpen");
            var subject_code = document.getElementById("subject_code");
            //window.course="NULL";
            var department_id = document.getElementById("department_id");
            var course = document.getElementById("course");
            //var date = document.getElementById("date");
            var scanner = new Instascan.Scanner({
                video : video
            });
            Instascan.Camera.getCameras()
            .then(function(Our_Camera){
                if(Our_Camera.length > 0){
                    scanner.start(Our_Camera[0]);
                   
                }else{
                    alert("camera failed");
                }
            })
            .catch(function(error){
                console.log("error please try again");
            })


            // input text section step 2
            scanner.addListener('scan',function(input_value)
            {
                if((input_value)!=" ")
                {
                    var str1=input_value;
                    var array=str1.split(";");
                    var dep=array[0];
                    var sub=array[1];
                    var dur=array[2];
                    department_id.value=dep;
                    subject_code.value=sub;
                    duration.value=dur;
                    swal({
                        title: "Successfully Scan!",
                        text: "Submitted",
                        icon: "success",
                        button: "OK",
                    });
                    //window.replace
                }
            })
        </script>
        
    
</body>
</html>