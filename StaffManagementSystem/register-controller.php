<?php
      
	  session_start();
	  include 'controller/connection.php';
      
	  
      $admin_id = $_POST['ID'];
	  $company_name = $_POST['Company_name'];
	  $admin_password = $_POST['admin_password'];
	  $admin_name = $_POST['admin_name'];
	  $admin_email = $_POST['admin_email'];
	  $admin_contact = $_POST['admin_contact'];
	  $admin_gender = $_POST['admin_gender'];
	  $admin_dob = $_POST['admin_dob'];
	  $admin_address = $_POST['admin_address'];
	  $check = "SELECT * FROM admin WHERE admin_id=$admin_id ";
      $check_result = mysqli_query($connection, $check);
      $data = mysqli_num_rows($check_result);
      if($data > 0){
		  echo '<script language="javascript">';
          echo 'alert("Admin ID already Exists! Try again with another Admin ID.")';
          echo '</script>';
	      header("refresh:0.01;url= register.php");
	  }else{
	  $create = "INSERT INTO `admin`(`admin_id`,`admin_name`,`admin_password`,`admin_email`,`admin_contact`,`admin_address`,`admin_gender`,`admin_dob`,`company_name`)
                 VALUES('$admin_id','$admin_name','$admin_password','$admin_email','$admin_contact','$admin_address','$admin_gender','$admin_dob','$company_name')";
	  $create_admin = $connection->query($create);
		 echo '<script language="javascript">';
         echo 'alert("New Company added Successfully!")';
         echo '</script>';
	   header("refresh:0.01;url= login.php"); 
	 }
?>