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
if($_SERVER["REQUEST_METHOD"]=='POST'){
    
    $secid=$_POST['section'];
    $secid= mysqli_real_escape_string($db->link,$secid);
    $sql="SELECT * FROM class WHERE secid='$secid'";
    $checkvalue=$db->select($sql);
    if($checkvalue){
       $msg2="<span style='color:red'>Section ID Already Exist. Please Use Different Section ID.</span>";
    }else{
    $classname=$_POST['classname'];
    $classname= mysqli_real_escape_string($db->link,$classname);
    $level=$_POST['level'];
    $level= mysqli_real_escape_string($db->link,$level);
    $user=session::get('username');
    $sql1="INSERT INTO class(secid,class_name,level,user) VALUES('$secid','$classname','$level','$user')";
    $insert=$db->insert($sql1);
    if($insert){
        $msg="Class Data Added Succesfully";
    }
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
        
        <h2 style="color:blue;">Student Class Add And List Option</h2>
        <form class="form-horizontal"  action="" method="post">
            <hr />
            <h3 style="color:green">Class Add Option</h3>
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
             <p style="font-weight: bold"><?php if(isset($msg2)) {echo $msg2;} ?></p>
            <p style="color:blue;font-weight: bold"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?></p>
    <div class="form-group" >
      <label class="control-label col-sm-2" for="">Enter Class Name :</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter Class Name" name="classname" required="">
      </div>
      </div>
     <div class="form-group" >
      <label class="control-label col-sm-2" for="">Enter Level :</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter Level" name="level" required="">
      </div>
      </div>
    <div class="form-group" >
      <label class="control-label col-sm-2" for="">Enter Section ID:</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter Section Identifier ID" name="section" required="">
      </div>
      </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-2">
        <input type="submit" name="btn" class="btn btn-success" value="Add Class"/>
      </div>
    </div>
  </form>

     <hr /> 
     <h3 style="color:green">All Class List</h3>
        <div class="container">
	<div class="row">
	<table id="example1" class="table table-striped table-bordered" width="70%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Class Name</th>
                <th>Section ID</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql2="SELECT * FROM class order by id DESC";
            $value1=$db->select($sql2);
            if($value1){
                $count=0;
                while($result1=$value1->fetch_assoc()){
                    $count++;
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo ucwords($result1['class_name']);?></td>
                <td><?php echo ucwords($result1['secid']);?></td>
                <td><?php echo ucwords($result1['level']);?></td>
                <td><button type="button" data-toggle="modal" id="classdata" data-target="#classedit" data-id="<?php echo $result1['id'];?>"class="btn btn-warning">Edit </button> </td>
            </tr>
            <?php } ?>
            <?php } ?>
    </table>
    </div>
    </div>
       <!--Datalist Edit Module Start -->
		<div class="modal fade" id="classedit" tabindex="-1" role="dialog" aria-labelledby="add-modal-label">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content" id="editdata">
		    	
		    </div>
		  </div>
		</div>
    </div>
<script>
$(document).ready(function(){
	$(document).on('click','#classdata',function(e){
		var uid = $(this).data('id');
		$.ajax({
			url: 'edit/classedit.php',
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
<?php include 'inc/footer.php'; ?>