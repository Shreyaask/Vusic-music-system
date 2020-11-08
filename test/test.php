<?php
session_start();
require("config.php");
$user = $_SESSION['username'];
echo $user;
?>
<html>

<head>
    <style>
        .optionsMenu {
            position: fixed;
            background-color: #282828;
            width: 200px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 3px;
            z-index: 1000;
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

        .optionsMenu select {
            border: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        body {
            background: black;
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

            var scrollTop = $(window).scrollTop(); //Distance from top of window to top of document
            var elementOffset = $(button).offset().top; //Distance from top of document

            var top = elementOffset - scrollTop;
            var left = $(button).position().left;

            menu.css({
                "top": top + "px",
                "left": left - menuWidth + "px",
                "display": "inline"
            });

        }
    </script>
     <!-- Script for adding playlist dropdown button ends-->
</head>

<body>
    <div class='trackOptions'>
        <input type='hidden' class='songId' value='<?php ?>'>
        <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
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
        echo $dropdown;
        ?>
        <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>
    </nav>
</body>

</html>