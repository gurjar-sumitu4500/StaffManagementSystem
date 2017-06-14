<?php
  
  session_start();
  include 'controller/connection.php';
  
  $admin_id  = $_POST['admin_id'];
  $apassword = $_POST['apassword'];
  $apassword = stripslashes($apassword);
  $apassword = mysqli_real_escape_string($connection ,$apassword);
  
  $sql = "SELECT * FROM admin WHERE admin_id='$admin_id' AND admin_password='$apassword'";
  $result = $connection->query($sql);
  if(!$result){
	  echo("Error description: ".mysqli_error($connection));
  }
  if($row= $result->fetch_assoc()){
	  
	  $_SESSION['admin_name'] = $row['admin_name'];
	  $_SESSION['id'] = $row['admin_id'];
	  $_SESSION['company_id'] = $row['company_id'];
	  header("location: Admin/adminhomepage.php");
  }
  else
  {  
     echo '<script language="javascript">';
     echo 'alert("Wrong Id or Password! Please Try Again.")';
     echo '</script>';
	 header("refresh:0.01;url= login.php"); 
	 session_destroy();
  }
  
?>