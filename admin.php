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
  <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>  
<?php include 'inc/sidebar.php';?>
		
<!-- content-->
    <div class="content">
        
	  <h2 style="color:green;">Welcome, <?php echo ucwords(session::get('fullname'));?></h2>
        
    </div>
<?php include 'inc/footer.php'; ?>