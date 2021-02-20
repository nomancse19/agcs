
<!--
Author: Jahidul Islam Noman
Programmer: Jahidul Islam Noman
Database And Design Concept: Jahidul Islam Noman
Mobile: 01521451354
Email: Noman.cse19@gmail.com
Web: www.noman-it.com
Created Date: 06-07-2018
-->
<!--Sidebar--> 
    <div class="sidebar-nav">
    <ul>
      <li><a style="color:blue;font-weight: bold;" href="#" class="nav-header"><span style="color:green;font-weight: bold;font-size:50px;">. </span>Hello, <?php echo ucwords(session::get('username')); ?></a></li>
    <li><a href="admin.php" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Home</a></li>

        <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-user"></i>Student Panel<i class="fa fa-collapse"></i></a></li>
        <li><ul class="legal-menu nav nav-list collapse">
            <li ><a href="studentlist.php"><span class="fa fa-caret-right"></span>Student List</a></li>
            <li ><a href="upstudent.php"><span class="fa fa-caret-right"></span>Upload Student /Class</a></li>
            <li ><a href="classlist.php"><span class="fa fa-caret-right"></span>Class List</a></li>
            <li ><a href="studentmng.php"><span class="fa fa-caret-right"></span>Student Management</a></li>
            
    </ul></li>

        <li><a href="documents.php" class="nav-header"><i class="fa fa-folder"></i>Upload Documents</a></li>
        <li><a href="adminlist.php" class="nav-header"><i class="fa fa-user"></i>Add Admin</a></li>
            <li><a href="logout.php" class="nav-header"><i class="fa fa-power-off"></i>Logout</a></li>
               
            </ul>
    </div>
	
<!--Sidebar-End--> 