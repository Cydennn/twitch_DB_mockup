<?php
session_start();
include("header.php");
?>

<div class="wrapper">
    <div class="header">
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="profile.php">PROFILE</a>
        </div>
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="includes/logout.inc.php">LOGOUT</a>
        </div>
    </div>
    <div>
        <h1>Front page</h1>
        <?php
        // $conn = mysqli_connect("localhost", "root", "79NrgJPadD6UV6", "twitch");
        // $res = mysqli_query($conn, "SELECT * FROM streamers, stream, video WHERE streamers.StreamerID = stream.StreamerID AND stream.VideoID = video.VideoID");
        // if (mysqli_num_rows($res) > 0) {
        //     while ($row = mysqli_fetch_assoc($res)) {
        //         echo "<p>" . $row["Name"] . "</p>";
        //     }
        // } else {
        //     echo "none";
        // }
        ?>
    </div>
</div>

<?php
include("footer.php");
?>