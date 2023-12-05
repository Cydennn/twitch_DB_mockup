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
        <!-- Get all currently streaming videos -->
        <?php
        
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
        ?>
    </div>
</div>

<?php
include("footer.php");
?>