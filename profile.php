<?php
session_start();
require("config.php");
?>
<html>

<head>
  <title>Profile</title>
  <link rel="stylesheet" type="text/css" href="css/Prof.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/styleindex.css">
  <link rel="stylesheet" href="css/nav.css">

  <style>
    body {
      background-image: url("https://media.istockphoto.com/photos/snowflake-material-in-the-black-background-picture-id913260670?k=6&m=913260670&s=612x612&w=0&h=rcTpZRvWTgMxW2uc-EWLrfAp3TZFQmFl2ckdNuxdHTY=");
    }

    .gmail {
      background: green;
    }
  </style>
</head>
<title><?php echo $firstname; ?> <?php echo $lastname; ?>/'s Profile</title>
</head>

<body>
  <!--code for side bar-->

  <div class="navcolor">

    <a class="search" href="index.php">Home</a>
    <a class="images" href="search.php">Search</a>
    <a class="maps" href="playlist.php">Playlist</a>
    <a class="play" href="albums.php">Albums</a>
    <?php
    if (isset($_SESSION['username'])) {
      echo '<a href="logout.php" class="youtube" >Logout</a>
            <a href="profile.php" class="gmail">Profile</i></a>';
    } else {
      echo '<a href="login.php" class="youtube" >Login</a>
            <a href="registration.php" class="gmail">register</i></a>';
    }

    ?>

    </label>
    </ul>
  </div>


  <!--menu buttons ends-->
  <?php
  //Check form submission
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userquery = mysqli_query($con, "select * from user where username='$username';") or die("The query could not be completed.!! Please try again later!!");
    if (mysqli_num_rows($userquery) != 1) {
      die("That username could not be found!!");
    }
    while ($row = mysqli_fetch_assoc($userquery)) {
      $dbusername = $row['username'];
      $firstname = $row['firstname'];
      $lastname = $row['Lastname'];
      $email = $row['Email'];
    }
    if ($username != $dbusername) {
      die("There has been a fatal error: Please try again!!!");
    }

  ?>
    <div class="box">
      <h2 class="t1"><?php echo $firstname; ?> <?php echo $lastname; ?>'s Profile</h2><br>
      <table>
        <tr>
          <td style="color:white">Firstname:</td>
          <td style="color:white"><?php echo $firstname; ?></td>
        </tr>
        <tr>
          <td style="color:white">Lastname:</td>
          <td style="color:white"><?php echo $lastname; ?></td>
        </tr>
        <tr>
          <td style="color:white">Email:</td>
          <td style="color:white"><?php echo $email; ?></td>
        </tr>
        <tr>
          <td style="color:white">Username:</td>
          <td style="color:white"><?php echo $dbusername; ?></td>
        </tr>
    </div>
  <?php
  } else die("You need to specify a username.");
  ?>
</body>

</html>