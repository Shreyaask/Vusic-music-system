<?php
session_start();
require("config.php");
if (isset($_GET["s_id"]) && isset($_GET["list"])) {
    $id = $_GET["s_id"];
    $list = $_GET["list"];
    $query = "SELECT count(songorder) AS cnt FROM listsongs WHERE playlistid=$list";
    $queryrun = mysqli_query($con, $query) or die("Not able to select count");
    $row = mysqli_fetch_assoc($queryrun);
    $count = $row["cnt"] + 1;
    $check = mysqli_query($con, "SELECT * FROM listsongs WHERE songid='$id'");
    if (mysqli_num_rows($check) > 0) {
        header("location:search.php");
    } else {
        $newquery = "INSERT INTO listsongs VALUES(null,'$id','$list','$count')";
        $newqueryrun = mysqli_query($con, $newquery) or die("Not able to insert song");
        header("location:index.php");
    }
}
