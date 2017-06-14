<?php
  
  include '../controller/connection.php';
  session_start();
  
  $sql_query_for_admin = "SELECT * FROM admin WHERE company_id=".$_SESSION['company_id']." ";
  $result_for_admin = $connection->query($sql_query_for_admin);
  $row_for_admin = mysqli_fetch_array($result_for_admin);
  $_SESSION['admin_id'] = $row_for_admin['admin_id']; 

  
   if(isset($_POST['send'])) {
	   $message = $_POST['message'];
	   $date = date("Y-m-d");
       $time = date('G:i:s');
       $send_query = "INSERT INTO `messages`(`sender_id`,`message`,`date`,`time`,`company_id`)
	                   VALUES(".$_SESSION['user_id'].",'$message','$date','$time',".$_SESSION['company_id'].")";
       $result = $connection->query($send_query);
     if(!$result){
		  echo("Error description: ".mysqli_error($connection));
	 }else{
		  header("refresh:0.01;url= employee_query.php");
	 } 
  } 
  
?>
<!DOCTYPE html>    
<html>
<head>
   <title>Query</title>  
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="../CSS/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/inbox.css" rel="stylesheet" type="text/css"/>
   <link href="../CSS/main.css" rel="stylesheet" type="text/css"/>        
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <style>
     
	 
   </style>
   
   
   </head>
<body>
    <div id="upper">
	   <div id="Company">
          <a href="#" target="_blank"><img src="../SMS.png" style="margin:0px;" width="183" height="90" alt="SMS"/></a>
          <a href="#" id="welcome" class="panelTrigger">Welcome <?php echo $_SESSION['user_name']; ?></a>      
       </div>      
       <div class="menu">
         <ul> 
           <li ><a href="Employeehomepage.php" ><b>Profile</b></a>			   
           </li> 		 
           <li><a href="employee_shifts.php" ><b>Shifts</b></a>                     
            </li>
		<li class="current"><a href="employee_query.php" ><b>Query</b></a>                     
            </li>
        <li><a href="employee_attendance.php"  ><b>Attendance</b></a>                       
        </li>
        <li><a href="employee_holidays.php"  ><b>Leave/Holidays</b></a>   
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
								<?php if($row['sender_id'] == $_SESSION['admin_id']){ ?><div class="chat friend">
								  <div class="user-photo">
								    <p >ADMIN
									</p>
								 </div>
								 <p class="chat-message"><?php echo $row['message']; ?>	
								 <span style="float:right;"><sub><?php echo $row['date']; ?><sub><?php echo $row['time'] ; ?></sub></sub></span>
								 </p>
							  </div>
								<?php }elseif($row['sender_id'] == $_SESSION['user_id']){ ?><div class="chat self">
								  <div class="user-photo">
								    <p >Me
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
						      <form action="employee_query.php" method="POST">
							  <textarea name="message" placeholder="Type your message"></textarea>
							  <button name="send" type="submit">Send</button>
						      </form>
						   </div>
						 </div>
                      </div>
              </div>
           </div>
<hr> 
 <div id="footer">
            Staff Management System<br/>
&copy; 2017 <a href="#" target="_blank">Staff Management System</a>. All rights reserved.
    </div>
</body> 
</html>

