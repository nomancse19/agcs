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
<?php if(session::get('admin_type')!='0') 
  {
      session::destroy();
      header("Location:index.php");
  }   
   ?>
<?php
if($_SERVER["REQUEST_METHOD"]=='POST'){
    $username=$_POST['username'];
    $username= mysqli_real_escape_string($db->link,$username);
    $sql4="SELECT * FROM student_info WHERE username='$username'";
    $value4=$db->select($sql4);
    if($value4){
        $msg="<span style='color:red'>Username Already Exist. Please Use Different Username.</span>";
    }else{
    $fullname=$_POST['fullname'];
    $fullname= mysqli_real_escape_string($db->link,$fullname);
    $mobile=$_POST['mobile'];
    $mobile= mysqli_real_escape_string($db->link,$mobile);
    $email=$_POST['email'];
    $email= mysqli_real_escape_string($db->link,$email);
    $class=$_POST['class'];
    $pass=$_POST['password'];
    $password= mysqli_real_escape_string($db->link,$pass);
    $password=md5($password);
    $activity=$_POST['activity'];
    $sql1="INSERT INTO student_info(username,fullname,mobile,email,password,class_id,activity) VALUES('$username','$fullname','$mobile','$email','$password','$class','$activity')";
    $insert=$db->insert($sql1);
    if($insert){
        $msg="Student Data Added Succesfully";
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
        
        <h2 style="color:blue;">Student Add And Student List Option</h2>
        <form class="form-horizontal"  action="" method="post">
            <hr />
            <h3 style="color:green">Student Add Option</h3>
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
            <p style="color:blue;font-weight: bold"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?></p>
            <div class="form-group" >
      <label class="control-label col-sm-2" for="Username">UserID :</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter Username" name="username" required="">
      </div>
       <label class="control-label col-sm-2" for="Fullname">Fullname :</label>
      <div class="col-sm-3">
          <input type="text" class="form-control"  placeholder="Enter Fullname" name="fullname" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Mobile">Mobile Number :</label>
      <div class="col-sm-3">
        <input type="number" class="form-control"  placeholder="Enter Mobile Number" name="mobile">
      </div>
      
      <label class="control-label col-sm-2" for="email">Email :</label>
      <div class="col-sm-3">
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
      </div>
    </div>   
            <div class="form-group">
      <label class="control-label col-sm-2" for="class">Select Class Type :</label>
      <div class="col-sm-3">
          <select name="class" id="" required="">
              <option value="">Select Class Type</option>
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
      <label class="control-label col-sm-2" for="password">Set Student Password :</label>
      <div class="col-sm-3" >
          <input type="password" class="form-control" placeholder="Enter Password" name="password" required="">
      </div>
      
      <label class="control-label col-sm-2" for="Student Activity">Set Student Activity:</label>
      <div class="col-sm-3">
          <select name="activity" id="" required="">
              <option value="">Select Student Activity</option>
              <option value="0">Active</option>
              <option value="1">Deactive</option>

          </select>
      </div>
    </div>      
            
    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-7">
        <input type="submit" name="btn" class="btn btn-success" value="Add Student"/>
      </div>
    </div>
  </form>

     <hr /> 
     <h3 style="color:green">All Student List</h3>
        <div class="container">
	<div class="row">
	<table id="example1" class="table table-striped table-bordered" width="90%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>UserID</th>
                <th>FullName</th>
                <th>Class_ID</th>
                <th>Class Name</th>
                <th>Level</th>
                <th>User Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql2="SELECT * FROM student_info order by id DESC";
            $value1=$db->select($sql2);
            if($value1){
                $count=0;
                while($result1=$value1->fetch_assoc()){
                    $count++;
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $result1['username'];?></td>
                <td><?php echo $result1['fullname'];?></td>
                 <?php
                $class_id=$result1['class_id'];
                $sql3="SELECT * FROM class WHERE secid='$class_id'";
                $value2=$db->select($sql3);
                if($value2){
                    while($result2=$value2->fetch_assoc()){
                ?>
                 <td><?php echo $result2['secid'];?></td>
                <td><?php echo $result2['class_name'];?></td>
                <td><?php echo $result2['level'];?></td>
                <?php } ?>
                <?php } ?>
                <td>
                    <?php 
                    if($result1['activity']=='0'){
                        echo "<span style='color:green'>Active</span>";
                    }
                    if($result1['activity']=='1'){
                        echo "<span style='color:red'>Deactive</span>";
                    }
                    
                    ?>
                
                </td>
                <td><button type="button" data-toggle="modal" id="studentdata" data-target="#studentedit" data-id="<?php echo $result1['id'];?>"class="btn btn-warning btn-xs">Edit</button> | <a href="delstudent.php?id=<?php echo $result1['id'];?>"><button type="button"  onclick=" return confirm('Are you sure you want to delete');" class="btn btn-danger btn-xs">Delete</button></a></td>
                
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
<?php include 'inc/footer.php'; ?>