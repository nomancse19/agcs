<?php ob_start(); ?>
<?php 
include 'config/config.php';
include 'lib/Database.php';
include 'lib/session.php';
include 'lib/format.php';
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
          
  
       $sql="DELETE FROM admin WHERE id='$id'";
        $studentdel=$db->delete($sql);
        if($studentdel){
            $msg="Admin Data Deleted Success";
           header("Location:./adminlist.php?msg=". urldecode($msg));
    }
    else{
        echo "Not Inserted";
    }   
        }else{
            echo "Directory access is forbidden.";
        }   
          
          
          
          
          
          
          
  ?>