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
if(isset($_POST["stdbtn"])){
     $permited  = array('csv');
		$filename=$_FILES["file"]["tmp_name"];
                $file_name = $_FILES['file']['name'];
                 $div = explode('.', $file_name);
                 $file_ext = strtolower(end($div));
                 if (in_array($file_ext, $permited) === false) {
                          $msg1="You can upload only Excel CSV Format File";
                         }else{
		 if($_FILES["file"]["size"] > 0)
		 {
		  $file = fopen($filename, "r");
	         while (($studentdata= fgetcsv($file, 10000, ",")) !== FALSE)
	         {
                     $password=12345;
                     $password=md5($password);
                   $sql="INSERT INTO student_info(username,fullname,class_id,password,activity) VALUES('$studentdata[0]','$studentdata[1]','$studentdata[2]','$password','0')";
                    $insert=$db->insert($sql);
                    if(!$insert){
                        $msg1="You Can Only Upload Excel CSV File";
                    }
	         }
                 $msg="Student Data Imported Successfully";	
			
		 }else{
                     $msg1="File Is Empty ";
                 }
	}
}


else if(isset($_POST["classbtn"])){
     $permited  = array('csv');
		$filename=$_FILES["file"]["tmp_name"];
                $file_name = $_FILES['file']['name'];
                 $div = explode('.', $file_name);
                 $file_ext = strtolower(end($div));
                 if (in_array($file_ext, $permited) === false) {
                          $msg2="You can upload only Excel CSV Format File";
                         }else{
		 if($_FILES["file"]["size"] > 0)
		 {
		  $file = fopen($filename, "r");
	         while (($studentdata= fgetcsv($file, 10000, ",")) !== FALSE)
	         {
                    $user=session::get('username') ;
                   $sql="INSERT INTO class(secid,class_name,level,user) VALUES('$studentdata[6]','$studentdata[7]','$studentdata[1]','$user')";
                    $insert=$db->insert($sql);
                    if(!$insert){
                        $msg2="You Can Upload Only Excel CSV File";
                    }
	         }
	         //throws a message if data successfully imported to mysql database from excel file
		 $msg3="Class Data Emported Successfully";	
			
		 }else{
                     $msg2="File Is Empty ";
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
        
        <h2 style="color:blue;">Auto Upload Excel CSV File In Student And Class</h2>
    <form class="form-horizontal"  action="" method="post" enctype="multipart/form-data">
            <hr />

            <h3 style="color:green">Student File Upload Option </h3>
           
            <p style="color:blue;font-weight: bold"><?php if(isset($msg)) {echo $msg;} ?></p>
             
            <p style="color:red;font-weight: bold"><?php if(isset($msg1)) {echo $msg1;} ?></p>
            
    <div class="form-group" >
      <label class="control-label col-sm-5">
        <p data-placement="bottom" data-toggle="studentup" title="Before Upload Excel File Please, Confirm That Your Excel File Save As CSV File Format. And File Column Must Be Follow This Format.C1=StudentID, C2=StudentName,
        C3=SecID"><span style="color:red;font-weight: bold;">***Special Rules For Upload CSV File.Click Here ***</span></p>
     </label>
   </div>
   <div class="form-group" >
      <label class="control-label col-sm-2" for="Username">Select Excel CSV File : </label>
     
      <div class="col-sm-3">
          <input type="file"   name="file" required="">
      </div>
      </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-2">
        <input type="submit" name="stdbtn" class="btn btn-success" value="Upload Students"/>
      </div>
    </div>
  </form>

     <hr /> 
     <form class="form-horizontal"  action="" method="post" enctype="multipart/form-data">
      <h3 style="color:green">Class Upload Option</h3>

           <p style="color:blue;font-weight: bold"><?php if(isset($msg3)) {echo $msg3;} ?></p>
            <p style="color:red;font-weight: bold"><?php if(isset($msg2)) {echo $msg2;} ?></p>
             <div class="form-group" >
      <label class="control-label col-sm-5">
        <p data-placement="bottom" data-toggle="studentup" title="Before Upload Excel File Please, Confirm That Your Excel File Save As CSV File Format.
          And File Column Must Be Follow 
          This Format...C2=Medium,
          C7=SecID,C8=SecName ..."><span style="color:red;font-weight: bold;">***Special Rules For Upload CSV File.Click Here ***</span></p>
     </label>
   </div>
    <div class="form-group" >
      <label class="control-label col-sm-2" for="Username">Select Excel CSV File</label>
     
      <div class="col-sm-3">
          <input type="file" name="file" required="">
      </div>
      </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-2">
        <input type="submit" name="classbtn" class="btn btn-success" value="Upload Class"/>
      </div>
    </div>
  </form>
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
$(document).ready(function(){
    $('[data-toggle="studentup"]').tooltip();   
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