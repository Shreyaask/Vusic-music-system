<!DOCTYPE html>
<?php session_start();
require("config.php");
?>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styleindex.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/table.css">

  <style>
    body {
      background-image: url("https://media.istockphoto.com/photos/snowflake-material-in-the-black-background-picture-id913260670?k=6&m=913260670&s=612x612&w=0&h=rcTpZRvWTgMxW2uc-EWLrfAp3TZFQmFl2ckdNuxdHTY=");
    }

    .search {
      background: green;
    }
  </style>
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


  </div>
  <br><br><br><br>
  <!--image adding using php -->
  <?php


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "vusic";

  // Create connection
  $con = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  $a = "select * from songs";
  $result = $con->query($a);
  if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {


  ?>
      <div class="image-cls">
        <span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $row['id'] ?>'">
          <img class="image" src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;">
          <div class="pl-list">
            <button class="pl" onclick="addplay()" value="Add to Playlist">+</button>
          </div>
        </span>
      </div>
  <?php
    }
  } ?>
  <script type="text/javascript">
    function addplay() {

    }
  </script>
</body>

</html>