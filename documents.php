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
    $filename=$_POST['filename']; 
    $class=$_POST['class'];
    $class_id="";
    foreach ($class as $classid) {
	$class_id.= $classid.",";	
        }
    $permited  = array('pdf','doc','docx','jpg','xlsx');
		$file_name = $_FILES['file']['name'];
		$file_size = $_FILES['file']['size'];
		$file_temp = $_FILES['file']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		
		
		$uploaded_file = $file_name;
		
	   
	   if (empty($file_name)) {
		$msg= "<span style='color:red'>Please Select any Pdf File !</span>";
	   }
	   elseif ($file_size >5048567) {
		$msg= "<span style='color:red'>Image Size should be less then 1MB!
		</span>";
	   } 
	   elseif (in_array($file_ext, $permited) === false) {
		$msg= "<span style='color:red'>You can upload only:-"
		.implode(', ', $permited)."</span>";
	   }
	   
	   else 
            {
             move_uploaded_file($file_temp, "upload/".$uploaded_file);
              $sql1="INSERT INTO documents(name,file,class_id) VALUES('$filename','$uploaded_file','$class_id')";
                $insert=$db->insert($sql1);
                if($insert){
                    $msg="Your Document Uploaded Success";
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
        
        <h2 style="color:blue;">All Document Add And Delete Option</h2>
        <form class="form-horizontal"  action="" method="post"  enctype="multipart/form-data">
            <hr />
            <h3 style="color:green">All Documents Add Option</h3>
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
            <p style="color:blue;font-weight: bold"><?php if(isset($_GET['msg'])) {echo $_GET['msg'];} ?></p>
    <div class="form-group" >
      <label class="control-label col-sm-2" for="File Name">File Name</label>
     
      <div class="col-sm-3">
          <input type="text" class="form-control" placeholder="Enter File Name Or Short Note" name="filename" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Fullname">Select File :</label>
      <div class="col-sm-3">
          <input type="file" name="file" />
      </div>
    </div>
      <div class="form-group">
        <label for="class" class="control-label col-sm-1"></label>
        <div class="col-sm-4">
          <p style="color:red;font-weight: bold;font-size:16px;" data-placement="bottom" data-toggle="selectclass"  
          title="You Can Select Multiple Class Select By Pressing CTRL And
          Select Class.For Need All Class You Can Select Auto All
          class Select">
        Special Rule For Select Multiple Class
      </p>
      </div>
      </div>
      <div class="form-group">  
      <label class="control-label col-sm-2" for="class">Select Multiple Class Type :</label>
      <div class="col-sm-3">
          <select size="10" name="class[]" id="" required="" multiple="multiple">
              <option value="">Select Class Type</option>
              <option value="all" style="color:red;font-weight: bold;">Auto All Class Select</option>
              <?php 
              $sql="SELECT * FROM class";
              $value=$db->select($sql);
              if($value){
                  while($result=$value->fetch_assoc()){
              ?>
              <option value="<?php echo $result['secid'];?>"><?php echo $result['class_name'];echo "&nbsp;&nbsp;&nbsp;"; echo $result['level']; ?></option>
              <?php } ?>
              <?php } ?>
          </select>
      </div>
    </div>      
            
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-4">
        <input type="submit" name="btn" class="btn btn-success" value="Upload Documents"/>
      </div>
    </div>
  </form>

     <hr /> 
     <h3 style="color:green">All Documents Or Note List</h3>
        <div class="container">
	<div class="row">
	<table id="example1" class="table table-striped table-bordered" width="80%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Update</th>
                <th>Description</th>
                <th>File Name</th>
                <th>Permitted Class ID</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql2="SELECT * FROM documents order by id DESC";
            $value1=$db->select($sql2);
            if($value1){
                $count=0;
                while($result1=$value1->fetch_assoc()){
                    $count++;
            ?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $fm->formatdatetime($result1['update']);?></td>
                <td><?php echo ucwords($result1['name']);?></td>
                <td><?php echo ucwords($result1['file']);?></td>
                <td><?php echo $result1['class_id'];?></td>
                <td><a href="deldocument.php?id=<?php echo $result1['id'];?>"><button onclick=" return confirm('Are you sure you want to delete');" type="button" class="btn btn-danger btn-xs">Delete</button></a></td>
           
            </tr>
             <?php }?>
             <?php }?>
                
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
    $('[data-toggle="selectclass"]').tooltip();   
});
</script>
<?php include 'inc/footer.php'; ?>