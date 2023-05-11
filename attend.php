<?php
  session_start();
  if($_SESSION['is_login']){
    //keep user on page
  }else{
    header("Location: student&teacherLogin.php");
  }
  $host="localhost";
  $user="root";
  $password="";
  $db="sas";
  $con=mysqli_connect($host,$user,$password,$db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-png" href="S6.png" />
    <title>Attendance Sheet</title>
    <link rel="stylesheet" href="attend.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
    <script>
        $(document).ready(function () {
                $("#option_value").change(function () {
                    $(this).find("option:selected")
                        .each(function () {
                        var optionValue = $(this).attr("value");
                        if (optionValue) {
                            $(".search_box").not("." + optionValue).hide();
                            $("." + optionValue).show();
                        } else {
                            $(".search_box").hide();
                        }
                    });
                }).change();
                $("#department_id1").on('change',function () {
                    $(this).find("option:selected")
                        .each(function () {
                        var optionValue = $(this).attr("value");
                        var lastChar = optionValue.slice(-1);
                        if (lastChar) {
                            $(".search_field_Subject").not("." + lastChar).hide();
                            $("." + lastChar).show();
                        } else {
                            $(".search_field_Subject").hide();
                        }
                    });
                }).change();
            });
            
    </script>
    
</head>

<body >
<form action="logout.php" method="POST" >
    <button type="submit" class="buttonlogout" >Logout <i class="fa fa-sign-out" ></i></button>
</form>
<div id="animation">
    <p><lottie-player src="https://assets9.lottiefiles.com/packages/lf20_yuyvmszl.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop  autoplay></lottie-player></p>
</div>
<div class="wrapper">
    <form method="post" >
        <select id="option_value"><!-- Option Selection-->
            <option value="dept">Department_id</option>
            <option value="student_id">Student_id</option>
            <option value="teacher_id">Teacher_id</option>
        </select>
        <div class="dept search_box" id="department11" ><!-- Department part Selection-->
            
            <div class="search_field">
                    <select name="dept"  class="input" id="department_id1" >
                    
                    <?php 
                    $sql10="SELECT * FROM `tbl_department` ";
                    $result10=mysqli_query($con,$sql10);//check The subject code is Honours
                    while($rows=mysqli_fetch_assoc($result10))
                        {
                    ?>
                        <option value=<?php echo $rows['department_id']?>><?php echo $rows['department_id']?></option>

                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="A search_field_Subject"  >
                <select name="subject" id="option_value_department" class="input" >
                    <option disabled selected value>Subject_code</option>
                    <?php 
                    $sql11="SELECT * FROM `tbl_subject` WHERE `subject_type` LIKE 'Honours'  ";
                    $result11=mysqli_query($con,$sql11);//check The subject code is Honours
                    while($rows=mysqli_fetch_assoc($result11))
                        {
                    ?>
                        <option value=<?php echo $rows['subject_code']?>><?php echo $rows['subject_code']?></option>

                    <?php
                        }
                    ?>
                </select>
                <button name="search" id="hide" class="btn1" ><i class="fas fa-search" ></i></button>
            </div>
            <div class="G search_field_Subject">
                <select name="subject" id="option_value_department" class="input" >
                    <option disabled selected value>Subject_code</option>
                    <?php 
                    $sql12="SELECT * FROM `tbl_subject` WHERE `subject_type` LIKE 'General'  ";
                    $result12=mysqli_query($con,$sql12);//check The subject code is Honours
                    while($rows=mysqli_fetch_assoc($result12))
                        {
                    ?>
                        <option value=<?php echo $rows['subject_code']?>><?php echo $rows['subject_code']?></option>

                    <?php
                        }
                    ?>
                </select>
                <button name="search" id="hide" class="btn1" ><i class="fas fa-search" ></i></button>
            </div>
        </div>

        <div class="student_id search_box"><!-- Student_id Selection-->
            <div class=" search_field">
                <input type="text" class="input" name="student_id" placeholder="Student_id" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">
                <i class="fas fa-long-arrow-alt-right" class="icon_arrow"></i> 
            </div>  
            <div class=" search_field">
            <select name="subject1" id="option_value_student" class="input" >
                    <option >Subject_code </option>
                    <?php 
                    $sql20="SELECT * FROM `tbl_subject` ";
                    $result20=mysqli_query($con,$sql20);//check The subject code is Honours
                    while($rows=mysqli_fetch_assoc($result20))
                        {
                    ?>
                        <option value=<?php echo $rows['subject_code']?>><?php echo $rows['subject_code']?></option>

                    <?php
                        }
                    ?>
                    
                </select>
                <button name="search1" id="hide" class="btn1"><i class="fas fa-search" ></i></button>
            </div>
        </div>
        <div class="teacher_id search_box"><!-- Teacher part Selection-->
            <div class=" search_field">
                    <select name="teacher_id"  class="input" >
                    <option disabled selected value>Teacher_id</option>
                    <?php 
                    $sql30="SELECT * FROM `tbl_teacher` ";
                    $result30=mysqli_query($con,$sql30);//check The subject code is Honours
                    while($rows=mysqli_fetch_assoc($result30))
                        {
                    ?>
                        <option value=<?php echo $rows['teacher_id']?>><?php echo $rows['teacher_id']?></option>

                    <?php
                        }
                    ?>
                </select>
                <i class="fas fa-long-arrow-alt-right" class="icon_arrow"></i> 
            </div>  
            <div class=" search_field">
                <select name="subject2" id="option_value_department" class="input" >
                    <option disabled selected value>Subject_code</option>
                    <?php 
                    $sql31="SELECT * FROM `tbl_subject` ";
                    $result31=mysqli_query($con,$sql31);//check The subject code is Honours
                    while($rows=mysqli_fetch_assoc($result31))
                        {
                    ?>
                        <option value=<?php echo $rows['subject_code']?>><?php echo $rows['subject_code']?></option>

                    <?php
                        }
                    ?>
                </select>
                <button name="search2" id="hide" class="btn1" ><i class="fas fa-search" ></i></button>
            </div>
        </div>
</div>

    <?php
       
       
        $department="";
        $subject_code="";
        $subject_code1="";
        $student_id="";
        if(isset($_POST['search']))//Department part search
        {
            if(isset($_POST['dept']))
            {
                if(isset($_POST['subject']))
                {
                    $department=$_POST['dept'];
                    $subject_code=$_POST['subject'];
                    $sql="select * from tbl_attendance where department_id ='$department' and subject_code ='$subject_code' ";
                    $result=mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)==0)
                    {
                        echo '<script type ="text/JavaScript">';  
                                echo 'swal({title: "No record found",
                                    
                                    icon: "error",
                                    button: "OK",});';
                                echo '</script>';
                    }
                }
                else
                {   
                    echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
                }
            }
            else
            {
                echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the  Department fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
            }
        }
        if(isset($_POST['search1']))//Student part search
        {
            if(isset($_POST['student_id']))
            {
                if(isset($_POST['subject1']))
                {
                    $student_id=$_POST['student_id'];
                    $subject_code1=$_POST['subject1'];
                   
                    $sql1="select * from tbl_attendance where student_id ='$student_id' and subject_code ='$subject_code1' ";
                    $result1=mysqli_query($con,$sql1);
                    if(mysqli_num_rows($result1)==0)
                    {
                        echo '<script type ="text/JavaScript">';  
                        echo 'swal({title: "No record found",
                            
                            icon: "error",
                            button: "OK",});';
                        echo '</script>';
                    }
                }
                else
                {
                    echo '<script type ="text/JavaScript">';  
                        echo 'swal({title: "Fill the subject fill",
                            
                            icon: "error",
                            button: "OK",});';
                        echo '</script>';
                }
            }
            else
            {
                echo '<script type ="text/JavaScript">';  
                echo 'swal({title: "Fill the Student id ",
                    
                    icon: "error",
                    button: "OK",});';
                echo '</script>';
            } 
        }
        if(isset($_POST['search2']))//teacher part search
        {
            if(isset($_POST['teacher_id']))
            {
                if(isset($_POST['subject2']))
                {
                    $teacher_id=$_POST['teacher_id'];
                    $subject_code2=$_POST['subject2'];
                    $sql3="SELECT * FROM `tbl_qrdetails` where teacher_id ='$teacher_id' and subject_code ='$subject_code2' ";
                    $result3=mysqli_query($con,$sql3);
                    if(mysqli_num_rows($result3)==0)
                    {
                        echo '<script type ="text/JavaScript">';  
                                echo 'swal({title: "No record found",
                                    
                                    icon: "error",
                                    button: "OK",});';
                                echo '</script>';
                    }
                }
                else
                {   
                    echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
                }
            }
            else
            {
                echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the  Department fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
            }
        }
        if(isset($_POST['search']) )//Create the department table header
        {
            if(isset($_POST['dept']))
            {
                if(mysqli_num_rows($result)>=1)
                {
                        echo '<div class="container">';  
                        echo '<br />  
                        <br />  
                        <br />';  
                        echo ' <div class="table-responsive">  ';
                        echo '<h2 align="center">Attendance Sheet</h2><br /> 
                        <table class="table table-bordered">
                        <tr>
                                            <th>Sl_no</th>                    
                                            <th>Department_id</th>
                                            <th>Attendance_Hours</th>  
                                            <th>Student_id</th>  
                                            <th>Teacher_id</th>  
                                            <th>Subject_code</th>
                                            <th>Attendance_date</th>
                                            <th>Attendance_time</th>
                        
                                        </tr>';
                }
            }else{
                echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
            }
        }
        if(isset($_POST['search1']) )//Create the student table header
        {
            if(mysqli_num_rows($result1)>=1)
            {
                echo '<div class="container">';  
                echo '<br />  
                <br />  
                <br />';  
                echo ' <div class="table-responsive">  ';
                echo '<h2 align="center">Attendance Sheet</h2><br /> 
                <table class="table table-bordered">
                <tr>
                                    <th>Sl_no</th>
                                    <th>Student_id</th>                    
                                    <th>Department_id</th>
                                    <th>Attendance_Hours</th>   
                                    <th>Teacher_id</th>  
                                    <th>Subject_code</th>
                                    <th>Attendance_date</th>
                                    <th>Attendance_time</th>
                
                                </tr>';
            }
        }
        if(isset($_POST['search2']) )//Create the Teacher table header
        {
            if(isset($_POST['teacher_id']))
            {
                if(mysqli_num_rows($result3)>=1)
                {
                        echo '<div class="container">';  
                        echo '<br />  
                        <br />  
                        <br />';  
                        echo ' <div class="table-responsive">  ';
                        echo  '<h2 align="center">Teacher Sheet</h2><br /> 
                        <table class="table table-bordered">
                        <tr>
                                            <th>Sl_no</th>
                                            <th>Teacher_id</th>                    
                                            <th>Department_id</th>
                                            <th>Duration</th>    
                                            <th>Subject_code</th>
                                            <th>Start_time</th>
                                            <th>Date</th>
                        
                                        </tr>';
                }
            }
            else
            {
                echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
            }
        }
            
        if(isset($_POST['search']) )//Show the data in table for department 
        {
            if(isset($_POST['dept']))
            {
                $count=0;
                $sum=0;
                while($rows=mysqli_fetch_assoc($result))
                {
                ?>
                        
                        <tr>
                            <td><?php echo ++$count;?></td>  
                            <td><?php echo $rows['department_id'];?></td>
                            <td><?php echo $rows['attendance_hours'];?></td>  
                            <td><?php echo $rows['student_id'];?></td>  
                            <td><?php echo $rows['teacher_id'];?></td>  
                            <td><?php echo $rows['subject_code'];?></td>  
                            <td><?php echo $rows['attendance_date'];?></td>  
                            <td><?php echo $rows['attendance_time'];?></td>
                            
                        </tr>
                        
                    <?php
                }
            }
            else
            {
                echo '<script type ="text/JavaScript">';  
                            echo 'swal({title: "No record found",
                                
                                icon: "error",
                                button: "OK",});';
                            echo '</script>';
            }  
            
        }
        if(isset($_POST['search1']) )//Show the data in table for Student
        {
            $count=0;
            $sum=0;
            while($rows=mysqli_fetch_assoc($result1))
            {
        ?>
                    
                    <tr>
                        <td><?php echo ++$count;?></td>
                        <td><?php echo $rows['student_id'];?></td> 
                        <td><?php echo $rows['department_id'];?></td>
                        <td><?php echo $rows['attendance_hours'];
                                $sum=$sum+$rows['attendance_hours'];?></td>    
                        <td><?php echo $rows['teacher_id'];?></td>  
                        <td><?php echo $rows['subject_code'];?></td>  
                        <td><?php echo $rows['attendance_date'];?></td>  
                        <td><?php echo $rows['attendance_time'];?></td>
                    </tr>
                <?php
            }  
            echo "Total no. of hours : ";
            echo $sum;
        }
        
        
       
        
    ?>
    <?php 
    if(isset($_POST['search2']) )//Show the data in table for Teacher_id
        {
            if(isset($_POST['teacher_id']))
            {
                $count=0;
                $sum=0;
                while($rows=mysqli_fetch_assoc($result3))
                {
                ?>
                        
                        <tr>
                            <td><?php echo ++$count;?></td>  
                            <td><?php echo $rows['teacher_id'];?></td>
                            <td><?php echo $rows['department_id'];?></td>  
                            <td><?php echo $rows['duration'];?></td>  
                            <td><?php echo $rows['subject_code'];?></td>  
                            <td><?php echo $rows['start_time'];?></td>  
                            <td><?php echo $rows['date'];?></td>
                            
                        </tr>
                        
                    <?php
                }
            }
            else
            {
                echo '<script type ="text/JavaScript">';  
                            echo 'swal({title: "No record found",
                                
                                icon: "error",
                                button: "OK",});';
                            echo '</script>';
            }  
            
        }
        
        ?>
        </table>
    <br/>
   </div>  
  </div> 
 
</form>
    <?php
     if(isset($_POST['search']))//Export for department part
     {
        if(isset($_POST['dept']))
        {

        
            if(mysqli_num_rows($result)>=1)
            {
                $_SESSION['dept_id']=$department;
                $_SESSION['subject_code']=$subject_code;
                $_SESSION['search']=true;
                $_SESSION['search1']=false;
                $_SESSION['search2']=false;

                echo '
                <form method="post" action="export.php">
                <div class="expo">
                <input type="submit" name="export" class="btn btn-success" value="Export" ></div>
                </form> ';
            }
        }else
        {
            echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the  Department fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
        }
    }
    if(isset($_POST['search1']))//Export for student part
     {
        if(mysqli_num_rows($result1)>=1)
        {

            $_SESSION['student_id']=$student_id;
            $_SESSION['subject_code1']=$subject_code1;
            $_SESSION['search1']=true;
            $_SESSION['search']=false;
            $_SESSION['search2']=false;
            echo '
            <form method="post" action="export.php">
            <div class="expo">
            <input type="submit" name="export" class="btn btn-success" value="Export" ></div>
            </form> ';
        }
    }
    if(isset($_POST['search2']))//Export for Teacher part
     {
        if(isset($_POST['teacher_id']))
        {

        
            if(mysqli_num_rows($result3)>=1)
            {
                $_SESSION['teacher_id']=$teacher_id;
                $_SESSION['subject_code2']=$subject_code2;
                $_SESSION['search2']=true;
                $_SESSION['search1']=false;
                $_SESSION['search']=false;

                echo '
                <form method="post" action="export.php">
                <div class="expo">
                <input type="submit" name="export" class="btn btn-success" value="Export" ></div>
                </form> ';
            }
        }else
        {
            echo '<script type ="text/JavaScript">';  
                    echo 'swal({title: "Fill the  Department fields",
                        
                        icon: "error",
                        button: "OK",});';
                    echo '</script>';
        }
    }
    ?>
    
</body>
</html>