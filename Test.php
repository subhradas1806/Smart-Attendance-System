<?php
// $name = 'CMSA';

// // Get the last three characters
// $last_three = substr($name, -1);
// $name1=substr($name,0,-1).'G';
// // Based on last three characters, substr() and append as needed
// // switch($last_three)
// // {
// //     case 'ski':
// //         $name = substr($name, 0, -3).'ska';
// //         break;
// //     case 'cki':
// //         $name = substr($name, 0, -3).'cka';
// //         break;
// // }

// echo $name;
// echo $last_three;
$ip = $_SERVER['REMOTE_ADDR'];
echo $ip;
$ipaddress = getenv("REMOTE_ADDR") ;
 Echo "Your IP Address is " . $ipaddress;
 $_SESSION['ip_user']=$ip;
 date_default_timezone_set('Asia/Kolkata');
            $date1=date("Y-m-d");
            $time1=date("H:i:s");
 $_SESSION['visit_user']=$time1;
 echo $time1;
?>