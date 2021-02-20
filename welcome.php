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
  <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>  
<!--Sidebar--> 
    <div class="sidebar-nav">
    <ul>
        <li><a style="color:blue;font-weight: bold;" href="#" class="nav-header"><span style="color:green;font-weight: bold;font-size:50px;">. </span>Hello, <?php echo ucwords(session::get('username')); ?></a></li>
        <li><a href="welcome.php" class="nav-header"><i class="fa fa-user"></i> Home</a></li>
        <li><a href="changepassword.php" class="nav-header"><i class="fa fa-edit"></i>Change Password</a></li>
        <li><a href="logout.php" class="nav-header"><i class="fa fa-power-off"></i>Sign out</a></li>
               
            </ul>
    </div>
	
<!--Sidebar-End--> 
		
<!-- content-->
    <div class="content"> 
        <h2 style="color:green;">Welcome, <?php echo ucwords(session::get('fullname'))." ,Your Section ID- ".session::get('class_id');?></h2>
	<h3 style="color:blue;">Download Notes And Document</h3>
        <hr>
         <div class="container">
	<div class="row">
	<table id="example1" class="table table-striped table-bordered" width="90%">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Updated On</th>
                <th>Description</th>
                <th>Filename</th>
                <th>Allow Class ID/ Section ID</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $classid=session::get("class_id");
            $allclass='all,';
            $sql="SELECT * FROM documents WHERE class_id LIKE '%$classid%' OR class_id LIKE '%$allclass%' order by id DESC";
            $value=$db->select($sql);
            if($value){
                $count=0;
                while($result=$value->fetch_assoc()){
                    $count++;
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $fm->formatdatetime($result['update']); ?></td>
                <td><?php echo ucwords($result['name']); ?></td>
                <td><?php echo ucwords($result['file']);?></td>
                <td>
                    <?php 
                    if($result['class_id']=='all,'){
                        echo "Documents For All Class";
                    }else{
                        echo session::get('class_id');
                    }
                    ?>
                
                </td>
                <td><a href="download.php?filename=<?php echo $result['file'];?>"><button type="button" class="btn btn-warning btn-sm">Download</button></a> <a href="upload/<?php echo ucwords($result['file']);?>"><button type="button" class="btn btn-success btn-sm">Direct Download</button></a></td></
            </tr>
            
        </tbody>
            <?php } ?>
            <?php } ?>
    </table>
    </div>
    </div>
    </div>
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