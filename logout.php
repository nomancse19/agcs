<?php ob_start(); ?>
<?php include 'lib/session.php';?>
<?php
session::intit();
session::destroy();

?>