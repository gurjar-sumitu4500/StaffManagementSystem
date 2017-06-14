<?php
  
  include '../controller/connection.php';
  session_start();
  
  if(isset($_POST['addemployee'])){
	  $employee_fname = $_POST['addemployeefname'];
	  $employee_lname = $_POST['addemployeelname'];
	  $employee_dob = $_POST['addemployeedob'];
	  $employee_id = $_POST['addemployeeid'];
	  $employee_gender = $_POST['addemployeegender'];
	  $employee_job_title = $_POST['addemployeejobtitle'];
	  $employee_status = $_POST['addemployeestatus'];
	  $employee_supervisor = $_POST['addsupervisor'];
	  $employee_password = $_POST['password'];
	  $employee_email = $_POST['email'];
	  $employee_address = $_POST['address'];
	  $employee_contact = $_POST['contact'];
	  $query = "INSERT INTO sms_employees (contact_number ,Address, email, fname, lname, dob, gender, employee_password, job_title, employee_id, employment_status, supervisor, company_id)
	            VALUES('$employee_contact','$employee_address','$employee_email','$employee_fname','$employee_lname','$employee_dob','$employee_gender','$employee_password','$employee_job_title','$employee_id','$employee_status','$employee_supervisor',".$_SESSION['company_id'].")";
      $query2 = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']." AND employee_id=$employee_id ";
	  $check_result = mysqli_query($connection, $query2);
      $data = mysqli_num_rows($check_result);
      if($data > 0){
		  echo '<script language="javascript">';
          echo 'alert("Employee ID already Exists! Try again with another Another Employee ID.")';
          echo '</script>';
	      header("refresh:0.01;url= adminhomepage_add.php");
	  }else {
	 if($connection->query($query) === TRUE){
		 echo '<script language="javascript">';
         echo 'alert("New Employee added Successfully")';
          echo '</script>';
		header("refresh:0.01;url= adminhomepage.php"); 
	  }
	  else{
		   echo("Error description: ".mysqli_error($connection));
	   }
     }
  }
  $jobtitlequery = "SELECT * FROM job_title WHERE company_id=".$_SESSION['company_id']."";
  $resultjobtitles = filterTable($jobtitlequery);
  $employmentstatus_query ="SELECT * FROM employment_status ";
  $resultemploymentstatus = filterTable($employmentstatus_query);
   function filterTable($employmentstatus_query){
	   global $connection;
	   $filter_Result = mysqli_query($connection, $employmentstatus_query);
	   return $filter_Result;
   }


?>
<!DOCTYPE html>    
<html>
<head>
   <title>Add Employee</title>  
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
           <h1>Add Employee</h1>
         </div>
         <div class="inner">
		  <div class="container" style="width:900px;">
            <form action="adminhomepage_add.php" method="post"  class="form-horizontal">
                 <ol>
                    <li> <div class="form-group"> 
					      <div class="col-sm-6">
					      <label style="margin-top:10px;" class="control-label">First Name:</label>
					      <input type="text" style="margin-top:5px;" class="form-control" name="addemployeefname" placeholder="Enter First Name" required></input>
                         </div>
						 <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Last Name:</label>	                     
						  <input type="text" style="margin-top:5px;" class="form-control" name="addemployeelname" placeholder="Enter Last Name"></input>
                          </div>
						 </div>
						 <div class="form-group">
						  <div class="col-sm-6">	                     
						  <label style="margin-top:10px;" for = "gender">Gender</label>
                            <select style="margin-top:5px;" name="addemployeegender" class = "form-control" required>
                              <option>Male</option>
                              <option>Female</option>
                              <option>Other</option>
                            </select>
						 </div>
						  <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Date Of Birth:</label>	                     
						  <input type="date" style="margin-top:5px;" class="form-control" name="addemployeedob" placeholder="Enter date of birth" required></input>
                          </div>
						 </div>
						  <div class="form-group">
						  <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Password:</label>	                     
						  <input type="password" style="margin-top:5px;" class="form-control" name="password" placeholder="Enter new Password" required></input>
                          </div>
						  <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Email:</label>	                     
						  <input type="email" style="margin-top:5px;" class="form-control" name="email" placeholder="Enter Email id" required></input>
                          </div>
						 </div>
						 <div class="form-group">
						  <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Address:</label>	                     
						  <input type="text" style="margin-top:5px;" class="form-control" name="address" placeholder="Enter Employee address" required></input>
                          </div>
						  <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Contact Number:</label>	                     
						  <input type="text" style="margin-top:5px;" class="form-control" name="contact" placeholder="Enter Contact Number" required></input>
                          </div>
						 </div>
						<div class="form-group">
                         <div class="col-sm-6">						
						 <label style="margin-top:10px;" class="control-label">Job Title:</label>	                    
                         <select style="margin-top:5px;" class="form-control" name="addemployeejobtitle" required>
						  <?php while($row = mysqli_fetch_array($resultjobtitles)): ?>
						   <option ><?php echo $row['job_title']?></option>
						  <?php endwhile;?>
						 </select>
                        </div>
                        <div class="col-sm-6">
                           <label style="margin-top:10px;" class="control-label">Employee ID:</label>	                    
						  <input type="number" style="margin-top:5px;" class="form-control" name="addemployeeid" placeholder="Enter Employee Id" required></input>  						 
						 </div>
					   </div>
					   <div class="form-group">
					     <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Employment Status:</label>                       
                         <select style="margin-top:5px;" class="form-control" name="addemployeestatus" required>
						  <?php while($row = mysqli_fetch_array($resultemploymentstatus)): ?>
						   <option ><?php echo $row['employment_status']?></option>
						  <?php endwhile;?>
						 </select>
						 </div>
						 <div class="col-sm-6">
						  <label style="margin-top:10px;" class="control-label">Supervisor:</label>	                    
						  <input type="text" style="margin-top:5px;" class="form-control" name="addsupervisor" placeholder="Enter supervisor name" required></input>
	                     </div>
						  <input type="submit" style="margin-top:15px;" name="addemployee" value="ADD Employee"></input> 
					</li>
                </ol>
            </form>
		  </div>
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

