<DOCTYPE! html>
<html>
<head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width,  initial-scale=1">
      <title>Register</title>
      <link rel="Stylesheet" href="CSS/index.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style>
	  body{
		  background-color:#00ff80;
	  }
      .current{
		 background-color: #ff4000;
	 }
	 </style>
</head>
<body>
<header>
   <nav>
      <ul>
	     <li class="current"><a href="register.php">Register</a></li>
		 <li><a href="login.php">Log-In</a></li>
		 <li><a href="#">Contact</a></li>
		 <li><a href="#">About Us</a></li>
		 <li><a href="index.php">Home</a></li>
	  </ul>
   </nav>
</header>
<content>
   <div id="header" style="margin-left:300px;margin-top:20px;">
     <div  id="userpanel" class="panel col-sm-9 panel-primary">
	   <div class="panel-heading">Register</div>
       <div class="container panel-body">
       <form method="POST" action="register-controller.php" >
	     <div class="form-group row">
           <label class="col-sm-2 col-form-label">Admin ID Number</label>
             <div class="col-sm-5">
              <input type="number" required name="ID" class="form-control" placeholder="Enter a ID Number">
             </div>
         </div>
	     <div class="form-group row">
           <label class="col-sm-2 col-form-label">Company Name</label>
             <div class="col-sm-5">
               <input type="text" required name="Company_name" class="form-control"  placeholder="Enter your Company Name">
            </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-5">
          <input type="password"  required class="form-control" name="admin_password" placeholder="Enter a password">
        </div>
       </div>
	     <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-5">
            <input type="text"  required class="form-control" name="admin_name" placeholder="Enter your Name">
           </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
             <div class="col-sm-5">
               <input type="email" required class="form-control" name="admin_email" placeholder="Enter your Email Address">
             </div>
         </div>
	     <div class="form-group row">
            <label class="col-sm-2 col-form-label">Contact Number</label>
              <div class="col-sm-5">
                 <input type="text" required  name="admin_contact" class="form-control"  placeholder="Enter your Contact Number">
              </div>
         </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">Gender</label>
              <div class="col-sm-5">
                 <select type="text" name="admin_gender" class="form-control"  placeholder="Choose your gender">
				 <option>Male</option>
				 <option>Female</option>
				 <option>Other</option>
				 </select>
              </div>
         </div>
		 <div class="form-group row">
            <label class="col-sm-2 col-form-label">Date Of Birth</label>
              <div class="col-sm-5">
                 <input type="date" required name="admin_dob" class="form-control"  placeholder="Choose Your date of Birth">
              </div>
         </div>
		 <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-5">
                 <input type="text"  required name="admin_address" class="form-control"  placeholder="Enter your Address">
              </div>
         </div>
		 <div class="form-group row">
           <div class="offset-sm-2 col-sm-10">
             <button type="submit" class="btn btn-primary">Register</button>
           </div>
         </div>
       </form>
     </div>
	</div>
  </div>
</content>
<footer style="margin-top:630px;">
   <ul>
      <li><a href="#">Terms and Conditions</a></li>
	  <li><a href="#">FAQs</a></li>
   </ul>
</footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>