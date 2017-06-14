<?php
  
  include '../controller/connection.php';
  session_start();
  
  
  $timesheet_date = $_SESSION['timesheet_date'];
  $employee_id   =  $_SESSION['employee-id'];
  
  $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$timesheet_date' AND employee_id='$employee_id'";
  $search_result = filterTable($query);
  function filterTable($query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $query);
	   return $filter_Result;
   }
  if(isset($_POST['Add'])){
	  header("Location: admin_employee_timesheet_add.php");
	  
  }
  elseif(isset($_POST['Update'])){
	  header("Location: admin_employee_timesheet_update.php");
  }
   
?>
<!DOCTYPE html>    
<html>
<head>
   <title>Admin Employee Timesheet</title>  
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
                 <li class="selected"><a href="admin_schedule_employee.php">Employee Timesheet</a>
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
         <li ><a href="admin_inbox.php" ><b>Query</b></a>
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
            <h1>List of Employee</h1>
        </div>
        <div class="inner">
            <form action="admin_employee_timesheet.php" id="viewTimesheetForm" method="post" >        
                <table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:15%;">Employee ID</th>
                            <th  style="width:15%;">Date</th>
							<th  style="width:15%;">Start Time</th>
                            <th  style="width:15%;">End Time</th>
							
                        </tr>
						<?php while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
						   <td><?php echo $row['employee_id']; ?></td>
		                   <td><?php echo $row['schedule_date']; ?></td>
		                   <td><?php echo $row['start_time']; ?></td>
		                   <td><?php echo $row['end_time']; ?></td>
						</tr>
						<?php endwhile; ?>
                    </thead>
                    <tbody>
                   </tbody>
			    </table>
				<input type="submit" style="margin-top:10px;" name="Add" value="Add">
				<input type="submit" style="margin-top:10px;" name="Update" value="Update">
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

