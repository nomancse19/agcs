<!--
Author; Jahidul Islam Noman
Programmer: Jahidul Islam Noman
Database And Concept Design: Jahidul Islam Noman
Mobile: 01521451354
Email: Noman.cse19@gmail.com
Web: www.noman-it.com
Created Date: 06-07-2018
-->
<?php ob_start(); ?>
<?php 
include '../config/config.php';
include '../lib/Database.php';
include '../lib/session.php';
include '../lib/format.php';
$db=new Database();
$fm= new format();
?>
<?php if(session::get('admin_type')!='0') 
  {
      session::destroy();
      header("Location:index.php");
  }   
   ?>
	<?php 
       if(isset($_REQUEST['id'])) 
        {	
	$id = mysqli_real_escape_string($db->link,($_REQUEST['id']));
        }
       if(isset($_POST['btn'])){
        $username=$_POST['username'];
        $username= mysqli_real_escape_string($db->link,$username);
        $fullname=$_POST['fullname'];
        $fullname= mysqli_real_escape_string($db->link,$fullname);
        $mobile=$_POST['mobile'];
        $email=$_POST['email'];
        $email= mysqli_real_escape_string($db->link,$email);
        $class=$_POST['class'];
        $pass=$_POST['password'];
        $checkpass=$fm->md5check($pass);
        if($checkpass){
        $password=$pass;
        }
    else{
        $password= mysqli_real_escape_string($db->link,$pass);
        $password=md5($_POST['password']);
    }
    $activity=$_POST['activity'];
        $sql="UPDATE student_info SET username='$username',fullname='$fullname',mobile='$mobile',email='$email',class_id='$class',password='$password',activity='$activity' WHERE id='$id'";
        $studentup=$db->update($sql);
        if($studentup){
            $msg="Student Profile Updated Success";
           header("Location:../studentlist.php?msg=". urldecode($msg));
    }
    else{
        echo "Not Inserted";
    }

    }
  ?>  

<form class="form-horizontal" id="add-form" action="edit/studentedit.php?id=<?php echo $id; ?>" method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="add-modal-label">Student Information Edit Or Update</h4>
                </div>
                <div class="modal-body">
                                 
        <?php
          if (isset($_REQUEST['id'])) {	
             $id = mysqli_real_escape_string($db->link,intval($_REQUEST['id']));
             }       
          $editsql="SELECT * FROM student_info WHERE id='$id'";
           $editvalue=$db->select($editsql);
          if($editvalue){
          while($editresult=$editvalue->fetch_assoc()){

          ?>
        <div class="form-group">

            <label for="add-firstname" class="col-xs-5 control-label">User name</label>
            <div class="col-sm-5">
                    <input type="text" class="form-control" id="add-firstname" name="username" value="<?php echo $editresult['username']; ?>" required="">
            </div>
            </div>
            <div class="form-group">
            <label for="add-email" class="col-xs-5 control-label">Full Name</label>
            <div class="col-sm-5">
                    <input type="text" class="form-control" id="add-email" name="fullname" value="<?php echo $editresult['fullname'];?>" required="">
            </div>
            </div>
        <div class="form-group">
            <label for="add-mobile" class="col-xs-5 control-label">Mobile Number</label>
            <div class="col-sm-5">
                    <input type="number" class="form-control" id="add-mobile" name="mobile" value="<?php echo $editresult['mobile'];?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="add-mobile" class="col-xs-5 control-label">Enter Valid Email</label>
            <div class="col-sm-6">
                  <input type="email" class="form-control" id="add-mobile" name="email" value="<?php echo $editresult['email'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="add-mobile" class="col-xs-5 control-label">Select Class Type</label>
            <div class="col-sm-6">
             <select name="class" id="" required="">
              <option value="">Select Class Type</option>
              <?php 
              $sql="SELECT * FROM class";
              $value=$db->select($sql);
              if($value){
                  while($result=$value->fetch_assoc()){
              ?>
              <option <?php if($result['secid']==$editresult['class_id']){echo "selected";} ?> value="<?php echo $result['secid'];?>"><?php echo $result['class_name']; echo "&nbsp;&nbsp;&nbsp;";echo $result['level'];?></option>
              <?php } ?>
              <?php } ?>
          </select>
        </div>
       </div>    
       <div class="form-group">
            <label for="add-mobile" class="col-xs-5 control-label">User Password</label>
            <div class="col-sm-6">
                  <input type="password" class="form-control"  name="password" value="<?php echo $editresult['password'];?>">
            </div>
        </div> 
        <div class="form-group">
            <label for="add-mobile" class="col-xs-5 control-label">User Actvity</label>
            <div class="col-sm-6">
            <select name="activity" id="" required="">
              <option value="">Select Student Activity</option>
               <option <?php if($editresult['activity']=="1"){echo "selected=''";}?>value="1">Deactivated</option>
              <option <?php if(($editresult['activity']=="0")){echo "selected";}?> value="0">Active</option>
             

          </select>
            </div>
        </div> 
        <?php } ?>
        <?php } ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="btn" class="btn btn-primary">Update Student Information</button>
                </div>
          </form>

