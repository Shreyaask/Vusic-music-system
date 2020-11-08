<?php session_start();
require("config.php");
if (isset($_SESSION["username"])) {
  $user = $_SESSION["username"];
}
?>
<!DOCTYPE html>
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

    .optionsMenu {
      position: fixed;
      background-color: #282828;
      width: 200px;
      border: 1px solid rgba(0, 0, 0, 0.15);
      border-radius: 3px;
      z-index: 1;
      display: none;
    }

    .optionsMenu .item {
      width: 100%;
      padding: 12px 20px;
      box-sizing: border-box;
      font-weight: 400;
      color: rgba(147, 147, 147, 0.8);
      cursor: pointer;
      height: 40px;
      background-color: #282828;
      font-size: 14px;
    }

    .optionsMenu .item:hover {
      color: #fff;
      background-color: #333;
      border-color: #333;
    }

    .optionsButton {
      margin-bottom: 20px;

    }

    .optionsMenu select {
      border: none;
      -webkit-appearance: none;
      -moz-appearance: none;
    }

    .trackOptions {
      width: 5%;
      float: right;
      text-align: right;
    }

    .trackOptions img {
      width: 15px;
      visibility: hidden;
    }

    .trackOptions img {
      visibility: visible;
    }
  </style>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- Script for adding playlist dropdown button starts-->
  <script>
    function hideOptionsMenu() {
      var menu = $(".optionsMenu");
      if (menu.css("display") != "none") {
        menu.css("display", "none");
      }
    }

    function showOptionsMenu(button) {
      var songId = $(button).prevAll(".songId").val();
      var menu = $(".optionsMenu");
      var menuWidth = menu.width();
      menu.find(".songId").val(songId);
      menu.css({
        "top": 20 + "px",
        "left": 60 + "px",
        "display": "inline"
      });

    }
    $(document).click(function(click) {
      var target = $(click.target);

      if (!target.hasClass("item") && !target.hasClass("optionsButton")) {
        hideOptionsMenu();
      }
    });

    $(window).scroll(function() {
      hideOptionsMenu();
    });
  </script>
  <!-- Script for adding playlist dropdown button ends-->
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
            <a href="registration.php" class="gmail">Register</i></a>';
    }

    ?>


  </div>
  <br><br><br><br>
  <!--image adding using php -->
  <?php
  $a = "select * from songs";
  $result = mysqli_query($con, $a);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while ($row = mysqli_fetch_assoc($result)) {
  ?>
      <div class="image-cls">
        <span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $row['id'] ?>'">
          <img class="image" src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;position:relative;z-index:-10;">
          </span>
          <div class="pl-list">
            <div class='trackOptions'>
              <input type='hidden' class='songId' value='<?php ?>'>
              <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
            </div>
            <nav class="optionsMenu">
              <input type="hidden" class="songId">
              <?php
              $dropdown = '<select class="item playlist">
              <option value="">Add to playlist</option>';
              if (isset($_SESSION["username"])) {
                $query_new = mysqli_query($con, "SELECT id, listname FROM playlist WHERE username='$user'");
                while ($row_new = mysqli_fetch_assoc($query_new)) {
                  $id = $row_new['id'];
                  $name = $row_new['listname'];

                  $dropdown = $dropdown . "<option value='" . $id . "'>" . $name . "</option>";
                }
              }
              $dropdown .= "</select>";
              echo $dropdown;
              ?>
            </nav>
          </div>
      </div>
  <?php
    }
  } ?>
  </script>
</body>

</html>