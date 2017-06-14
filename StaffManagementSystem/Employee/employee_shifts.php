<?php
  
  include '../controller/connection.php';
  session_start();
  
  $today = date("Y-m-d");
  $nextweek = date("Y-m-d", strtotime("+7 days"));
  
  $query = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']." AND employee_id=".$_SESSION['user_id']." ";
  $result = $connection->query($query);
  $row = mysqli_fetch_array($result);
 if(isset($_POST['submit_date'])){
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
	$work_status = "Present";
	$query2 = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND work_status='$work_status'  AND employee_id=".$_SESSION['user_id']." AND schedule_date BETWEEN '$start_date' AND '$end_date' ORDER BY schedule_date DESC  ";
    $schedule_result = $connection->query($query2);
 }else
 {
	$work_status = "Present";
	$query2 = "SELECT * FROM employee_schedule WHERE company_id=".$_SESSION['company_id']." AND work_status='$work_status' AND employee_id=".$_SESSION['user_id']." AND schedule_date BETWEEN  '$today' AND '$nextweek' ORDER BY schedule_date DESC  ";
    $schedule_result = $connection->query($query2);
   
 }
 if(!$connection->query($query2)){
	  echo("Error description: ".mysqli_error($connection));
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
           <li><a href="Employeehomepage.php" ><b>Profile</b></a>			   
           </li> 		 
           <li  class="current" ><a href="employee_shifts.php" ><b>Shifts</b></a>                     
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
      <div class="box">	
        <div class="head">
            <h1>Timesheet</h1>
			<form action="employee_shifts.php" method="post">
			<input required  onfocus="(this.type='date')" type="text" placeholder="Start Date" name="start_date" style="width:150px;height:36px;">
			<input required  onfocus="(this.type='date')" type="text" placeholder="End Date" name="end_date" style="width:150px;height:36px;">
			<input type="submit" name="submit_date" value="Filter">
			</form>
        </div>
        <div class="inner">
            <form action="#" id="viewTimesheetForm" method="post" >        
               <table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:15%;">Date</th>
							<th  style="width:15%">Status</th>
                            <th  style="width:15%;">Start Time</th>
							<th  style="width:15%;">End Time</th>
					        <th  style="width:15%;">Hours of shift</th>							
					   </tr>
						<?php while($row2 = mysqli_fetch_array($schedule_result)): ?>
						<tr>
						   <td><?php if($row2['schedule_date'] === $today){
						                echo "Today";  
										}else
										{
											echo $row2['schedule_date'];
										}
						      
							  ?></td>
						   <td><input type="text" class="btn btn-primary"  readonly  value="<?php echo $row2['work_status']; ?>"></td>
						   <td><?php echo $row2['start_time']; ?></td>
		                   <td><?php echo $row2['end_time']; ?></td>
		                   <td><?php $hour = round(($row2['end_time']-$row2['start_time']));
                                     echo $hour." Hours";						   ?></td>
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
         <hr>
       </div>
   </div>
   <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>

