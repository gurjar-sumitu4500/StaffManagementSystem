<?php
  
  include '../controller/connection.php';
  session_start();
  
  if(isset($_POST['addjobtitle'])){
	  $job_title = $_POST['addjobtitlename'];
	  $description = $_POST['addjobdescription'];
	  $query = "INSERT INTO job_title (job_title, job_description, company_id)
	            VALUES('$job_title','$description',".$_SESSION['company_id'].")";
     global $connection;	 
	 if($connection->query($query) === TRUE){
		 echo '<script language="javascript">';
         echo 'alert("Job Title added Successfully!")';
          echo '</script>';
		header("refresh:0.01;url=admin_job_titles.php");  
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
        <li  ><a href="#"  ><b>Schedule</b></a>
            <ul>
                 <li><a href="admin_schedule_employee.php"  >Employee Timesheet</a>
                 </li>   
                 <li  ><a href="admin_employee_attendance.php" >Employee attendance</a>
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
       <div class="box">
         <div class="head">
           <h1>Add Job Title</h1>
         </div>
         <div class="inner">
            <form action="adminhomepage_add_job_title.php" style="width:700px;" method="post" class="form-horizontal">
			  <ol>
                    <li>  
					      <label style="margin-top:10px;" class="control-label">Job Title:</label>
					      <input type="text" style="margin-top:5px;" class="form-control" name="addjobtitlename" placeholder="Enter Job Title" required></input>
						  <label style="margin-top:10px;" class="control-label">Description:</label>	                     
						  <textarea  style="margin-top:5px;height:300px;width:500px;" class="form-control" name="addjobdescription" placeholder="Enter Job Description"></textarea>
                          <input type="submit" style="margin-top:15px;" name="addjobtitle" value="Create Job"></input> 
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

