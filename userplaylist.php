<?php
session_start();
include("config.php");
if (isset($_GET['id'])) {
    $playlistId = $_GET['id'];
} else {
    header("Location: index.php");
}

$user = $_GET['userLoggedIn'];
$query = "select * from playlist where id='$playlistId'";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) <= 0) {
    echo "<script>alert('Playlist not found!!!.')</script>";
} else {
    $row = mysqli_fetch_assoc($query_run);
    $query = mysqli_query($con, "SELECT songid FROM listsongs WHERE playlistid='$playlistId'");
    $no_of_rows = mysqli_num_rows($query);
?>
    <html>

    <head>
        <title>Vusic</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            function deletePlaylist(playlistId) {
                var prompt = confirm("Are you sure you want to delete this playlist?");

                if (prompt == true) {
                    $.ajax({type:'post',
                            url:'deletelist.php',
                            data:{
                                playlistId: playlistId
                            }})
                        .done(function(error) {

                            if (error != "") {
                                alert(error);
                                return;
                            }

                            //do something when ajax returns
                           location.href = "playlist.php";
                        });


                }
            }

            function removeFromPlaylist(button, playlistId) {
                var songId = $(button).prevAll(".songId").val();

                $.post("removesong.php", {
                        playlistId: playlistId,
                        songId: songId
                    })
                    .done(function(error) {

                        if (error != "") {
                            alert(error);
                            return;
                        }

                        //do something when ajax returns
                        openPage("playlist.php?id=" + playlistId);
                    });
            }
        </script>
    </head>

    <body>
        <div class="entityInfo">

            <div class="leftSection">
                <div class="playlistImage">
                    <img src="assets/images/icons/playlist.png">
                </div>
            </div>

            <div class="rightSection">
                <h2><?php echo $row['listname']; ?></h2>
                <p>By <?php echo $row['username']; ?></p>
                <p><?php echo $no_of_rows; ?> songs</p>
                <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>');">DELETE PLAYLIST</button>

            </div>

        </div>


        <div class="tracklistContainer">
            <ul class="tracklist">

                <?php

                while ($result = mysqli_fetch_assoc($query)) {

                    echo "<div class=\"image-cls\">
            <span role='link' tabindex='0' onclick=\"location.href='play.php?id=" . $result['id'] . "'\">
              <img class=\"image\" src=\"" . $result["album_cover"] . "\" style=\"height:150px;width:150px;\">
              <div class=\"pl-list\">
                <button class=\"pl\" onclick=\"addplay()\" value=\"Add to Playlist\">+</button>
              </div>
            </span>
          </div>";

                    $i = $i + 1;
                }

                ?>

                <script>
                    <?php
                    $query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");

                    $array = array();

                    while ($row = mysqli_fetch_array($query)) {
                        array_push($array, $row['songId']);
                    }
                    $songIdArray = $array;
                    ?>
                    var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                    tempPlaylist = JSON.parse(tempSongIds);
                </script>

            </ul>
        </div>

        <nav class="optionsMenu">
            <input type="hidden" class="songId">
            <?php
            $dropdown = '<select class="item playlist">
							<option value="">Add to playlist</option>';

            $query = mysqli_query($con, "SELECT id, listname FROM playlist WHERE username='$user'");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $name = $row['listname'];

                $dropdown = $dropdown . "<option value='$id'>$name</option>";
            }


            return $dropdown . "</select>";
            ?>
            <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>
        </nav>
    </body>
<?php
} ?>

    </html>