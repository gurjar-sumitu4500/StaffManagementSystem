<?php
  
  include '../controller/connection.php';
  session_start();
  $sess_company_id = $_SESSION['company_id'];
  
  
  if(isset($_POST['add_employee_button'])){
	  header("Location: adminhomepage_add.php");
  }elseif(isset($_POST['delete_employee'])){
      header("Location: adminhomepage_delete.php");	  
  }
  
  
  if(isset($_POST['search'])){
	  
	  $searchbyid = $_POST['SearchById'];
	  $query = "SELECT * FROM sms_employees WHERE employee_id LIKE '%".$searchbyid."%' AND company_id=$sess_company_id" ;
	  $search_result = filterTable($query);
   }
   else{
	   $query = "SELECT * FROM sms_employees WHERE company_id=$sess_company_id ";
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
   <title>Admin Homepage</title>  
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
           <h1>Search for Employee</h1>
         </div>
         <div class="inner">
            <form action="adminhomepage.php" method="post">
                 <ol>
                    <li>
                        <label style="color:black;padding-right:10px;">Employee ID:</label> 
						<input type="number" name="SearchById" style="width:200;height:30px;" placeholder="Employee ID">
					</li>
                </ol>
				<hr>
                  <p>
                     <input class="btn-success" type="submit" name="search" value="Filter" />
                  </p>
            </form>
        </div>
     </div>
     <div class="box ">
        <div class="head">
            <h1>List of Employee</h1>
        </div>
        <div class="inner">
            <form action="adminhomepage.php" id="viewTimesheetForm" method="post" >        
                <input type="submit" name="add_employee_button" style="width:80px;font-size:15px;float:left;margin:10px;"  value="ADD" class="btn btn-success">
				<input type="submit" name="delete_employee" style="width:100px;background-color:red;font-size:15px;float:left;margin:10px;" value="DELETE" class="btn btn-danger">
				<table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:20%">Identification</th>
                            <th  style="width:20%">First Name</th>
							<th  style="width:20%">Last Name</th>
                            <th  style="width:20%">Date of Birth</th>
							<th  style="width:20%">Job Title</th>
                            <th  style="width:20%">Employment Status</th>
							<th  style="width:20%">Supervisor</th>
                            <th  style="width:20%">Password</th>
                            <th  style="width:20%">Company ID</th>
                            							
                        </tr>
						<?php while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
						   <td><?php echo $row['employee_id']; ?></td>
		                   <td><?php echo $row['fname']; ?></td>
		                   <td><?php echo $row['lname']; ?></td>
		                   <td><?php echo $row['dob']; ?></td>
		                   <td><?php echo $row['job_title']; ?></td>
		                   <td><?php echo $row['employment_status']; ?></td>
		                   <td><?php echo $row['supervisor']; ?></td>
	  					  <td><?php echo $row['employee_password']; ?></td>
						  <td><?php echo $row['company_id']; ?></td>
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

