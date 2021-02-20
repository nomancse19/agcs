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
<?php include './config/config.php';?>
<?php include './lib/Database.php';?>
<?php include './lib/session.php';?>
<?php include './lib/format.php';?>
<?php session::checksession();?>
<?php
if(session::get('activity')==1){
    session::set('login',FALSE);
    $msg="Hello " .ucwords(session::get('fullname')) ." Your Account is Deactivated By Admin.Please Contact School Authority";
    header("Location:index.php?failed=". urlencode($msg));
}
?>
<?php
$db=new Database();
$fm= new format();
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
    <style type="text/css">
        .m_form{
            border:2px;
            color:red;
            margin-bottom: 50px;
        }
    </style>
    </head>
<body>

    <!-- Demo page code -->
<script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>

   
  
<!--Header-->
     <div class="navbar navbar-default" role="navigation">
        <div class="navbar-headerr">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="index.php"><img alt="logo of agcs" src="image/agclogo.png"></a>
		  <div class="navbar-collapse collapse" style="height: 1px;">
          <ul id="main-menu" class="nav navbar-nav navbar-right">
            
          </ul>

        </div>
		  </div>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
      </div>
   
<!--Header End-->  
