<!DOCTYPE html>
<?php session_start();
include("config.php");
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styleindex.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        function clicking() {
            var pl = prompt("Enter Playlist Name");
            $(document).ready(function() {
                createCookie("pl-list", pl, "1");
            });

            // Function to create the cookie 
            function createCookie(name, value, days) {
                var expires;

                expires = "";

                document.cookie = escape(name) + "=" +
                    escape(value) + expires + "; path=/";
                location.reload();
            }
        }
        var timer;
        var userLoggedIn="<?php echo $_SESSION['username'];  ?>";
    </script>
    <style>
        body {
            background-image: url("https://media.istockphoto.com/photos/snowflake-material-in-the-black-background-picture-id913260670?k=6&m=913260670&s=612x612&w=0&h=rcTpZRvWTgMxW2uc-EWLrfAp3TZFQmFl2ckdNuxdHTY=");
        }

        .maps {
            background: green;
        }
    </style>
</head>

<body>

    <!--code for nav bar-->
    <div class="navcolor">

        <a class="search" href="index.php">Home</a>
        <a class="images" href="search.php">Search</a>
        <a class="maps" href="playlist.php">Playlist</a>
        <a class="play" href="albums.php">Albums</a>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="logout.php" class="youtube" >Logout</a>
            <a href="profile.php" class="gmail">Profile</a>';
        } else {
            echo '<a href="login.php" class="youtube" >Login</a>
            <a href="registration.php" class="gmail">Register</a>';
        }

        ?>


    </div>
    <?php if (isset($_SESSION["username"])) { ?>
        <br><br><br>
        <button onclick="clicking()" class="myButton"> click here to add playlist</button>
        <?php
        if (isset($_COOKIE["pl-list"])) {
            $user = $_SESSION["username"];
            $plistname = $_COOKIE["pl-list"];
            $query = "select * from playlist where listname='$plistname'";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                echo "<script>alert('Playlist already created!!!.')</script>";
            } else {
                $q = "Insert into playlist(username,listname) values('$user','$plistname')";
                mysqli_query($con, $q) or die("Couldn't insert playlist name to database");
            }
            unset($_COOKIE['pl-list']);
            setcookie('pl-list', '', time() - 3600, '/');
        }
        $user = $_SESSION["username"];
        $playlistsQuery = mysqli_query($con, "SELECT * FROM playlist WHERE username='$user'");

        if (mysqli_num_rows($playlistsQuery) == 0) {
            echo "<span class='noResults'>You don't have any playlists yet.</span>";
        }

        while ($row = mysqli_fetch_assoc($playlistsQuery)) {

            echo "<div class='gridViewItem' role='link' tabindex='0' onclick='location.href=\"userplaylist.php?id=" . $row['id'] ."&userLoggedIn=".$user."\"'>

                    <div class='playlistImage'>
                        <img src='assets/images/icons/playlist.png'>
                    </div>
                    
                    <div class='gridViewInfo' style='color:hotpink;font-size:24px'><strong>" . $row['listname'] . "</strong></div>

                </div>";
        }
    } else {
        ?>
        <br>
        <p style="color:yellow ;font-size:24px;top:50px;left:50%;right:50%">You can create and view Playlist only if you are a registered user.</p>
    <?php
    }
    ?>
</body>

</html>