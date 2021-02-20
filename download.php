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
<?php
      $file = $_GET['filename'];
      $download_path = 'upload/'.$file;
      $file_to_download = $download_path; // file to be downloaded
      header("Expires: 0");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");  header("Content-type: application/file");
      header('Content-length: '.filesize($file_to_download));
      header('Content-disposition: attachment; filename='.basename($file_to_download));
      readfile($file_to_download);
      exit;
?>