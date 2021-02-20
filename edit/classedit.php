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
	$id = mysqli_real_escape_string($db->link,intval($_REQUEST['id']));
          }
       if(isset($_POST['btn'])){
        $classname=$_POST['classname'];
        $classname= mysqli_real_escape_string($db->link,$classname);
        $level=$_POST['level'];
        $level= mysqli_real_escape_string($db->link,$level);
        $secid=$_POST['section'];
        $secid= mysqli_real_escape_string($db->link,$secid);
    
        $sql="UPDATE class SET class_name='$classname',secid='$secid',level='$level' WHERE id='$id'";
        $studentup=$db->update($sql);
        if($studentup){
            $msg="Class Data Updated Success";
           header("Location:../classlist.php?msg=". urldecode($msg));
    }
    else{
        echo "Not Inserted";
    }

    }
  ?>  

<form class="form-horizontal" id="add-form" action="edit/classedit.php?id=<?php echo $id; ?>" method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="add-modal-label">Class Information Edit Or Update</h4>
                </div>
          <div class="modal-body">
                                 
        <?php
          if (isset($_REQUEST['id'])) {	
             $id = mysqli_real_escape_string($db->link,intval($_REQUEST['id']));
             }       
          $editsql="SELECT * FROM class WHERE id='$id'";
           $editvalue=$db->select($editsql);
          if($editvalue){
          while($editresult=$editvalue->fetch_assoc()){

          ?>
        <div class="form-group">

            <label for="add-firstname" class="col-xs-5 control-label">Class Name : </label>
            <div class="col-sm-5">
                    <input type="text" class="form-control" id="add-firstname" name="classname" value="<?php echo $editresult['class_name']; ?>" required="">
            </div>
        </div>
        <div class="form-group">

            <label for="add-firstname" class="col-xs-5 control-label">Enter Section ID</label>
            <div class="col-sm-5">
                    <input type="text" class="form-control" id="add-firstname" name="section" value="<?php echo $editresult['secid']; ?>" required="">
            </div>
        </div>
         <div class="form-group">

            <label for="add-firstname" class="col-xs-5 control-label">Enter Level: </label>
            <div class="col-sm-5">
                    <input type="text" class="form-control" id="add-firstname" name="level" value="<?php echo $editresult['level']; ?>" required="">
            </div>
        </div>
            
        </div> 
        <?php } ?>
        <?php } ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" name="btn" class="btn btn-primary">Update Class Information</button>
                </div>
          </form>

