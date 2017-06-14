<?php
  
  include '../controller/connection.php';
  session_start();
	   $tomorrow = date("Y-m-d", strtotime('tomorrow'));
	   
	   if(isset($_POST['filter_date'])){
		    $search_date = $_POST['search_date'];
		    $query = "SELECT * FROM leaves WHERE company_id=".$_SESSION['company_id']." AND Status='Accepted' AND date_of_leave='$search_date' ";
	        $search_result = filterTable($query);
			
		}else{
			$query = "SELECT * FROM leaves WHERE company_id=".$_SESSION['company_id']." AND Status='Accepted'";
	        $search_result = filterTable($query);
		}
	   
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
               <li ><a href="admin_leave_requests.php"  >Leave Requests</a>
               </li>   
               <li class="selected" ><a href="admin_approved_list.php" >Approved List</a>
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
            <h1>Approved Leaves List</h1>
        </div>
        <div class="inner">
            <form action="admin_approved_list.php" id="viewTimesheetForm" method="post" >        
                <div class="form-group">
				<div class="col-sm-8">
				<input type="text" onfocus="(this.type='date')"  placeholder="<?php echo $tomorrow;?>" name="search_date" value="" style="height:35px;width:150px;margin-bottom:10px;">
				<input type="submit" name="filter_date" style="margin-bottom:10px;margin-right:30px;" value="Filter Date">
				</div>
				</div>
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
                        </tr>
						<?php while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
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

