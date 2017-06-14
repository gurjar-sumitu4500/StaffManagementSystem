<DOCTYPE! html>
<html>
<head>
      <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width,  initial-scale=1">
      <title>Login</title>
      <link rel="Stylesheet" href="CSS/index.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style>
	 body{
		 background-color: #00ff80;
	 }
      .current{
		 background-color: #ff4000;
	 }
	 </style>
	  
</head>
<body >
<header>
   <nav>
      <ul>
	     <li ><a href="register.php">Register</a></li>
		 <li class="current"><a href="login.php">Log-In</a></li>
		 <li><a href="#">Contact</a></li>
		 <li><a href="#">About Us</a></li>
		 <li><a href="Index.php">Home</a></li>
	  </ul>
   </nav>
  <content>
   <div id="header" style="margin-left:300px;margin-top:20px;">
     <div  id="userpanel" class="panel col-sm-9 panel-primary">
	   <div class="panel-heading">User Sign In</div>
       <div class="container panel-body">
       <form method="POST" action="userlogin.php" >
	     <div class="form-group row">
           <label class="col-sm-2 col-form-label">Identification Number</label>
             <div class="col-sm-5">
              <input type="number" required name="ID" class="form-control" placeholder="Enter your ID Number">
             </div>
         </div>
	     <div class="form-group row">
           <label class="col-sm-2 col-form-label">CompanyID</label>
             <div class="col-sm-5">
               <input type="Number" required name="Company_id" class="form-control"  placeholder="Enter your companyID">
            </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-5">
          <input type="password" required class="form-control" name="User_password" placeholder="Enter your password">
        </div>
       </div>
       <div class="form-group row">
         <div class="offset-sm-2 col-sm-10">
           <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
       </div>
     </form>
   </div>
   <div id="adminpanel" class="panel col-sm-13 panel-danger">
	  <div class="panel-heading">Admin Sign In</div>
      <div class="container panel-body">
        <form method="post" action="adminlogin.php">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Admin ID</label>
          <div class="col-sm-5">
            <input type="text"  required class="form-control" name="admin_id" placeholder="Enter your ID Number">
           </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
             <div class="col-sm-5">
               <input type="password" required class="form-control" name="apassword" placeholder="Enter your password">
             </div>
         </div>
	     <div class="form-group row">
           <div class="offset-sm-2 col-sm-10">
             <button type="submit" class="btn btn-primary">Sign in</button>
           </div>
         </div>
       </form>
     </div>
	</div>
  </div>
</div>
</content>
</header>
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