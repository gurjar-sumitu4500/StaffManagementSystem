<?php
  
  include '../controller/connection.php';
  session_start();
  
  $query = "SELECT * FROM leaves WHERE company_id=".$_SESSION['company_id']." AND employee_id=".$_SESSION['user_id']." ";
  $result = $connection->query($query);
  if(isset($_POST['apply_for_leave'])){
	 $date_of_leave = $_POST['Date_of_leave'];
     $leave_type = $_POST['leave_type'];
     $description_of_leave = mysqli_real_escape_string($connection, $_POST['description_of_leave']);
     $date_of_apply = date("Y-m-d");
     $time_of_apply = date('G:i:s');
     $status = "Pending";
    
     $apply_leave_query = "INSERT INTO `leaves`(`leave_type`, `date_of_leave`, `employee_id`, `time_of_apply`, `description`, `date_of_apply`, `Status`,`company_id`)
                           VALUES('$leave_type','$date_of_leave',".$_SESSION['user_id'].",'$time_of_apply','$description_of_leave','$date_of_apply','$status',".$_SESSION['company_id'].")";	
     $apply = $connection->query($apply_leave_query);
	 
	 $update_table = "UPDATE employee_schedule SET work_status='$status' WHERE company_id=".$_SESSION['company_id']." AND employee_id=".$_SESSION['user_id']." AND schedule_date='$date_of_leave'";
	 if(!$connection->query($update_table)){
		  echo("Error description: ".mysqli_error($connection));
	 }else{
		 echo '<script language="javascript">';
          echo 'alert("Leave Request Send Successfully!")';
          echo '</script>';
	      header("refresh:0.01;url= employee_shifts.php");
	 }
  }
?>
<!DOCTYPE html>    
<html>
<head>
   <title>Leave/Holidays</title>  
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
           <li ><a href="Employeehomepage.php" ><b>Profile</b></a>			   
           </li> 		 
           <li><a href="employee_shifts.php" ><b>Shifts</b></a>                     
            </li>
			<li><a href="employee_query.php" ><b>Query</b></a>                     
            </li>
        <li><a href="employee_attendance.php"  ><b>Attendance</b></a>                       
        </li>
        <li class="current"><a href="employee_holidays.php"  ><b>Leave/Holidays</b></a>   
        <li><a href="../logout.php" ><b>Logout</b></a>                        
        </li>  
       </ul> 
	 </div>
    <div id="content">                  
       <div class="box">	
        <div class="head">
            <h1>Holidays</h1>
        </div>
        <div class="inner">
            <form action="#" id="viewTimesheetForm" method="post" >        
               <table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:15%;">Date</th>
                            <th  style="width:15%;">Leave Type</th>
							<th  style="width:15%;">Date_of_apply</th>
					        <th  style="width:15%;">Status</th>							
					   </tr>
					   <?php while($row = mysqli_fetch_array($result)): ?>
						<tr>
						   <td><?php echo $row['date_of_leave']; ?></td>
		                   <td><?php echo $row['leave_type']; ?></td>
		                   <td><?php echo $row['date_of_apply']; ?></td>
		                   <td><?php echo $row['Status']; ?></td>
						</tr>
						<?php endwhile; ?>
                    </thead>
                    <tbody>
                   </tbody>
			    </table>
            </form>
        </div>
     </div>
	   <div class="box ">
        <div class="inner">
            <form action="employee_holidays.php" id="viewTimesheetForm" method="post" >                
				<div class="container">
                  <h1 style="background-color:red;color:white;">Request a Leave</h1>
  	                <hr>
                        <h3>Leave Form</h3> 
                        <form class="form-horizontal" role="form">
                         <div class="form-group">
						  <div class="col-sm-6">   
						    <label style="margin-top:20px;" class="col-lg-3 control-label">Date:</label> 
                            <input name="Date_of_leave" required style="margin-top:15px;" class="form-control" type="text" onfocus="(this.type='date')" Placeholder="Date of Leave">
							<label style="margin-top:20px;" class="col-lg-3 control-label">Type of Leave:</label>
                            <select style="margin-top:15px;" required class="form-control" name="leave_type" type="text" >
							<option >Sick</option>
							<option>Time Off Without Pay</option>
							<option>Personal Leave</option>
							<option>Maternity/Paternity</option>
							<option>Others</option>
							</select>
     			            <label style="margin-top:20px;" class="col-lg-6 control-label">Description of Leave:</label>
                            <textarea required  style="margin-top:15px;height:200px;width:550px;" class="form-control" name="description_of_leave" type="text" placeholder="Describe the Reason of Leave" ></textarea>
                            <input name="apply_for_leave" style="margin-top:20px;float:right;"type="Submit" class="btn btn-primary" value="Apply">
                          </div>
						</div>
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

