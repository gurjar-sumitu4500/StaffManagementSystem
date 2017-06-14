<?php
 
  $connection = mysqli_connect('localhost', 'root','','employeemanagement');
  if(!$connection){
	  die("connection failed: ".mysqli_connect_error());
  }

?>