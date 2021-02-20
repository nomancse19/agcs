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
<?php include 'inc/header.php'; ?>
 <?php
 if($_SERVER["REQUEST_METHOD"]=='POST'){
    $oldpass=$_POST['oldpassword'];
    $oldpass= md5($oldpass);
    $userid=session::get('userid');
    $sql="SELECT * FROM student_info WHERE id='$userid'";
    $value=$db->select($sql);
    if($value){
        while($result=$value->fetch_assoc()){
            $datapass=$result['password'];
        }
    }else{
        $datapass="";
    }
    if($oldpass==$datapass){
        $newpass=$_POST['newpassword'];
        $renewpass=$_POST['renewpassword'];
         if($newpass==$renewpass){
        $newpass= md5($newpass);
    $sql1="UPDATE student_info SET password='$newpass' WHERE id='$userid'";
    $insert=$db->update($sql1);
    if($insert){
        $msg="Password Change SuccessFully";
    }
   }else{
      $msg="<span style='color:red;font-weight:bold;'>Your New Password And Retype Password Not Match. Please Try Again Later!</span>";
   }
    }else{
        $msg="<span style='color:red;font-weight:bold;'>Your Old Password is Wrong !</span>";
    }
}
 
 
 
 
 
 
 ?>
  <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>  
<!--Sidebar--> 
    <div class="sidebar-nav">
    <ul>
        <li><a style="color:blue;font-weight: bold;" href="#" class="nav-header"><span style="color:green;font-weight: bold;font-size:50px;">. </span>Hello, <?php echo ucwords(session::get('username')); ?></a></li>
        <li><a href="welcome.php" class="nav-header"><i class="fa fa-user"></i> Home</a></li>
        <li><a href="changepassword.php" class="nav-header"><i class="fa fa-edit"></i>Change Password</a></li>
        <li><a href="logout.php" class="nav-header"><i class="fa fa-power-off"></i>Sign out</a></li>
               
            </ul>
    </div>
	
<!--Sidebar-End--> 
		
<!-- content-->
    <div class="content"> 
	<h3 style="color:blue;">Change Profile Password</h3>
        <form class="form-horizontal"  action="" method="post">
            <hr />
            <h3 style="color:green">User Password Change Option</h3>
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
            <p style="color:blue;font-weight: bold"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?></p>
    <div class="form-group" >
      <label class="control-label col-sm-3" for="Username">Enter Your old Password:</label>
     
      <div class="col-sm-3">
          <input type="password" class="form-control" placeholder="Enter Your old Password" name="oldpassword" required="">
      </div>
      </div>
   <div class="form-group" >
      <label class="control-label col-sm-3" for="Username">Enter Your New Password:</label>
     
      <div class="col-sm-3">
          <input type="password" class="form-control" placeholder="Enter Your New Password" name="newpassword" required="">
      </div>
      </div>
   <div class="form-group" >
      <label class="control-label col-sm-3" for="Username">Enter Retype New Password:</label>
     
      <div class="col-sm-3">
          <input type="password" class="form-control" placeholder="Enter Retype New Password" name="renewpassword" required="">
      </div>
      </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-3 col-sm-2">
        <input type="submit" name="btn" class="btn btn-success" value="Change Password"/>
      </div>
    </div>
  </form>
    </div>
<?php include 'inc/footer.php'; ?>