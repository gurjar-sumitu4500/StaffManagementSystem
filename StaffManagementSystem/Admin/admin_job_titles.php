<?php
  
  include '../controller/connection.php';
  session_start();
  
  
  if(isset($_POST['search'])){
	  
	  $searchbyname = $_POST['SearchByName'];
	  $query = "SELECT * FROM job_title WHERE Job_title LIKE '%".$searchbyname."%' AND company_id=".$_SESSION['company_id']."";
	  $search_result = filterTable($query);
   }
   else{
	   $query = "SELECT * FROM job_title WHERE company_id=".$_SESSION['company_id']."";
	   $search_result = filterTable($query);
   }
   function filterTable($query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $query);
	   return $filter_Result;
   }
  if(isset($_POST['Add'])){
	  header("Location: adminhomepage_add_job_title.php");
  }
  
  if(isset($_POST['Delete'])){
	  header("Location: adminhomepage_delete_job_title.php");
  }
  
  

?>
<!DOCTYPE html>    
<html>
<head>
   <title>Job Titles</title>  
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
           <li class="current" ><a href="#" ><b>Employee</b></a>  
               <ul>
			      <li ><a href="adminhomepage.php">Employee List</a></li>
				  <li class="selected"><a href="admin_job_titles.php">Job Titles</a></li>
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
            <form action="admin_job_titles.php" method="post">
                 <ol>
                    <li>
                        <label style="color:black;padding-right:10px;">Job Title:</label> 
						<input type="text" name="SearchByName" style="width:200;height:30px;" placeholder="Job Title">
					</li>
                </ol>
                  <p>
                     <input  style="margin:10px 0px 0px 11px;width:80px;" class="btn-success" type="submit" name="search" value="Filter" />
                  </p>
            <form action="admin_job_titles.php" id="viewTimesheetForm" method="post" >        
                <button style="width:80px;font-size:15px;float:left;margin:10px;"  type="submit" name="Add"class="btn btn-success">ADD</button>
				<button style="width:80px;font-size:15px;float:left;margin:10px;" type="submit" name="Delete" class="btn btn-danger">DELETE</button>
				<table class="table-responsive table table striped table-bordered">
                    <thead>
                        <tr>
                            <th  style="width:20%">Job Title</th>
							<th  style="width:20%">Job Description</th>						
                        </tr>
						<?php while($row = mysqli_fetch_array($search_result)): ?>
						<tr>
		                   <td><?php echo $row['job_title']; ?></td>
		                   <td><?php echo $row['job_description']; ?></td>
						</tr>
						<?php endwhile; ?>
                    </thead>
                    <tbody>
                   </tbody>
			    </table>
            </form>
	  </form>
	</div>
   <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>

