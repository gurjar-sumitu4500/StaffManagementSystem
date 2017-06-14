<?php
  
  include '../controller/connection.php';
  session_start();
  
  
  
	   $query = "SELECT * FROM leaves WHERE company_id=".$_SESSION['company_id']." AND Status='Pending'";
	   $search_result = filterTable($query);
	   
   function filterTable($query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $query);
	   return $filter_Result;
   }
   
  
  

?>
<!DOCTYPE html>    
<html>
<head>
   <title>Leave Requests</title>  
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
           <li><a href="#" ><b>Admin</b></a>
              <ul>    
     			<li><a href="admin_profile.php" >Profile</a>
                </li>   
                </ul>                     
            </li>
        <li ><a href="#"  ><b>Schedule</b></a>
            <ul>
                 <li ><a href="admin_schedule_employee.php">Employee Timesheet</a>
                 </li>   
                 <li><a href="admin_employee_attendance.php" >Employee attendance</a>
                 </li>      
            </ul>                        
        </li>
        <li class="current" ><a href="#"  ><b>Leave</b></a>
            <ul>
               <li class="selected" ><a href="admin_leave_requests.php"  >Leave Requests</a>
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
            <h1>Leave Requests</h1>
        </div>
        <div class="inner">
            <form action="admin_leave_requests.php" id="viewTimesheetForm" method="post" >        
                <table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:10%">Employee ID</th>
                            <th  style="width:10%">Name</th>
							<th  style="width:10%">Date of leave</th>
                            <th  style="width:10%">Date of leave application</th>
							<th  style="width:10%">Time of leave application</th>
                            <th  style="width:10%">Reason for Leave</th>
							<th  style="width:20%">Description</th>	
                            <th  style="width:20%"></th>							
                        </tr>
						<?php while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
						  <?php  $id = $row['employee_id'];
  						         $date = $row['date_of_leave'];
						  ?>
						   <td><?php echo $row['employee_id']; ?></td>
		                   <td><?php $query2 = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']." AND employee_id=".$row['employee_id']." "; 
						             $result_query2 = $connection->query($query2);
									if(!$row2 = mysqli_fetch_array($result_query2)){
										echo("Error description: ".mysqli_error($connection));
									}
                                      echo $row2['fname']." ".$row2['lname'] ;  						   
						   ?>
						   </td>
		                   <td><?php echo $row['date_of_leave']; ?></td>
		                   <td><?php echo $row['date_of_apply']; ?></td>
		                   <td><?php echo $row['time_of_apply']; ?></td>
		                   <td><?php echo $row['leave_type']; ?></td>
		                   <td><?php echo $row['description']; ?></td>
						   <td><?php 
						       if(isset($_POST['Accept'.$id])){
							     	$Accept = "UPDATE leaves SET Status='Accepted' WHERE employee_id=$id AND date_of_leave='$date' AND company_id=".$_SESSION['company_id']."";
									$accept_result = $connection->query($Accept);
									$Accept2 = "UPDATE employee_schedule SET work_status='Leave' WHERE schedule_date='$date' AND employee_id=$id  AND company_id=".$_SESSION['company_id']."";
									$accept2_result = $connection->query($Accept2);
									if($accept2_result== False){
										echo("Error description: ".mysqli_error($connection));
									}else{
										 echo '<script language="javascript">';
                                         echo 'alert("Leave accepted Successfully!")';
                                         echo '</script>';
		                                 header("refresh:0.01;url= admin_leave_requests.php"); 
	  
									}									
							   }
							   if(isset($_POST['Delete'.$id])){
							     	$Delete = "UPDATE leaves SET Status='Not Accepted' WHERE employee_id=$id AND date_of_leave='$date' AND company_id=".$_SESSION['company_id']."";
									$delete_result = $connection->query($Delete);
									$delete2 = "UPDATE employee_schedule SET work_status='Present' WHERE schedule_date='$date' AND employee_id=$id  AND company_id=".$_SESSION['company_id']."";
									$delete2_result = $connection->query($delete2);
									if($delete2_result== False){
										echo("Error description: ".mysqli_error($connection));
									}else{
										 echo '<script language="javascript">';
                                         echo 'alert("Employee Leave Rejected")';
                                         echo '</script>';
	                                   	header("refresh:0.01;url= admin_leave_requests.php"); 
	  
									}
                               }
							   ?>
						       <input class="btn" style="margin:top:5px;" name="<?php echo "Accept".$id ; ?>" value="Accept" type="submit" >
							   <input style="background-color:red;margin-right:10px;" name="<?php echo "Delete".$id ; ?>" value="Reject" class="btn" type="submit"  >
							   </td>
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

