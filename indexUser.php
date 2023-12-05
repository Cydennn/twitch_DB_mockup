<?php
session_start();
if (!isset($_SESSION["type"]) || $_SESSION["type"] != "user") {
    header("location: ../index.php");
}
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
        <!-- Streamer's uid is relayed through $_GET on "Watch" click -->
        <?php

        $db = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
        $stmt = $db->prepare("SELECT * FROM streamers, stream, videos WHERE streamers.streamerID = stream.streamerID AND stream.videoID = videos.videoID;");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo '
                <div class="video-preview">
                    <div>
                        <div>
                            <h2>' . $row["title"] . '</h2>
                        </div>
                        <div class="info-bar">
                            <div display="inline-block">
                                By ' . $row["username"] . '
                            </div>
                            <form action="includes/watch.inc.php" method="get">
                                <div class="watch-button">                                
                                    <input type="hidden" name="viewer" value="' . $_SESSION["uid"] . '">
                                    <input type="hidden" name="streamer" value="' . $row["username"] . '">
                                    <input type="hidden" name="url" value="' . $row["url"] . '">
                                    <button type="submit" name="submitWatch">Watch</button>
                                    </a>
                                </div>
                            </form>
                        </div>
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