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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-png" href="S6.png" />
    <title>QR code</title>
    <!-- StyleSheet -->
    <link rel="stylesheet" href="generate.css?v=<?php echo time(); ?>" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b6b9586b26.js" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script>
        $(document).ready(function () {
                $("#department_id1").on('change',function () {
                    $(this).find("option:selected")
                        .each(function () {
                        var optionValue = $(this).attr("value");
                        var lastChar = optionValue.slice(-1);
                        if (lastChar) {
                            $(".subject_codeSelction").not("." + lastChar).hide();
                            $("." + lastChar).show();
                        } else {
                            $(".subject_codeSelction").hide();
                        }
                    });
                }).change();
            });
            
    </script>
  </head>
  <body>
    <div class="name">
      <form action="logout.php" method="POST" >
        <button type="submit" class="buttonlogout" >Logout <i class="fa fa-sign-out" ></i></button>
      </form>
      <?php
        include 'phpqrcode/qrlib.php';//Add qr library
        $host="localhost";
        $user="root";
        $password="";
        $db="sas";		
        $con=mysqli_connect($host,$user,$password,$db);
        $teacher_id=$_SESSION['teacher_id'];
        $sql1="select teacher_name,department_id from tbl_teacher where teacher_id='$teacher_id'";
        $result1=mysqli_query($con,$sql1);
        $department_id=" ";
        $teacher_name=" ";
        while ($row = mysqli_fetch_array($result1)) //get the teacher name and department name
        {
					$teacher_name=$row['teacher_name'];
          $department_idH=$row['department_id'];
				}
        $department_idG=substr($department_idH,0,-1).'G';//To chance the last value

        echo '<div class="header">';
        echo'<font size="30px">W</font>elcome ';
        echo  $teacher_name;
        echo' ... ';
        echo'<i class="fas fa-pen-alt" style="font-size:36px"></i>';
        echo'</div>';
        $num="";
        if(isset($_POST['btn_qr']))//
        {
          if(isset($_POST['subject_code']))//store the value in tbl_qrdetails
          {
            $sub_cod=$_POST['subject_code'];
            $department_id1=$_POST['department_id1'];
            
            global $num;
            $num=random_int(1000,9999);
            $duration=$_POST['duration'];
            date_default_timezone_set('Asia/Kolkata');
            $date1=date("Y-m-d");
            $time1=date("H:i:s");
            $sql="INSERT INTO `tbl_qrdetails` (`sl_no`, `teacher_id`, `passkey`,`department_id`, `duration`, `subject_code`, `start_time`,`date`) VALUES (NULL, '$teacher_id', '$num','$department_id1', $duration, '$sub_cod','$time1','$date1');";
            $_SESSION['num']=$num;
            $result=mysqli_query($con,$sql);
            if($result==1)
            {
              echo '<script type ="text/JavaScript">';  
              echo 'alert("You have suess fully generate qr")';  
              echo '</script>';
            }
            else
            {
              echo '<script type ="text/JavaScript">';  
              echo 'alert("Plz cheak the information properly")';  
              echo '</script>';
            }
            //Qr generate
            $text =$department_id1.";".$sub_cod.";".$duration;
            $path = 'qr_image/';
            $file = $path.uniqid().".png";
            $ecc = 'L';
            $pixel_Size = 10;
            QRcode::png($text, $file,$ecc, $pixel_Size);
              
          }
        }
        //For the delete 
        if(isset($_POST['btn_delete']))
        {
            if(isset($_SESSION['num']))
            {
              $num1=$_SESSION['num'];
              $sql2="DELETE FROM `tbl_qrdetails` WHERE passkey=$num1 ";
              $result2=mysqli_query($con,$sql2);
              if($result2==1)
              {
                echo '<script type ="text/JavaScript">';  
                echo 'alert("QR Deleted")';  
                echo '</script>';
                unset($_SESSION["num"]);
              }
              else
              {
                echo '<script type ="text/JavaScript">';  
                echo 'alert("Somthing missing")';  
                echo '</script>';
              }
            }
            else
              {
                echo '<script type ="text/JavaScript">';  
                echo 'alert("create the qr first")';  
                echo '</script>';
              }
        }
      ?>
    </div>
    <div id="container">
      <form method="POST" >
        <div id="left">
          <div id="in">
            <p> QR CODE GENERATOR</p>
            <select name="department_id1" id="department_id1">
              <option value=<?php echo $department_idH?>><?php echo $department_idH?></option>
              <option value=<?php echo $department_idG?>><?php echo $department_idG?></option>
            </select>
            <div class="A subject_codeSelction">
                <select name="subject_code" class="subject_code" >
                <option disabled selected value> -- select Subject_code -- </option>
                  <?php 
                  $sql3="SELECT * FROM `tbl_subject` WHERE `subject_type` LIKE 'Honours'  ";
                  $result3=mysqli_query($con,$sql3);//check The subject code is Honours
                  while($rows=mysqli_fetch_assoc($result3))
                    {
                  ?>
                      <option value=<?php echo $rows['subject_code']?>><?php echo $rows['subject_code']?></option>

                  <?php
                    }
                  ?>
                </select>
            </div>
            <div class="G subject_codeSelction">
                <select name="subject_code" class="subject_code" >
                  <option disabled selected value> -- select Subject_code -- </option>
                  <?php 
                  $sql4="SELECT * FROM `tbl_subject` WHERE `subject_type` LIKE 'General'  ";
                  $result4=mysqli_query($con,$sql4);//check The subject code is General
                  while($rows=mysqli_fetch_assoc($result4))
                    {
                  ?>
                      <option value=<?php echo $rows['subject_code']?>><?php echo $rows['subject_code']?></option>

                  <?php
                    }
                  ?>
                </select>
            </div>
            <input type="number" class="time1" name="duration"  placeholder="Enter duration"  required/>
            Passkey is : 
            <?php
              if($num==NULL)//show passkey
              {
                echo " ";
              }
              else
              {
                echo $num;
              }
            ?>
            <div class="ad">
              <button type="SUBMIT" class="buttongen" name="btn_qr"  >Generate <i class='fas fa-qrcode' ></i></button>
      </form>
              <form method="post">
                <button type="SUBMIT" class="buttondel" name="btn_delete"  >Delete <i class="fa fa-trash-o"></i></button>
              </form>
            </div>
          </div>
        </div>
        
      <div id="right">
        <div id="image">
          <?php
            echo "<img src='".$file."'>";//Qr image show
          ?>
        </div>
      </div>
    </div>  
  </body>
</html>