<?php
    $link = mysqli_connect("pi.eng.src.ku.ac.th", "prj60", "123456", "project60");
    mysqli_set_charset($link,"utf8");
    session_start();
    if(!isset($_SESSION[id_staff]))
    {
         //phpAlert("กรุณาล็อคอินเข้าระบบ");
         header("location:index.php");
    }
    function phpAlert($msg)
        {
            echo "<script type='text/javascript'>alert('".$msg."')</script>";
        }
    if (!$link) 
    {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
       if($_SERVER["REQUEST_METHOD"]=="POST")
       {
           
       $firstname = isset($_POST['firstname']) ? mysqli_real_escape_string($link,$_POST['firstname']) : '';
       $lastname = isset($_POST['lastname']) ? mysqli_real_escape_string($link,$_POST['lastname']) : '';
       $id_staff = isset($_POST['id_staff']) ? mysqli_real_escape_string($link,$_POST['id_staff']) : '';
       $department = isset($_POST['department']) ? mysqli_real_escape_string($link,$_POST['department']) : '';
       $position = isset($_POST['position']) ? mysqli_real_escape_string($link,$_POST['position']) : '';
       $password = isset($_POST['password']) ? mysqli_real_escape_string($link,$_POST['password']) : '';
      
       $sql="INSERT INTO `rfid_staff` (`id_staff`, `firstname`, `lastname`, `password`,`department`,`position`) VALUES ('$id_staff', '$firstname' ,'$lastname','$password','$department','$position')";
       $result = mysqli_query($link,$sql);
        if($result==1)
        {
            phpAlert("ลงทะเบียนสำเร็จ");
        }
        else
        {
             phpAlert("ลงทะเบียนไม่สำเร็จ");
        }
       }
        mysqli_close($link);    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images1/favicon.png">
    <title>จัดการบุคลากร</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style1.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <!--<div class="top-left-part"><a class="logo" href="index.html"><b><img src="plugins/images1/pixeladmin-logo.png" alt="home" /></b><span class="hidden-xs"><img src="plugins/images1/pixeladmin-text.png" alt="home" /></span></a></div>-->
                <!--<ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>-->
                <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
                    <li>
                          <a class="profile-pic" href="adminmain.php"> <img src="plugins/images1/users/blood.ico" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></b> </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                   <li>
                        <a href="adminmain.php" class="waves-effect"><i class="fa fa-font fa-fw" ></i><span class="hide-menu">หน้าเเรก</span></a>
                    </li>
                    <li>
                        <a href="adminfind.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" ></i><span class="hide-menu">ค้นหาอุปกรณ์</span></a>
                    </li>
                    <li>
                        <a href="adminprofilemain.php" class="waves-effect"><i class="fa fa-user fa-fw" ></i><span class="hide-menu">จัดการบุคลากร</span></a>
                    </li>
                    <li>
                        <a href="adminstatus.php" class="waves-effect"><i class="fa fa-table fa-fw" ></i><span class="hide-menu">ตรวจสอบสถานะอุปกรณ์</span></a>
                    </li>
                    <!--<li>
                        <a href="#" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i><span class="hide-menu">Icons</span></a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i><span class="hide-menu">Google Map</span></a>
                    </li>-->
                    <li>
                        <a href="adminmanage.php" class="waves-effect"><i class="fa fa-columns fa-fw"></i><span class="hide-menu">จัดการอุปกรณ์</span></a>
                    </li>
                    <li>
                        <a href="index.php" class="waves-effect"><i class="fa fa-info-circle fa-fw" ></i><span class="hide-menu">Logout</span></a>
                    </li>
                </ul>
                <!--<div class="center p-20">
                    <span class="hide-menu"><a href="http://wrappixel.com/templates/pixeladmin/" target="_blank" class="btn btn-danger btn-block btn-rounded waves-effect waves-light">Upgrade to Pro</a></span>
                </div>-->
            </div>
        </div>
        <!-- Left navbar-header end -->
    </div>

        <!-- Page Content -->
             <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">ลงทะเบียนพนักงาน</h4> 
                        </div>
                    </div>
                </div> 
         <!--startform-->     

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box" style="margin-left: 50px;margin-right: 50px">
                            <form name="submitfrm" method="post" action="adminprofile.php">
                                <div class="form-group">
                                     <input type="text" name="firstname" placeholder="ชื่อ"   id="firstname" required="">
								     <br><br> <input type="text" name="lastname" placeholder="นามสกุล" id="lastname" required="" >
                                    <br><br><input type="text" name="id_staff" placeholder="รหัสประจำตัว"   id="id_staff" required="">
								    <br><br><select id="department" name="department">
											        <option value="">โปรดเลือกแผนก</option>
											        <option value="แผนกฉุกเฉินและอุบัติเหตุ">แผนกฉุกเฉินและอุบัติเหตุ</option>
											        <option value="แผนกผู้ป่วยนอก">แผนกผู้ป่วยนอก</option>
											        <option value="แผนกผู้ป่วยใน">แผนกผู้ป่วยใน</option>
													<option value="แผนกผู้ป่วยหนัก">แผนกผู้ป่วยหนัก</option>
											        <option value="แผนกรังสีกรรม">แผนกรังสีกรรม</option>
											        <option value="แผนกห้องปฏิบัติการทางการแพทย์">แผนกห้องปฏิบัติการทางการแพทย์</option>
                                                    <option value="แผนกศัลยกรรม ">แผนกศัลยกรรม </option>
                                                    <option value="แผนกวิสัญญี">แผนกวิสัญญี</option>
                                                    <option value="แผนกกุมารเวชกรรม">แผนกกุมารเวชกรรม</option>
                                                    <option value="แผนกสูตินรีเวชกรรม">แผนกสูตินรีเวชกรรม</option>
                                                    <option value="แผนกเวชศาสตร์ฟื้นฟู">แผนกเวชศาสตร์ฟื้นฟู</option>
                                                    <option value="แผนกจักษุ">แผนกจักษุ</option>
                                                    <option value="แผนกหู คอ จมูก">แผนกหู คอ จมูก</option>
                                                    <option value="แผนกเภสัชกรรม">แผนกเภสัชกรรม</option>
                                                    <option value="แผนกจิดเวช">แผนกจิตเวช</option>
									</select>
                                    <br><br><select id="position"  name="position" >
                                               <option value="">โปรดเลือกตำแหน่ง</option>
                                               <option value="แพทย์">แพทย์</option>
                                               <option value="พยาบาล">พยาบาล</option>
                                               <option value="ผู้ช่วยพยาบาล">ผู้ช่วยพยาบาล</option>
                                               <option value="เจ้าหน้าที่พัสดุ">เจ้าหน้าที่พัสดุ</option>   
                                     </select>  
                                    <br><br><input type="password" id="password" name="password" placeholder="โปรดใส่รหัสผ่าน"  id="Password" required=""> 
								    <br><br><label><button>ยืนยัน</button></label>&nbsp&nbsp&nbsp<label><input type="button" onclick="del()" value="ยกเลิก"></label>
							        </div>
                             </form>
                         </div>
                    </div>
                </div>
        <!-- Page Content -->      
                 <script>
                     function del() 
                     {
                         document.getElementById('firstname').value = "";
                         document.getElementById('lastname').value = "";
                         document.getElementById('id_staff').value = "";
                         document.getElementById('department').value = "";
                         document.getElementById('position').value = "";
                         document.getElementById('password').value = "";
                     }
                 </script>
        
        
        <!-- /.container-fluid -->
            <!--<footer class="footer text-center"> 2017 &copy; Pixel Admin brought to you by wrappixel.com </footer>-->
        <!--</div>-->
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--<script type="text/javascript">
    $(document).ready(function() {
        $.toast({
            heading: 'Welcome',
            text: 'Use the predefined ones, or specify a custom position object.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'info',
            hideAfter: 3500,
            stack: 6
        })
    });
    </script>-->
</body>
    
</html>
