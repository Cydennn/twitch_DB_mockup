<?php
session_start();
include("header.php");

if ($_SESSION["type"] !== "user")
    header("location: includes/logout.inc.php");
?>

<div class="header">
    <div style="margin-left: 15px;">
        WELCOME, USER
    </div>
    <div class="header-nav">
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="profile.php">PROFILE</a>
        </div>
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="includes/logout.inc.php">LOGOUT</a>
        </div>
    </div>
</div>
<div class="hero-index-user">
    <!-- Get all currently streaming videos -->
    <div class="display-video-wrapper">

        <?php
        $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
        $stmt = $conn->prepare(
            "SELECT username, title, url, thumbnail, peak_viewer 
            FROM streamers, stream, videos 
            WHERE streamers.streamerID = stream.streamerID AND stream.videoID = videos.videoID;"
        );

        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($videos) > 0) {
            foreach ($videos as $video) {
                echo '
            <a href="watch.php?url=' . $video["url"] . '" class="display-video">
            <img class="thumbnail" src="' . $video["thumbnail"] . '" alt="">
            <div class="display-video-title">
            ' . $video["title"] . '
            </div>
            <div class="display-video-desc">
                <div>Currently live on: ' . $video["username"] . '</div>
                <div>' . $video["peak_viewer"] . ' views</div>
            </div>
        </a>';
            }
        } else {
            echo "No one seems to be streaming for now...";
        }

        ?>
    </div>

</div>

<!-- DELETED PHP PART (REUSE IF NEEDED)
$db = new PDO("mysql:host=localhost;dbname=twitch", USERNAME, PASSWORD);
        $stmt = $db->prepare("SELECT * FROM streamers, stream, videos WHERE streamers.StreamerID = stream.StreamerID AND stream.VideoID = videos.VideoID");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo '
                <div class="video-preview">
                    <div class="info-bar">
                        <div>
                            <h2>' . $row["Title"] . '</h2>
                        </div>
                        <div>
                            ' . $row["Streamer_uid"] . '
                        </div>
                    </div>
                    <div class="watch-button">
                        <a href="indexStreamer.php?link=' . $row["Streamer_uid"] . '">
                        <button>Watch</button>
                        </a>
                    </div>
                </div>';
            }
        } else {
            echo "No one seems to be streaming for now...";
        }
-->

<?php
include("footer.php");
?>