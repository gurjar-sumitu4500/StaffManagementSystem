<?php
  
session_start();

unset($_SESSION['admin_name']);
session_destroy();
 echo '<script language="javascript">';
         echo 'alert("Logout Successfully!")';
          echo '</script>';
		header("refresh:0.01;url= index.php"); 
?>