<?php
  
  include '../controller/connection.php';
  session_start();
  $today = date("Y-m-d");
  
   if(isset($_POST['submit_date'])){
	  $date = $_POST['filter_date'];
	  $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$date' ";
	  $search_result = filterTable($query);
   }
   else{
	   $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$today'";
	   $search_result = filterTable($query);
   }
   function filterTable($query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $query);
	   return $filter_Result;
   }
   if(isset($_POST['single_employee_timesheet'])){
	   
	   $_SESSION['timesheet_date'] = $_POST['timesheet_date'];
	   $_SESSION['employee-id']    = $_POST['employeeid'];
	   header("Location: admin_employee_timesheet.php");
   }
   
  if(isset($_POST['cancel'])){
	header("Location: admin_schedule_employee.php");  
  }
  
  if(isset($_POST['add_timesheet'])){
    
     $employee = $_POST['employeeid'];
     $date = $_POST['schedule_date'];
     $start_time = $_POST['start_time'];
     $end_time = $_POST['end_time'];
     $work_status = $_POST['status'];
     $add_timesheet_query = "INSERT INTO `employee_schedule`(`employee_id`, `schedule_date`,`start_time`,`end_time`,`work_status`,`company_id`)
	                         VALUES('$employee','$date','$start_time','$end_time','$work_status',".$_SESSION['company_id'].")"; 	 
     $insert_add_timesheer_query = filterTable($add_timesheet_query);
	 if($insert_add_timesheer_query== true){
		  echo '<script language="javascript">';
         echo 'alert("New Employee Timesheet is added Successfully!")';
          echo '</script>';
		header("refresh:0.01;url= admin_schedule_employee.php"); 
	  
	 }
  }
  
  
  
  

?>
<!DOCTYPE html>    
<html>
<head>
   <title>Employee Timesheets</title>  
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="../CSS/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/main.css" rel="stylesheet" type="text/css"/>    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
</head>
<body>
    <div id="upper">
	   <div id="Company">
          <a href="#" target="_blank"><img src="../SMS.png" style="margin:0px;" width="183" height="90" alt="SMS"/></a>
          <a href="#" id="welcome" class="panelTrigger">Welcome <?php echo $_SESSION['admin_name']; ?></a>      
       </div>      
       <div class="menu">
         <ul> 
           <li ><a href="#" ><b>Employee</b></a>  
               <ul>
			      <li ><a href="adminhomepage.php">Employee List</a></li>
				  <li><a href="admin_job_titles.php">Job Titles</a></li>
				  </ul>			   
           </li> 		 
           <li><a href="#" ><b>Admin</b></a>
              <ul>    
     			<li><a href="admin_profile.php" >Profile</a>
                </li>   
                </ul>                     
            </li>
        <li class="current"><a href="#"  ><b>Schedule</b></a>
            <ul>
                 <li class="selected" ><a href="admin_schedule_employee.php"  >Employee Timesheet</a>
                 </li>   
                 <li><a href="admin_employee_attendance.php" >Employee attendance</a>
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
        <div class="head">
            <h1>Add Timesheet</h1>
        </div>
        <div class="inner">
            <form action="admin_employee_timesheet_add.php" id="viewTimesheetForm" method="post" >        
               <table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:15%;">Employee ID</th>
					        <th  style="width:15%;">Date</th>	
                            <th  style="width:15%;">Start Time</th>
							<th  style="width:15%;">End Time</th>
							<th  style="width:15%;">Status</th>
					   </tr>
						<tr>
						   <td><select required="required" style="width:200px;"  class="form-control" name="employeeid" >
						      <option disabled selected hidden >Choose ID Number</option>
						          <?php 
						           $query2 = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']."";
						           $selectresult = filtertable($query2);
						           while($row = mysqli_fetch_array($selectresult)): ?>
						      <option ><?php echo $row['employee_id'] ;?></option>
						          <?php endwhile;?>
						      </select>
						  </td>
						  <td>
						    <input type="date" name="schedule_date">
						  </td>
						  <td>
						    <input type="time" name="start_time">
						  </td>
						  <td>
						    <input type="time" name="end_time">
						  </td>
						   <td>
						    <input type="text" class="btn btn-info" value="Present" name="status" readonly>
						  </td>
						</tr>
                    </thead>
                    <tbody>
                   </tbody>
			    </table>
				<input type="submit" name="add_timesheet" value="Add">
				<input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
     </div>
      </div>
     </div>
   <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>










