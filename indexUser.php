<?php
//session_start();
include("header.php");
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
        <a href="" class="display-video">
            <img class="thumbnail" src="./images/video1.png" alt="">
            <div class="display-video-title">
                4 CHINESES CAN'T WIN
            </div>
            <div class="display-video-desc">
                <div>Posted by: T1 Faker</div>
                <div>10 views</div>
            </div>
        </a>
        <a href="" class="display-video">
            <img class="thumbnail" src="./images/video1.png" alt="">
            <div class="display-video-title">
                4 CHINESES CAN'T WIN
            </div>
            <div class="display-video-desc">
                <div>Posted by: T1 Faker</div>
                <div>10 views</div>
            </div>
        </a>
        <a href="" class="display-video">
            <img class="thumbnail" src="./images/video1.png" alt="">
            <div class="display-video-title">
                4 CHINESES CAN'T WIN
            </div>
            <div class="display-video-desc">
                <div>Posted by: T1 Faker</div>
                <div>10 views</div>
            </div>
        </a>
    </div>
    <div class="display-video-wrapper">
        <a href="" class="display-video">
            <img class="thumbnail" src="./images/video1.png" alt="">
            <div class="display-video-title">
                4 CHINESES CAN'T WIN
            </div>
            <div class="display-video-desc">
                <div>Posted by: T1 Faker</div>
                <div>10 views</div>
            </div>
        </a>
        <a href="" class="display-video">
            <img class="thumbnail" src="./images/video1.png" alt="">
            <div class="display-video-title">
                4 CHINESES CAN'T WIN
            </div>
            <div class="display-video-desc">
                <div>Posted by: T1 Faker</div>
                <div>10 views</div>
            </div>
        </a>
        <a href="" class="display-video">
            <img class="thumbnail" src="./images/video1.png" alt="">
            <div class="display-video-title">
                4 CHINESES CAN'T WIN
            </div>
            <div class="display-video-desc">
                <div>Posted by: T1 Faker</div>
                <div>10 views</div>
            </div>
        </a>
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