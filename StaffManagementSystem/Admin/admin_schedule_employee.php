<?php
  
  include '../controller/connection.php';
  session_start();
  $today = date("Y-m-d");
  $thisweek = date("Y-m-d", strtotime("+7 days"));
  
  
   if(isset($_POST['submit_date'])){
	  $start_date = $_POST['start_date'];
	  $end_date = $_POST['end_date'];
	  $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date BETWEEN '$start_date' AND '$end_date' ORDER BY schedule_date DESC   ";
	  $search_result = filterTable($query);
   }
   else{
	   $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date BETWEEN '$today' AND '$thisweek' ORDER BY schedule_date DESC  ";
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
            <h1>Search For Employee Timesheet</h1>
        </div>
        <div class="inner">
            <form action="admin_schedule_employee.php" method="post">
                 <ol>
                    <li>
     					<label style="color:black;padding-right:10px;">Employee ID:</label> 
						<select required="required" style="width:200px;"  class="form-control" name="employeeid" >
						  <?php 
						  $query2 = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']."";
						  $selectresult = filtertable($query2);
						  while($row = mysqli_fetch_array($selectresult)): ?>
						   <option ><?php echo $row['employee_id'] ;?></option>
						  <?php endwhile;?>
						 </select>
						  <input class="form-control" Style="width:200px;margin-top:10px;" type="date" name="timesheet_date" required >
					</li>
                </ol>
				<hr>
                  <p>
                     <input class="btn-success" type="submit" name="single_employee_timesheet" value="Get Timesheet" />
                  </p>
            </form>
        </div>
        <div class="head">
            <h1>Timesheet</h1>
			<form action="admin_schedule_employee" method="post">
			<input required  onfocus="(this.type='date')" placeholder="<?php echo $today; ?>" type="text" name="start_date" style="width:150px;height:36px;">
			<input required  onfocus="(this.type='date')" placeholder="<?php echo $thisweek; ?>"  type="text" name="end_date" style="width:150px;height:36px;">
			<input type="submit" name="submit_date" value="Filter">
			</form>
        </div>
        <div class="inner">
            <form action="#" id="viewTimesheetForm" method="post" >        
               <table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:15%;">Employee ID</th>
                            <th  style="width:15%;">Employee Name</th>
							<th  style="width:15%;">Status</th>
					        <th  style="width:15%;">Date</th>	
                            <th  style="width:15%;">Start Time</th>
							<th  style="width:15%;">End Time</th>
                            <th  style="width:15%;">Job Title</th>
					   </tr>
						<?php while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
						   <td><?php echo $row['employee_id']; ?></td>
		                   
                           <?php
						         $employee_idd = $row['employee_id'];
                            	 $namequery = "SELECT * FROM sms_employees WHERE employee_id='$employee_idd'";
						         $namequery_result = filterTable($namequery);
								 $row3 = mysqli_fetch_array($namequery_result);
						   ?>
						   <td><?php echo $row3['fname']." ".$row3['lname']; ?></td>
		                   <td><?php echo $row['work_status']; ?></td>
						   <td><?php echo $row['schedule_date']; ?></td>
						   <td><?php echo $row['start_time']; ?></td>
		                   <td><?php echo $row['end_time']; ?></td>
		                   <td><?php echo $row3['employment_status']; ?></td>
						</tr>
						<?php endwhile; ?>
                    </thead>
                    <tbody>
                   </tbody>
			    </table>
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










