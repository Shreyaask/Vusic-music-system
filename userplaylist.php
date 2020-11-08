<?php
session_start();
require("config.php");
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
        <link rel="stylesheet" href="css/pl-list.css">
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/nav.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="index.js"></script>
        <script type="text/javascript">
            function deletePlaylist(playlistId) {
                var prompt = confirm("Are you sure you want to delete this playlist?");

                if (prompt == true) {
                    $.ajax({
                            type: 'post',
                            url: 'deletelist.php',
                            data: {
                                playlistId: playlistId
                            }
                        })
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
                    $songid = $result["songid"];
                    $newquery = mysqli_query($con, "SELECT album_cover FROM songs WHERE id='$songid'");
                    $album = mysqli_fetch_assoc($newquery); ?>
                    <div class="image-cls">
                        <span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $songid; ?>'">
                            <img class="image" src="<?php echo $album["album_cover"]; ?>" style="height:150px;width:150px;position:relative;z-index:-10;">
                        </span>
                        <div class="pl-list">
                            <div class='trackOptions'>
                                <input type='hidden' class='songId' value=''>
                                <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                            </div>
                            <nav class="optionsMenu">
                                <input type="hidden" class="songId">
                                <?php
                                $dropdown = '<select class="item playlist" onclick="addsonglist(' . $songid . ',this.value)">
                                            <option value="">Add to playlist</option>';
                                if (isset($_SESSION["username"])) {
                                    $query_new = mysqli_query($con, "SELECT id, listname FROM playlist WHERE username='$user'");
                                    while ($row_new = mysqli_fetch_assoc($query_new)) {
                                        $id_new = $row_new['id'];
                                        $name_new = $row_new['listname'];

                                        $dropdown = $dropdown . "<option value='" . $id_new . "'>" . $name_new . "</option>";
                                    }
                                }
                                $dropdown .= "</select>";
                                echo $dropdown;
                                ?>
                            </nav>
                        </div>
                    </div>

                   <!-- <script>
                        <?php
                        $querytest = mysqli_query($con, "SELECT songid FROM listsongs WHERE playlistid='$playlistId' ORDER BY songorder ASC");

                        $array = array();

                        while ($row_2 = mysqli_fetch_array($querytest)) {
                            array_push($array, $row_2['songid']);
                        }
                        $songIdArray = $array;
                        ?>
                        var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
                        tempPlaylist = JSON.parse(tempSongIds);
                    </script>-->

            </ul>
        </div>


        <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>

    </body>
<?php
                }
            } ?>

    </html>