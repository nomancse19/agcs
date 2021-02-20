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
       if(!isset($_GET['id']) || $_GET['id']==NULL){
                       echo"Directory access is forbidden";
                   } 
       else {	
	$id = mysqli_real_escape_string($db->link,intval($_REQUEST['id']));
          
  
       $sql="DELETE FROM documents WHERE id='$id'";
        $documentdel=$db->delete($sql);
        if($documentdel){
            $msg="Document Data Deleted Success";
           header("Location:./documents.php?msg=". urldecode($msg));
    }
    else{
        echo "Not Inserted";
    }     
          
       }        
          
          
          
          
          
  ?>