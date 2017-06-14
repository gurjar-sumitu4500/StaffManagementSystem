<?php
  
  include '../controller/connection.php';
  session_start();
  
  global $connection;
  $query2 = "SELECT *FROM admin where admin_id=".$_SESSION['id']." ";
  $result = $connection->query($query2); 
  $row2 = mysqli_fetch_array($result);
 
  if(isset($_POST['save_changes'])){
	global $connection;
	$admin_id = $_POST['admin_id'];
	$admin_name = $_POST['admin_name'];
	$admin_dob = $_POST['admin_dob'];
	$admin_email = $_POST['admin_email'];
	$admin_contact_number = $_POST['admin_contact_number'];
	$admin_password = $_POST['admin_password'];
	$admin_address = $_POST['admin_address'];
	$update_query = "UPDATE admin SET admin_name='$admin_name', admin_dob='$admin_dob', admin_email='$admin_email', admin_contact='$admin_contact_number', admin_password='$admin_password', admin_address='$admin_address'
	WHERE admin_id='$admin_id' AND company_id=".$_SESSION['company_id']."";
	
	if($connection->connect_error){
		die("connection failed:" .$connection->connect_error);
	}
	if($connection->query($update_query) ==TRUE){
	   echo '<script language="javascript">';
          echo 'alert("Profile Updated Successfully!")';
          echo '</script>';
	      header("refresh:0.01;url= admin_profile.php");
	}else{
		echo "Error updating record: " .$connection->error;
	}
    header("Location:admin_profile.php");	
 }
 elseif(isset($_POST['cancel'])){
	 header("Location:adminhomepage.php");
 }
   
?>
<!DOCTYPE html>    
<html>
<head>
   <title>Admin Profile</title>  
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="../CSS/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/main.css" rel="stylesheet" type="text/css"/>    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
</head>
<body>
    <div id="upper">
	   <div id="Company">
          <a href="#" target="_blank"><img src="../SMS.png" style="margin:0px;" width="183" height="90" alt="SMS"/></a>
          <a href="#" id="welcome" class="panelTrigger">Welcome <?php echo $_SESSION['admin_name']; ?> </a>      
       </div>      
      <div class="menu">
         <ul> 
           <li ><a href="#" ><b>Employee</b></a>  
               <ul>
			      <li ><a href="adminhomepage.php">Employee List</a></li>
				  <li><a href="admin_job_titles.php">Job Titles</a></li>
				  </ul>			   
           </li> 		 
           <li class="current"><a href="#" ><b>Admin</b></a>
              <ul>    
     			<li class="selected"><a href="admin_profile.php" >Profile</a>
                </li>   
                </ul>                     
            </li>
        <li  ><a href="#"  ><b>Schedule</b></a>
            <ul>
                 <li><a href="admin_schedule_employee.php"  >Employee Timesheet</a>
                 </li>   
                 <li  ><a href="admin_employee_attendance.php" >Employee attendance</a>
                 </li>         
            </ul>                        
        </li>
        <li><a href="#"  ><b>Leave</b></a>
            <ul>
               <li><a href="admin_leave_requests.php"  >Leave Requests</a>
               </li>   
               <li><a href="admin_approved_list.php" >Approved List</a>
               </li>                   
             </ul>                       
          </li>   
         <li  ><a href="admin_inbox.php" ><b>Query</b></a>
            </li>  
		  <li><a href="#" ><b>About</b></a>                        
          </li> 
          <li><a href="../logout.php" ><b>Logout</b></a>                        
          </li>  
       </ul> 
	 </div>
     <div id="content">                  
       <div class="box ">
        <div class="inner">
            <form action="admin_profile.php" id="viewTimesheetForm" method="post" >                
				<div class="container">
                  <h1>Edit Profile</h1>
  	                <hr>
                        <h3>Personal info</h3> 
                        <form class="form-horizontal" role="form">
                            <label style="margin-top:20px;" class="col-lg-3 control-label">Name:</label>
						    <input name="admin_id" hidden value="<?php echo $_SESSION['company_id']; ?>"> 
                            <input name="admin_name" style="margin-top:15px;" class="form-control" type="text" required Placeholder="<?php echo $row2['admin_name']; ?>">
                            <label style="margin-top:15px;" class="col-lg-3 control-label">Date of Birth:</label>
                            <input style="margin-top:15px;" class="form-control" name="admin_dob" onfocus="(this.type='date')"  type="text" required placeholder="<?php echo $row2['admin_dob']; ?>" >
     			            <label style="margin-top:15px;" class="col-lg-3 control-label">Gender:</label>
                            <input style="margin-top:15px;" class="form-control" disabled type="text" value="<?php echo $row2['admin_gender']; ?>" >
                            <label style="margin-top:15px;" class="col-lg-3 control-label" style="margin-top:10px;">Company ID:</label>
                            <input style="margin-top:15px;" class="form-control" name="company_id" type="text"  disabled value="<?php echo $row2['company_id']; ?>">
                            <label style="margin-top:15px;" class="col-lg-3 control-label">Email:</label>
                            <input style="margin-top:15px;" class="form-control"  type="text" name="admin_email" required placeholder="<?php echo $row2['admin_email']; ?>" >
                            <label style="margin-top:15px;" class="col-md-3 control-label">Contact Number</label>
                            <input style="margin-top:15px;" class="form-control" type="text" name="admin_contact_number" required placeholder="<?php echo $row2['admin_contact']; ?>">
                            <label style="margin-top:15px;" class="col-md-3 control-label">Password:</label>
                            <input style="margin-top:15px;" class="form-control" name="admin_password" type="password" required placeholder="<?php echo $row2['admin_password']; ?>">
                            <label style="margin-top:15px;" class="col-md-3 control-label">Address:</label>
                            <input style="margin-top:15px;" class="form-control " name="admin_address" type="text" required placeholder="<?php echo $row2['admin_address']; ?>">
                            <label class="col-md-3 control-label"></label>
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
   </div>
   <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>

