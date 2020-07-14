<?php
$link = mysqli_connect("pi.eng.src.ku.ac.th", "prj60", "123456", "project60"); //เชื่อมdata
mysqli_set_charset($link,"utf8");
session_start(); //เปิด session เพื่อเปิดการทำงาน sessio
if(isset($_SESSION[id_staff])) //ปิด session โดยเช็คจาก ID_staff ว่าค่าอยู่หรือเปล่า ถ้ามีให้ทำการลบ
{
    session_destroy();
}

function phpAlert($msg)//ฟังก์ชั่นการแจ้งเตือน
    {
        echo "<script type='text/javascript'>alert('".$msg."')</script>";
    }
if (!$link) //เช็คเพื่อทำให้รู้ว่าเชื่อมดาต้าเบสอยู่หรือเปล่า
{
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    if($_SERVER["REQUEST_METHOD"]=="POST")//รับค่าจาก post ว่า == กันมั้ย
    {
           $id_staff = isset($_POST['id_staff']) ? mysqli_real_escape_string($link,$_POST['id_staff']) : '';//รับ ID
           $password = isset($_POST['password']) ? mysqli_real_escape_string($link,$_POST['password']) : '';//รับ password

           $sql = "SELECT * FROM rfid_staff WHERE id_staff ='".$id_staff."' and password = '".$password."'";//เช็ค ID เเละ password มีในดาต้าเบสมั้ย
           $result = mysqli_query($link,$sql);// ค่า retrun เป็น objet ออกมา
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC); //นำค่าที่ค้นหาเเล้วมาเก็บค่าไว้ใน  row
           $count = mysqli_num_rows($result); //เมื่อเราค้นหาได้เเล้ว ถ้าเช็คเเล้วตรงกับแถวนั้น count จะถูกบวกเพิ่มไป 1
           //phpAlert("ไม่พบข้อมูลในฐานระบบ");
    if($count==1)
    {
            $_SESSION['id_staff'] =  $id_staff;
            $_SESSION['firstname'] =  $row['firstname'];
            $_SESSION['lastname'] =  $row['lastname'];
            $_SESSION['department'] =  $row['department'];
            $_SESSION['position'] =  $row['position'];

            $sql="UPDATE `rfid_staff` SET `date` = NOW() WHERE id_staff = '$id_staff'";
            $result = mysqli_query($link,$sql);
        
        if($_SESSION['position'] == "เจ้าหน้าที่วัสดุ")
        {
            header("location:adminmain.php");
        }
       else 
        {
           header("location:main.php");
        }

    }
    phpAlert("ไม่พบข้อมูลในฐานระบบ");
    }
    
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<!-- metatags-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Magnificent login form a Flat Responsive Widget,Login form widgets, Sign up Web 	forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/><!--stylesheet-css-->
<link rel="stylesheet" href="css/font-awesome.css"><!--fontawesome-->
<link href="//fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet"><!--online fonts-->
<link href="//fonts.googleapis.com/css?family=Raleway" rel="stylesheet"><!--online fonts-->
</head>
    
<body>

	<div class="w3ls-main">
		<div class="wthree-heading">
			<h1>Sign in</h1>
		</div>

			<div class="wthree-container">
				<div class="wthree-form">
					<div class="agileits-2">
						<h2>login<br>กรุณาล็อกอิน</h2>
					</div>
              
					<form name="frmLogin" method="post" action="index.php">
						<div class="w3-user">
							<span><i class="fa fa-user-o"></i></span>
							<input type="text" name="id_staff" id="id_staff" placeholder="Username" required="">
						</div>
						<div class="w3-psw">
							<span><i class="fa fa-key" ></i></span>
							<input type="password" name="password" id="password" placeholder="Password" required="">
						</div>
						<div class="clear"></div>
						
						<div class="clear"></div>
						<div class="w3l-submit">
							<input type="submit" value="login">
						</div>
						<div class="clear"></div>
					</form>
				</div>
			</div>
	</div>
</body>
</html>