<?php  
session_start();
// export.php  
$con = mysqli_connect("localhost", "root", "", "sas");
$department="";
$subject_code="";
$subject_code1="";
$student_id="";
$teacher_id="";
if($_SESSION['search']==true)//search for 1st colomn
{
  $department=$_SESSION['dept_id'];
  $subject_code=$_SESSION['subject_code'];
  $sql="select * from tbl_attendance where department_id ='$department' and subject_code ='$subject_code' ";
  $result=mysqli_query($con,$sql);
}
if($_SESSION['search1']==true)//Serchar for 2nd student
{
  $student_id=$_SESSION['student_id'];
  $subject_code1=$_SESSION['subject_code1'];
  $sql1="select * from tbl_attendance where student_id ='$student_id' and subject_code ='$subject_code1' ";
  $result1=mysqli_query($con,$sql1);
}
if($_SESSION['search2']==true)//Serchar for 3rd Teacher
{
  $teacher_id=$_SESSION['teacher_id'];
  $subject_code2=$_SESSION['subject_code2'];
  $sql2="SELECT * FROM `tbl_qrdetails` where teacher_id ='$teacher_id' and subject_code ='$subject_code2'";
  $result2=mysqli_query($con,$sql2);
}
$output= '';
if($_SESSION['search']==true)//table head of xls sheet of department_id
{
    $output.= '
      <table class="table" bordered="1">  
      <tr>                      
            <th>Sl_no</th>                    
            <th>Department_id</th>
            <th>Attendance_Hours</th>  
            <th>Student_id</th>  
            <th>Teacher_id</th>  
            <th>Subject_code</th>
            <th>Attendance_date</th>
            <th>Attendance_time</th>
            
        </tr>
      ';
}
if($_SESSION['search1']==true)//table head of xls sheet student_id
{
    $output.= '
      <table class="table" bordered="1">  
      <tr>                      
            <th>Sl_no</th> 
            <th>Student_id</th>                   
            <th>Department_id</th>
            <th>Attendance_Hours</th>  
            <th>Teacher_id</th>  
            <th>Subject_code</th>
            <th>Attendance_date</th>
            <th>Attendance_time</th>
            
        </tr>
      ';
}
if($_SESSION['search2']==true)//table head of xls sheet teacher_id
{
    $output.= '
      <table class="table" bordered="1">  
      <tr>                      
          <th>Sl_no</th>
          <th>Teacher_id</th>                    
          <th>Department_id</th>
          <th>Duration</th>    
          <th>Subject_code</th>
          <th>Start_time</th>
          <th>Date</th>
            
        </tr>
      ';
}
  if($_SESSION['search']==true)
  {
          $count=0;
          
          while($rows=mysqli_fetch_assoc($result))
          {
             ?>
            <?php $output .= '
            <tr>
            <td>'. ++$count.'</td>  
            <td>'.$rows['department_id'].'</td>
            <td>'.  $rows['attendance_hours'].'</td>  
            <td>'.  $rows['student_id'].'</td>  
            <td>'.  $rows['teacher_id'].'</td>  
            <td>'.  $rows['subject_code'].'</td>  
            <td>'.  $rows['attendance_date'].'</td>  
            <td>'.  $rows['attendance_time'].'</td>
          </tr>';?>
    <?php
      }
  
  }
  if($_SESSION['search1']==true)
  {
          $count=0;
          
          while($rows=mysqli_fetch_assoc($result1))
          {
             ?>
            <?php $output .= '
            <tr>
            <td>'. ++$count.'</td>
            <td>'.$rows['student_id'].'</td>   
            <td>'.$rows['department_id'].'</td>
            <td>'.$rows['attendance_hours'].'</td>  
            <td>'.$rows['teacher_id'].'</td>  
            <td>'.$rows['subject_code'].'</td>  
            <td>'.$rows['attendance_date'].'</td>  
            <td>'.$rows['attendance_time'].'</td>
          </tr>';?>
    <?php
      }
  
  }
  if($_SESSION['search2']==true)
  {
          $count=0;
          
          while($rows=mysqli_fetch_assoc($result2))
          {
             ?>
            <?php $output .= '
            <tr>
            <td>'. ++$count.'</td>  
            <td>'.$rows['teacher_id'].'</td>
            <td>'.  $rows['department_id'].'</td>  
            <td>'.  $rows['duration'].'</td>  
            <td>'.  $rows['subject_code'].'</td>   
            <td>'.  $rows['start_time'].'</td>  
            <td>'.  $rows['date'].'</td>
          </tr>';?>
    <?php
      }
  
  }

  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
//  }
// }
?>