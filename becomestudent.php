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
$db=new Database();
    if(isset($_REQUEST['id'])) 
        {	
	$id = mysqli_real_escape_string($db->link,intval($_REQUEST['id']));
          }
    $sql="SELECT * FROM student_info WHERE id='$id'";
    $value=$db->select($sql);
    if($value){
        $result= $value->fetch_assoc();
        $row=  mysqli_num_rows($value);
        if($row>0){
            session::destroy();
            session::intit();
            session::set("login", true);
            session::set("username", $result['username']);
            session::set("fullname", $result['fullname']);
            session::set("level", $result['level']);
            session::set("admin_type","1");
            session::set("class_id", $result['class_id']);
            session::set("activity", $result['activity']);
             session::set("userid", $result['id']);
            header("Location:welcome.php");
        }  
     }
?>