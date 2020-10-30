<?php
   session_start();
   require("config.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" type="text/css" href="css/stylelog.css">
  <link rel="stylesheet" href="css/styles.css">
  
</head>
<body>
  <div class="header">
    <label>
    <ul class="menu">
      <a href="index.php">Home</a>
    </ul>
  </label>
</div>
<form class="box" action="login.php" method="post">
  <h1>Login</h1>
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <input type="submit" name="Login" value="Login">
  <a href="registration.php" class="register">Register</a>
</form>



 	 <div>
     <?php
                if(isset($_POST['Login']))
                {
                 $username = $_POST['username'];
                 $password = $_POST['password'];
                 $query="select * from user where username='$username'";
                 $query_run = mysqli_query($con,$query);

                 if(mysqli_num_rows($query_run)>0)
                 {
                   //valid
                   $row=mysqli_fetch_assoc($query_run);
                   if(password_verify($password,$row['password'])){


                   $_SESSION['username']=$username;
                   header('location:index.php');
                 }
                 }
                 else
                 {
                  echo '<script type="text/javascript"> alert("UserName and Password does not match") </script>';}
                }


           ?>
 	</div>

</body>
</html>
