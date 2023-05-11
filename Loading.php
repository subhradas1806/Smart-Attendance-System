<?php
header("refresh:3;url=student&teacherLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="shortcut icon" type="image/x-png" href="S6.png" />
    <title>Smart attendance system</title>
	<link rel="stylesheet" href="Loading.css?v=<?php echo time(); ?>">
</head>
<body background="bg1.jpg"  >
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <div class="animation">  
        <h1  >Smart Attendance System</h2>
        <div class="qr">
            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_x9zyit8f.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
            <div class="loading">
                <p>Loading</p>
                <div class="load">
                    <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_0uyodtft.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

