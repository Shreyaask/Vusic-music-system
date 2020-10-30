<!--navigation bar -->
<style>
    .navcolor
         {
             background-color: black;
             width:100%;
             height:55px;
             position: absolute;
             top:0;
             left:0;
         }
         .search
         {
             color: white;
             position: absolute;
             left:10px;
             top:12px;
             font-size: 20px;
             text-decoration: none;
             
         }
         .images
         {
             color: white;
             position: absolute;
             left:70px;
             top:12px;
             font-size: 20px;
             text-decoration: none;
             
         }
         .maps
         {
             color: white;
             position: absolute;
             left:135px;
             top:12px;
             font-size: 20px;
             text-decoration: none;
             
         }
         .play
         {
             color:white;
             background:green;
             position: absolute;
             left:200px;
             top:12px;
             font-size: 20px;
             text-decoration: none;
             
         }
         .youtube
         {
             color: white;
             position: absolute;
             left:265px;
             top:12px;
             font-size: 20px;
             text-decoration: none;
             
         }
         .gmail
         {
             color: white;
             position: absolute;
             left:330px;
             top:12px;
             font-size: 20px;
             text-decoration: none;
             
         }
         
         
         .search:hover,.images:hover,.maps:hover,.play:hover,.youtube:hover,.gmail:hover
         {
            background-color:grey;
         }
</style>    
<div class="navcolor">

<a class="search" href="index.php">home</a>
<a class="images" href="search.php">search</a>
<a class="maps" href="#">playlist</a>
<a class="play" href="albums.php">albums</a>

<!--<a class="youtube" href="#">profile</a>
<a class="gmail" href="#">logout</a> --><?php
        if(isset($_SESSION['username'])){
            echo'<a href="logout.php" class="youtube" >Logout</a>
            <a href="profile.php" class="gmail">Profile</i></a>';
  
          }
          else{
            echo'<a href="logout.php" class="youtube" >Logout</a>
            <a href="profile.php" class="gmail">Profile</i></a>';
          }
  
           ?>
  

</div>
<br><br><br><br>
<style>
body {
background-image: url("https://media.istockphoto.com/photos/snowflake-material-in-the-black-background-picture-id913260670?k=6&m=913260670&s=612x612&w=0&h=rcTpZRvWTgMxW2uc-EWLrfAp3TZFQmFl2ckdNuxdHTY=");
}
</style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vusic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 
?>
<?php
if(isset($_GET["id"]))
{
    $idsaudio=$_GET["id"];
    
     $b="select * from songs where album='$idsaudio'";

$result = $conn->query($b);

if ($result->num_rows > 0) {
  // output data of each row

  while($row = mysqli_fetch_assoc($result)) {
    
   ?>
<span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $row['id']?>'">
 <img src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;">
  </span>
<?php
  }
} ?>
    
<?php  
  }


?>


