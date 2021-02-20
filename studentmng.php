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
<?php include 'inc/header.php'; ?>
<?php if(session::get('admin_type')!='0') 
  {
      session::destroy();
      header("Location:index.php");
  }   
   ?>
<?php
if(isset($_POST['classbtn'])){
    $oldclass=$_POST['oldclass'];
    $newclass=$_POST['newclass'];
     $sql4="UPDATE student_info SET class_id='$newclass' WHERE class_id='$oldclass'";
        $classup=$db->update($sql4);
        if($classup){
            $msg="All Student New Class Assign Successfully Added";
           header("Location:studentmng.php?msg=". urldecode($msg));
    }
    else{
        echo "Not Inserted";
    }

}

else if(isset ($_POST['studentdelete'])){
    $class=$_POST['class'];
    $sql="DELETE FROM student_info WHERE class_id='$class'";
     $studentdel=$db->delete($sql);
        if($studentdel){
            $msg="Student Data Deleted By Class ID Success";
           
    }
}
else if(isset ($_POST['delallstudent'])){
    $sql="TRUNCATE TABLE student_info";
     $studentdel=$db->delete($sql);
        if($studentdel){
            $msg="All Student Data Deleted SuccessFully";
           
    }
}
?>
  <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>  
<?php include 'inc/sidebar.php';?>
		
<!-- content-->
    <div class="content">
        
        <h2 style="color:blue;">All Student Management</h2>
                    <hr />
        <h3 style="color:green">Auto All Student Class Change Option  </h3>
        <form  class="form-horizontal"  action="" method="post">
            
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
            <p style="color:blue;font-weight: bold"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?></p>
         

      <div class="form-group" >
      <label class="control-label col-sm-6" for="class">
       <p style="color:red;font-weight: bold;font-size:16px;" data-placement="right" data-toggle="class"  title="N.B: Please Note, Before Assign New Class Please,Ensure
        Your All Information is Correct!.">Special N.B For Assign New Class</p>    
      </label>
      <div class="col-sm-4">
          
      </div>
    </div>
      <div class="form-group" >
       <label class="control-label col-sm-4" for="class" style="color:red;font-weight: bold">Select Old Class Type :</label>
      <div class="col-sm-4">
          <select name="oldclass" id="" required="">
              <option value="">Select Old Class Type</option>
              <?php 
              $sql="SELECT * FROM class";
              $value=$db->select($sql);
              if($value){
                  while($result=$value->fetch_assoc()){
              ?>
              <option value="<?php echo $result['secid'];?>"><?php echo $result['class_name']; echo "&nbsp;&nbsp;&nbsp;&nbsp;"; echo $result['level'];?></option>
              <?php } ?>
              <?php } ?>
          </select>
      </div>
    </div> 
            
     <div class="form-group">
      <label class="control-label col-sm-4" for="class" style="color:blueviolet;font-weight:bold">Select New Class Type </label>
      <div class="col-sm-4">
          <select name="newclass" id="" required="">
              <option value="" >Select New Class Type</option>
              <?php 
              $sql1="SELECT * FROM class";
              $value1=$db->select($sql1);
              if($value1){
                  while($result1=$value1->fetch_assoc()){
              ?>
              <option value="<?php echo $result1['secid'];?>"><?php echo $result1['class_name']; echo "&nbsp;&nbsp;&nbsp;&nbsp;"; echo $result1['level'];?></option>
              <?php } ?>
              <?php } ?>
          </select>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-4">
        <input type="submit" name="classbtn" class="btn btn-success" value="Assign New Class"/>
        
      </div>
    </div>
  </form>
 <form method="post" action="">
<input type="submit" name="delallstudent"onclick=" return confirm('Are you sure you want to delete All Student?');" class="btn btn-danger" value="Delete All Student Data"/>
 </form> 
<hr /> 
     <h3 style="color:green">All Student List</h3>
      <form class="form-horizontal"  action="" method="post">
       <div class="form-group">
      <div class="col-sm-2">
          <select name="class" id="" required="">
              <option value="" >Select Class Type</option>
              <?php 
              $sql1="SELECT * FROM class";
              $value1=$db->select($sql1);
              if($value1){
                  while($result1=$value1->fetch_assoc()){
              ?>
              <option value="<?php echo $result1['secid'];?>"><?php echo $result1['class_name'];?></option>
              <?php } ?>
              <?php } ?>
          </select>
      </div>
      <div class="col-sm-3">
        <input type="submit" name="btn" class="btn btn-success" value="View Student By Select Class"/>
      </div> 
         <span></span>
        <div class="col-sm-3">
        <input type="submit" name="studentdelete" class="btn btn-danger" onclick=" return confirm('Are you sure you want to delete Student Data?');" value="Delete Student By Select Class"/>
      </div>  
    </div>
  </form>
     <br>
        <div class="container">
	<div class="row">
       
	<table id="example1" class="table table-striped table-bordered" width="90%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Username</th>
                <th width="24%">FullName</th>
                <th>Class Name</th>
                <th>Section ID</th>
                <th>User Status</th>
                <th>Become Student</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            
            <?php 
            if(isset($_POST['btn'])){
                $class=$_POST['class'];
            $sql2="SELECT * FROM student_info WHERE class_id='$class' order by id DESC";
            }else{
               $sql2="SELECT * FROM student_info order by id DESC"; 
            }
            $value2=$db->select($sql2);
            if($value2){
                $count=0;
                while($result2=$value2->fetch_assoc()){
                    $count++;
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $result2['username'];?></td>
                <td><?php echo $result2['fullname'];?></td>
                <?php
                $class_id=$result2['class_id'];
                $sql3="SELECT * FROM class WHERE secid='$class_id'";
                $value3=$db->select($sql3);
                if($value3){
                    while($result3=$value3->fetch_assoc()){
                  ?>      
                <td><?php echo $result3['class_name'];?></td> 
                <?php } ?>
                <?php }?>   
                <td><?php echo $result2['class_id'];?></td>
                <td>
                    <?php 
                    if($result2['activity']=='0'){
                        echo "<span style='color:green'>Active</span>";
                    }
                    if($result2['activity']=='1'){
                        echo "<span style='color:red'>Deactive</span>";
                    }
                    
                    ?>
                
                </td>
                 <td><a href="becomestudent.php?id=<?php echo $result2['id']; ?>"><button type="button"  onclick=" return confirm('Are you sure you want Login Student Account');" class="btn btn-primary btn-xs">Become Student</button></a></td>
                
                <td><button type="button" data-toggle="modal" id="studentdata" data-target="#studentedit" data-id="<?php echo $result2['id'];?>"class="btn btn-warning btn-xs">Edit</button> | <a href="delstudent.php?id=<?php echo $result2['id'];?>"><button type="button"  onclick=" return confirm('Are you sure you want to delete');" class="btn btn-danger btn-xs">Delete</button></a></td>
               
            </tr>
            <?php } ?>
            <?php } ?>
    </table>
    </div>
    </div>
       <!--Datalist Edit Module Start -->
		<div class="modal fade" id="studentedit" tabindex="-1" role="dialog" aria-labelledby="add-modal-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content" id="editdata">
		    	
		    </div>
		  </div>
		</div>
    </div>
<script>
$(document).ready(function(){
	$(document).on('click','#studentdata',function(e){
		var uid = $(this).data('id');
		$.ajax({
			url: 'edit/studentedit.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html',
                        success: function(data){
                    $("#editdata").html(data);
                 }
		});
	});
});

</script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="class"]').tooltip();   
});
</script>
<?php include 'inc/footer.php'; ?>