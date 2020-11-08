<!DOCTYPE html>
<?php
session_start();
require("config.php") ?>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styleindex.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url("https://media.istockphoto.com/photos/snowflake-material-in-the-black-background-picture-id913260670?k=6&m=913260670&s=612x612&w=0&h=rcTpZRvWTgMxW2uc-EWLrfAp3TZFQmFl2ckdNuxdHTY=");
        }

        .images {
            background: green;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/nav.css">
</head>

<body>
    <!--navigation bar -->
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
    <br><br><br>

    <!--code for search and upgrade-->
    <div class="Search-bar">
        <form action="search.php" method="post" id="search-page">
            <label for="searching">Search</label>
            <input type="text" placeholder="Type song title,artist or album you wantt....." id="transcript" name="search-p">
            <img onclick="startDictation()" name="voice-search-submit" src="//i.imgur.com/cHidSVu.gif" />
            <input type="submit" name="search-p-submit" value="Search">
        </form>
    </div>
    <script type="text/javascript">
        function startDictation() {

            if (window.hasOwnProperty('webkitSpeechRecognition')) {

                var recognition = new webkitSpeechRecognition();

                recognition.continuous = false;
                recognition.interimResults = false;

                recognition.lang = "en-US";
                recognition.start();

                recognition.onresult = function(e) {
                    document.getElementById('transcript').value = e.results[0][0].transcript;
                    recognition.stop();
                    <?php
                    ?>
                    document.getElementById('search-page').submit();
                };

                recognition.onerror = function(e) {
                    recognition.stop();
                }
            }

        }
    </script>
    <!--image adding using php -->
    <?php
        $name=$_POST['search-p'];
        $a = "select * from songs where title LIKE '%" . $name . "%' ";
        $result = $con->query($a);
        if ($result->num_rows > 0) {
            // output data of each row

            while ($row = $result->fetch_assoc()) {


    ?>

                <span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $row['id'] ?>'">
                    <img src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;">
                </span>
    <?php
            }
        }
    ?>


</body>

</html>