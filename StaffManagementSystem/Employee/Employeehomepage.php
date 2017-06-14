<?php
  
  include '../controller/connection.php';
  session_start();
  
  $query = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']." AND employee_id=".$_SESSION['user_id']." ";
  $result = $connection->query($query);
  $row = mysqli_fetch_array($result);
  if(isset($_POST['save_changes'])){
	global $connection;
	$user_employment_status = $_POST['employment_status'];
	$first_name = $_POST['user_fname'];
	$last_name = $_POST['user_lname'];	
	$user_dob = $_POST['user_dob'];
	$user_email = $_POST['user_email'];
	$user_contact_number = $_POST['user_contact_number'];
	$user_password = $_POST['user_password'];
	$user_address = $_POST['user_address'];
	$update_query = "UPDATE sms_employees SET fname='$first_name', lname='$last_name' , dob='$user_dob', email='$user_email', employment_status='$user_employment_status', contact_number='$user_contact_number', employee_password='$user_password', Address='$user_address'
	WHERE employee_id=".$_SESSION['user_id']." AND company_id=".$_SESSION['company_id']."";
	
	if($connection->connect_error){
		die("connection failed:" .$connection->connect_error);
	}
	if($connection->query($update_query) ==TRUE){
	   echo '<script language="javascript">';
          echo 'alert("Profile Updated Successfully!")';
          echo '</script>';
	      header("refresh:0.01;url= Employeehomepage.php");
	}else{
		echo "Error updating record: " .$connection->error;
	}
    header("Location:Employeehomepage.php");	
 }
 
?>
<!DOCTYPE html>    
<html>
<head>
   <title>Homepage</title>  
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="../CSS/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/main.css" rel="stylesheet" type="text/css"/>    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
</head>
<body>
    <div id="upper">
	   <div id="Company">
          <a href="#" target="_blank"><img src="../SMS.png" style="margin:0px;" width="183" height="90" alt="SMS"/></a>
          <a href="#" id="welcome" class="panelTrigger">Welcome <?php echo $_SESSION['user_name']; ?></a>      
       </div>      
       <div class="menu">
         <ul> 
           <li class="current"><a href="Employeehomepage.php" ><b>Profile</b></a>			   
           </li> 		 
           <li><a href="employee_shifts.php" ><b>Shifts</b></a>                     
            </li>
			<li><a href="employee_query.php" ><b>Query</b></a>                     
            </li>
        <li><a href="employee_attendance.php"  ><b>Attendance</b></a>                       
        </li>
        <li><a href="employee_holidays.php"  ><b>Leave/Holidays</b></a>   
        <li><a href="../logout.php" ><b>Logout</b></a>                        
        </li>  
       </ul> 
	 </div>
    <div id="content">                  
       <div class="box ">
        <div class="inner">
            <form action="Employeehomepage.php" id="viewTimesheetForm" method="post" >                
				<div class="container">
                  <h1>Profile</h1>
  	                <hr>
                        <h3>Personal info</h3> 
                        <form class="form-horizontal" role="form">
                         <div class="form-group">
						  <div class="col-sm-6">   
						    <label style="margin-top:20px;" class="col-lg-3 control-label">First Name:</label> 
                            <input name="user_fname" style="margin-top:15px;" class="form-control" type="text"   required Placeholder="<?php echo $row['fname']; ?>">
                          </div>
                          <div class="col-sm-6">						  
						   <label style="margin-top:20px;" class="col-lg-3 control-label">Last Name:</label> 
                            <input name="user_lname" style="margin-top:15px;" class="form-control" type="text"  required Placeholder="<?php echo $row['lname']; ?>">
                          </div>
						</div>
						<div class="form-group">
						  <div class="col-sm-6">
							<label style="margin-top:20px;" class="col-lg-3 control-label">Date of Birth:</label>
                            <input style="margin-top:15px;" class="form-control" name="user_dob" type="text" required onfocus="(this.type='date')" placeholder="<?php echo $row['dob']; ?>" >
     			          </div>
						  <div class="col-sm-6">  
							<label style="margin-top:20px;" class="col-lg-3 control-label">Gender:</label>
                            <input style="margin-top:15px;" class="form-control" name="user_gender" disabled type="text" value="<?php echo $row['gender']; ?>" >
                          </div>
						</div>
						<div class="form-group">
						  <div class="col-sm-6">
							<label style="margin-top:20px;" class="col-lg-3 control-label" style="margin-top:10px;">Company ID:</label>
                            <input style="margin-top:15px;" class="form-control" name="company_id" type="text"  disabled value="<?php echo $row['company_id']; ?>">
                          </div>
                          <div class="col-sm-6">						  
						    <label style="margin-top:20px;" class="col-lg-6 control-label" style="margin-top:10px;">Identification Number:</label>
                            <input style="margin-top:15px;" class="form-control" name="employee_id" type="text"  disabled value="<?php echo $row['employee_id']; ?>">
						  </div>
						</div>
						<div class="form-group">
                          <div class="col-sm-6">						
							<label style="margin-top:20px;" class="col-lg-3 control-label" style="margin-top:10px;">Job Title:</label>
                            <input style="margin-top:15px;" class="form-control" name="job_title" type="text"  disabled value="<?php echo $row['job_title']; ?>">
						  </div>
						  <div class="col-sm-6">	
							<label style="margin-top:20px;" class="col-lg-6 control-label">Employment Status:</label> 
                            <input name="employment_status" style="margin-top:15px;" class="form-control" required type="text"  Placeholder="<?php echo $row['employment_status']; ?>">
                          </div>
						</div>
						<div class="form-group">
						  <div class="col-sm-6">
							<label style="margin-top:20px;" class="col-lg-3 control-label">Email:</label>
                            <input style="margin-top:15px;" class="form-control"  type="email" name="user_email" required value="<?php echo $row['email']; ?>" >
                          </div>
						  <div class="col-sm-6">
     						<label style="margin-top:20px;" class="col-md-6 control-label">Contact Number</label>
                            <input style="margin-top:15px;" class="form-control" type="text" name="user_contact_number" required value="<?php echo $row['contact_number']; ?>">
                          </div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
							<label style="margin-top:20px;" class="col-md-3 control-label">Password:</label>
                            <input style="margin-top:15px;" class="form-control" name="user_password" type="password" required value="<?php echo $row['employee_password']; ?>">
                            </div>
							<div class="col-sm-6">
							<label style="margin-top:20px;" class="col-md-3 control-label">Address:</label>
                            <input style="margin-top:15px;" class="form-control " name="user_address" type="text" required value="<?php echo $row['Address']; ?>">
                            </div>
						</div>
                            <input name="save_changes" style="margin-top:20px;float:right;"type="Submit" class="btn btn-primary" value="Save Changes">
                            <input name="cancel" type="reset" style="margin-top:20px;float:right;" class="btn btn-default" value="Cancel">
                     </form>                   
				   </div>
			      </form>
               </div>
           </div>
         <hr>
       </div>
   </div>
   <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>

