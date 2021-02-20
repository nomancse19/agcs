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
    $fullname=$_POST['fullname'];
    $fullname= mysqli_real_escape_string($db->link,$fullname);
    $email=$_POST['email'];
    $email= mysqli_real_escape_string($db->link,$email);
    $password=$_POST['password'];
    $password= mysqli_real_escape_string($db->link,$password);
    $password= md5($password);
    $sql1="INSERT INTO admin(username,fullname,email,password,admin_type) VALUES('$username','$fullname','$email','$password','0')";
    $insert=$db->insert($sql1);
    if($insert){
        $msg="Admin User Added Succesfully";
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
        
        <h2 style="color:blue;">Admin User Add And List Option</h2>
        <form class="form-horizontal"  action="" method="post">
            <hr />
            <h3 style="color:green">Admin User Add Option</h3>
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
            <p style="color:blue;font-weight: bold"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?></p>
    <div class="form-group" >
      <label class="control-label col-sm-2" for="Username">Enter User Name:</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter Admin User Name" name="username" required="">
      </div>
      <label class="control-label col-sm-2" for="Username">Enter Full Name :</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter Admin Full Name" name="fullname" required="">
      </div>
      </div>
      <div class="form-group" >
      <label class="control-label col-sm-2" for="Username">Enter Email :</label>
     
      <div class="col-sm-3">
          <input type="email" class="form-control" placeholder="Enter Email" name="email" required="">
      </div>
      <label class="control-label col-sm-2" for="Username">Enter Password :</label>
     
      <div class="col-sm-3">
          <input type="password" class="form-control" placeholder="Enter Password" name="password" required="">
      </div>
      </div>

    
    <div class="form-group">        
      <div class="col-sm-offset-4 col-sm-5">
        <input type="submit" name="btn" class="btn btn-success" value="Add Admin User"/>
      </div>
    </div>
  </form>

     <hr /> 
     <h3 style="color:green">All Admin List</h3>
        <div class="container">
	<div class="row">
	<table id="example1" class="table table-striped table-bordered" width="90%">
        <thead>
            <tr>
                <th>SL</th>
                <th>User name</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql2="SELECT * FROM admin order by id DESC";
            $value1=$db->select($sql2);
            if($value1){
                $count=0;
                while($result1=$value1->fetch_assoc()){
                    $count++;
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $result1['username'];?></td>
                <td><?php echo ucwords($result1['fullname']);?></td>
                <td><?php echo ucwords($result1['email']);?></td>
                <td><a href="deladmin.php?id=<?php echo  $result1['id'];?>"><button  type="button" onclick=" return confirm('Are You Sure You Want To Delete Admin');" class="btn btn-danger btn-xs">Delete</button></a></td>
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