<?php
  
  include '../controller/connection.php';
  session_start();
  $yesterday = date("Y-m-d", strtotime("-1 days"));
  
   if(isset($_POST['submit_date'])){
	   $date = $_POST['attendance_date'];
	   $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$date'" ;
	   $search_result = filterTable($query);
	   
   }elseif(isset($_POST['present_employee'])){
	   $date = $_POST['attendance_date'];
	   $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$date' AND work_status='Present' " ;
	   $search_result = filterTable($query);
	   
   }elseif(isset($_POST['absent_employee'])){
	   $date = $_POST['attendance_date'];
	   $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$date' AND work_status='Absent' " ;
   	   $search_result = filterTable($query);
	   
   }else{
	   $query = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND schedule_date='$yesterday'";
	   $search_result = filterTable($query);
   }
   function filterTable($query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $query);
	   return $filter_Result;
   }
   
  if(isset($_POST['mark_absent'])){
	  $attendance_date2 = $_POST['attendance_date2'];
	  $employee_id = $_POST['employee_id'];
	  $query = "UPDATE employee_schedule SET work_status='Absent' WHERE employee_id='$employee_id' AND company_id=".$_SESSION['company_id']." AND schedule_date='$attendance_date2' ";
	  $check = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND employee_id='$employee_id' AND schedule_date='$attendance_date2' ";
	  $check_result = mysqli_query($connection, $check);
	  $data = mysqli_num_rows($check_result);
	  if($data == 0){
		  echo '<script language="javascript">';
          echo 'alert("There is no timesheet of this employee on this date. Please choose another date or employee.")';
          echo '</script>';
	      header("refresh:0.01;url= admin_employee_attendance.php");
	  }else{
		 $mark_absent = $connection->query($query);
		 echo '<script language="javascript">';
         echo 'alert("Employee successfully marked absent.")';
         echo '</script>';
	   header("refresh:0.01;url= admin_employee_attendance.php");
          }
  }
  

?>
<!DOCTYPE html>    
<html>
<head>
   <title>Employee Attendance</title>  
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
        <li class="current" ><a href="#"  ><b>Schedule</b></a>
            <ul>
                 <li><a href="admin_schedule_employee.php"  >Employee Timesheet</a>
                 </li>   
                 <li class="selected" ><a href="admin_employee_attendance.php" >Employee attendance</a>
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
            <h1>Mark Employee</h1>
        </div>
        <div class="inner">
		    <form action="admin_employee_attendance" method="post">
			<input required onfocus="(this.type='date')" type="text" placeholder="<?php echo $yesterday ;?>" name="attendance_date2" style="margin-left:10px;margin-bottom:5px;width:150px;height:36px;">
			<select required name="employee_id" type="number" placeholder="Choose ID" style="margin-left:10px;margin-bottom:5px;width:150px;height:36px;">
			<?php 
						  $query2 = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']."";
						  $selectresult = filtertable($query2);
						  while($row = mysqli_fetch_array($selectresult)): ?>
						   <option ><?php echo $row['employee_id'] ;?></option>
						  <?php endwhile;?>
			</select>
			<input type="submit" name="mark_absent" value="Mark Absent">
			</form>
        </div>
     </div>
	 <div class="box ">
       <div class="head" style="background-color:#FA8072;">
            <h1>Attendance</h1>
			<form action="admin_employee_attendance" method="post">
			<input required onfocus="(this.type='date')" type="text" placeholder="<?php echo $yesterday ;?>" name="attendance_date" style="margin-left:10px;margin-bottom:5px;width:150px;height:36px;">
			<input type="submit" name="submit_date" value="Filter Date">
			<input type="submit" name="present_employee" value="Present Employee">
			<input type="submit" name="absent_employee" value="Absent Employee">
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
		                   <td><input type="text" style="width:100px;"class="btn btn-info" value="<?php echo $row['work_status']; ?>" name="status" readonly></td>
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

