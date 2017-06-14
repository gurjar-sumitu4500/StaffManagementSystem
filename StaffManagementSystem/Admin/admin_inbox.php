<?php
  
  include '../controller/connection.php';
  session_start();
  
  if(isset($_POST['send'])) {
	   $message = $_POST['message'];
	   $date = date("Y-m-d");
       $time = date('G:i:s');
       $send_query = "INSERT INTO `messages`(`sender_id`,`message`,`date`,`time`,`company_id`)
	                   VALUES(".$_SESSION['id'].",'$message','$date','$time',".$_SESSION['company_id'].")";
       $result = $connection->query($send_query);
     if(!$result){
		  echo("Error description: ".mysqli_error($connection));
	 }else{
		  header("refresh:0.01;url= admin_inbox.php");
	 } 
  } 
  
  
?>
<!DOCTYPE html>    
<html>
<head>
   <title>Inbox</title>  
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="../CSS/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/inbox.css" rel="stylesheet" type="text/css"/>
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
         <li class="current" ><a href="admin_inbox.php" ><b>Query</b></a>
             </li>  
		  <li><a href="#" ><b>About</b></a>                        
          </li> 
          <li><a href="../logout.php" ><b>Logout</b></a>                        
          </li>  
       </ul> 
	 </div>
     <div id="content">                  
        <div class="inbox-body">
                          <div class="chatbox">
						  <div style="background:black;color:white;padding:10px;" ><h4>Query</h4></div>
						    <div class="chatlogs">
							    <?php
								   $sql = "SELECT * FROM messages WHERE company_id=".$_SESSION['company_id']." ORDER BY DATE(date) ASC, TIME(time) ASC";
								   $result = $connection->query($sql);
								   if(!$result){
								   echo("Error description: ".mysqli_error($connection));}
								   while($row = mysqli_fetch_array($result)){
								?>
								<?php if($row['sender_id'] == $_SESSION['id']){ ?><div class="chat friend">
								  <div class="user-photo">
								    <p >ME
									</p>
								 </div>
								 <p class="chat-message"><?php echo $row['message']; ?>	
								 <span style="float:right;"><sub><?php echo $row['date']; ?><sub><?php echo $row['time'] ; ?></sub></sub></span>
								 </p>
							  </div>
								<?php }else{ ?>
								
								<div class="chat self">
							   <div style="width:100px;" class="user-photo">
							   <p><?php $name_of_sender = "SELECT * FROM sms_employees WHERE company_id=".$_SESSION['company_id']." AND employee_id=".$row['sender_id']." ";
							            $result_of_sender = $connection->query($name_of_sender);
										$row2 = mysqli_fetch_array($result_of_sender);
                                       	echo $row2['fname']." ".$row2['lname'];								
							   ?></p>
							   </div>
							   <p class="chat-message"><?php echo $row['message']; ?>
							   <span style="float:right;"><sub><?php echo $row['date']; ?><sub><?php echo $row['time'] ; ?></sub></sub></span>
								</p>
							 </div>
							 <?php } ?> 
						     <?php } ?>
						   </div>
						   <div class="chat-form">
						      <form action="admin_inbox.php" method="POST">
							  <textarea name="message" placeholder="Type your message"></textarea>
							  <button name="send" type="submit">Send</button>
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

