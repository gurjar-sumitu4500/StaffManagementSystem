<?php
  
  session_start();
  include 'controller/connection.php';
  
  $employee_id = $_POST['ID'];
  $user_password = $_POST['User_password'];
  $company_id = $_POST['Company_id'];
  $user_password = stripslashes($user_password);
  $user_password = mysqli_real_escape_string($connection ,$user_password);
  
  $sql = "SELECT * FROM sms_employees WHERE employee_id='$employee_id' AND employee_password='$user_password' AND company_id='$company_id'";
  $result = $connection->query($sql);
  if(!$result){
	  echo("Error description: ".mysqli_error($connection));
  }
  
  if($row=$result->fetch_assoc()){
	  
	  $_SESSION['user_name'] = $row['fname'].$row['lname'];
	  $_SESSION['user_id'] = $row['employee_id'];
	  $_SESSION['company_id'] = $row['company_id'];
	  header("Location: Employee/Employeehomepage.php");
  }
  else
  {  echo '<script language="javascript">';
     echo 'alert("Wrong Id or Password! Please Try Again.")';
     echo '</script>';
	 header("refresh:0.01;url= login.php");
	 session_destroy();
  }
 
  
?>