<?php
  
  include '../controller/connection.php';
  session_start();
  
  
  if(isset($_POST['filter_employee_id'])){
	  $employee_id = $_POST['choose_employee_id'];
	  $query = "SELECT * FROM sms_employees WHERE employee_id='$employee_id' AND company_id=".$_SESSION['company_id']." ";
	  $queryresult = filterTable($query);
	  $row = mysqli_fetch_array($queryresult);
	  
	 
  }else{$row['employee_id']= "";
        $row['fname']= "";
		$row['lname']= "";
		$row['dob']= "";
		$row['job_title']= "";
		$row['employment_status']= "";
		}
		
   if(isset($_POST['delete_employee'])){
	  $employee_id = $_POST['choose_employee_id'];
	  $deletequery = "DELETE FROM sms_employees WHERE employee_id='$employee_id' AND company_id=".$_SESSION['company_id']." ";	 
	  $deletequery2 = "DELETE FROM leaves WHERE employee_id='$employee_id' AND company_id=".$_SESSION['company_id']." ";	 
	  $deletequery3 = "DELETE FROM employee_schedule WHERE employee_id='$employee_id' AND company_id=".$_SESSION['company_id']." ";	 
	  if(!$connection->query($deletequery)){
		 echo("Error description: ".mysqli_error($connection));
	  }
	  if(!$connection->query($deletequery2)){
		 echo("Error description: ".mysqli_error($connection));
	  }
	  if(!$connection->query($deletequery3)){
		 echo("Error description: ".mysqli_error($connection));
	  }
	   echo '<script language="javascript">';
         echo 'alert("Employee Deleted Successfully")';
          echo '</script>';
		header("refresh:0.01;url= adminhomepage.php"); 
    }
  $query = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']."";
  $result = filterTable($query);
    
  function filterTable($employmentstatus_query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $employmentstatus_query);
	   return $filter_Result;
   }


?>
<!DOCTYPE html>    
<html>
<head>
   <title>Delete Employee</title>  
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
           <li class="current" ><a href="#" ><b>Employee</b></a>  
               <ul>
			      <li class="selected" ><a href="adminhomepage.php">Employee List</a></li>
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
        <li  ><a href="#"  ><b>Leave</b></a>
            <ul>
               <li ><a href="admin_leave_requests.php"  >Leave Requests</a>
               </li>   
               <li ><a href="admin_approved_list.php" >Approved List</a>
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
       <div class="box">
         <div class="head">
           <h1>Delete Employee</h1>
         </div>
         <div class="inner">
            <form action="adminhomepage_delete.php" id="viewTimesheetForm" method="post" >        
                <div class="form-group">
				<div class="col-sm-8">
				<select required type="text"  placeholder="" name="choose_employee_id" style="height:35px;width:150px;margin-bottom:10px;">
				    <?php while($row2 = mysqli_fetch_array($result)): ?>
				    <option><?php echo $row2['employee_id']; ?></option>
					<?php endwhile; ?>
				</select>
				<input type="submit" name="filter_employee_id" style="margin-bottom:10px;margin-right:30px;" value="Filter">
				</div>
				</div>
				<table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:10%">Employee ID</th>
                            <th  style="width:10%">Name</th>
							<th  style="width:10%">DOB</th>
                            <th  style="width:10%">Job Title</th>
							<th  style="width:10%">Employment Status</th>							
                        </tr>
						<tr>
		                   <td><?php echo $row['employee_id']; ?></td>
		                   <td><?php echo $row['fname']." ".$row['lname']; ?></td>
		                   <td><?php echo $row['dob']; ?></td>
		                   <td><?php echo $row['job_title']; ?></td>
		                   <td><?php echo $row['employment_status']; ?></td>
						</tr>
                    </thead>
			    </table>
				<input type="submit"  style="background-color:red;float:right;margin-right:50px;" value="Delete" name="delete_employee">
            </form>
        </div>
     </div>
   </div>
   <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>

