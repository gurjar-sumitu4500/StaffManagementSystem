<?php
  
  include '../controller/connection.php';
  session_start();
  
  $query = "SELECT * FROM job_title WHERE company_id=".$_SESSION['company_id']."";
  $query_result = $connection->query($query);
  
  if(isset($_POST['deletejobtitle'])){
	  $job_title = $_POST['job_title'];
	  $query = "DELETE  FROM job_title WHERE job_title='$job_title' AND company_id=".$_SESSION['company_id']."";
     if($connection->query($query) === TRUE){
		  echo '<script language="javascript">';
         echo 'alert("Job Title Deleted Successfully!")';
          echo '</script>';
		header("refresh:0.01;url=admin_job_titles.php"); 
	  }else{
		 echo("Error description: ".mysqli_error($connection));
	  }
  }

?>
<!DOCTYPE html>    
<html>
<head>
   <title>Add Job Title</title>  
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="../CSS/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/main.css" rel="stylesheet" type="text/css"/>    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
</head>
<body>
    <div id="upper">
	   <div id="Company">
          <a href="#" target="_blank"><img src="../SMS.png" style="margin:0px;" width="183" height="90" alt="SMS"/></a>
          <a href="#" id="welcome" class="panelTrigger">Welcome <?php echo $_SESSION['admin_name'];?> </a>      
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
           <h1>Delete Job Title</h1>
         </div>
         <div class="inner">
            <form action="adminhomepage_delete_job_title.php" style="width:700px;" method="post" class="form-horizontal">
			  <ol>
                    <li>  
					      <label style="margin-top:10px;" class="control-label">Job Title:</label>
                          <select required type="text"  placeholder="" name="job_title" style="height:35px;width:150px;margin-bottom:10px;">
				          <?php while($row = mysqli_fetch_array($query_result)): ?>
				          <option><?php echo $row['job_title']; ?></option>
					      <?php endwhile; ?>
				          </select>					     
						 <input type="submit" style="margin-top:15px;" name="deletejobtitle" value="Delete Title"></input> 
					</li>
                </ol>
                
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

