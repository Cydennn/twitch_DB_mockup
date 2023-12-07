<?php
session_start();
include("header.php");
?>

<!-- Display page content -->
<!-- Header -->
<div class="header">
    <div style="margin-left: 15px;">
        WELCOME,
        <?php echo (strtoupper($_SESSION["type"])) ?>
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
<div class="watch-wrapper">
    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <div class="recommended-title">Recommended</div>
        <!-- Reuse query from frontpage -->
        <?php
        $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
        $stmt = $conn->prepare(
            "SELECT username, title, url, thumbnail, peak_viewer 
            FROM streamers, stream, videos 
            WHERE streamers.streamerID = stream.streamerID AND stream.videoID = videos.videoID AND url <> ?;"
        );

        $stmt->execute(array($_GET["url"]));
        $recvideos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($recvideos) > 0) {
            foreach ($recvideos as $recvideo) {
                echo '
                    <a href="watch.php?url=' . $recvideo["url"] . '" class="recommended-wrapper">
                        <div style="margin-right: 10px;">
                            <img class="small-thumbnail" src="' . $recvideo["thumbnail"] . '" alt="">
                        </div>
                        <div class="thumbnail-info-wrapper">
                            <div class="thumbnail-title">' . $recvideo["title"] . '</div>
                            <div class="thumbnail-streamer">' . $recvideo["username"] . '</div>
                            <div class="thumbnail-viewers">' . $recvideo["peak_viewer"] . ' Viewers</div>
                        </div>
                    </a>
                ';
            }
        } else {
            echo "No one seems to be streaming for now...";
        }
        ?>
        
    </div>
    <!-- Video -->
    <div class="video-wrapper">
        <?php
        // users can only get here via clicking a link
        if (!isset($_GET["url"]))
            header("location: ../indexUser.php");

        // fetch video
        $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
        $stmt = $conn->prepare(
            "SELECT streamers.streamerID AS stID, username, profile_picture, title, url, thumbnail, peak_viewer 
            FROM streamers, stream, videos 
            WHERE streamers.streamerID = stream.streamerID AND stream.videoID = videos.videoID AND url = ?;"
        );

        $stmt->execute(array($_GET["url"]));
        $video = $stmt->fetch(PDO::FETCH_ASSOC);

        // fetch genres of said video
        $stmt = $conn->prepare(
            "SELECT name 
            FROM videos, has, genres 
            WHERE videos.videoID = has.videoID AND has.genreID = genres.genreID AND url = ?;"
        );

        $stmt->execute(array($_GET["url"]));
        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div>
            <video class="video-watch" controls>
                <source src="<?php echo $video["url"] ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="video-title">
            <?php echo $video["title"] ?>
        </div>
        <!-- genre -->
        <div class="video-info-genre-wrapper">
            <?php
            foreach ($genres as $genre)
                echo '
                    <div class="video-info-genre">' . $genre["name"] . '</div>
                ';
            ?>
        </div>
        <div class="video-info-wrapper">
            <div class="video-info-streamer-wrapper">
                <!-- profile pic -->
                <div>
                    <img class="profile-picture" src="<?php echo $video["profile_picture"] ?>" alt="">
                </div>
                <div>
                    <div class="video-info-streamer-name">
                        <?php echo $video["username"] ?>
                    </div>
                    <!-- Reuse follow & sub query from profile -->
                    <?php
                    // follow
                    $stmt = $conn->prepare(
                        "SELECT *
                        FROM users, follow, streamers 
                        WHERE streamers.streamerID = ? AND users.userID = follow.userID AND follow.streamerID = streamers.streamerID"
                    );

                    $stmt->execute(array($video["stID"]));
                    $followCount = count($stmt->fetchAll(PDO::FETCH_ASSOC));

                    // subscribe
                    $stmt = $conn->prepare(
                        "SELECT * 
                        FROM users, subscribe, streamers 
                        WHERE streamers.streamerID = ? AND users.userID = subscribe.userID AND subscribe.streamerID = streamers.streamerID"
                    );

                    $stmt->execute(array($video["stID"]));
                    $subCount = count($stmt->fetchAll(PDO::FETCH_ASSOC));
                    ?>
                    <div>
                        Followers:
                        <?php echo $followCount ?> | Subscribers:
                        <?php echo $subCount ?>
                    </div>
                </div>
            </div>
            <div class="follow-and-subscribe-wrapper">
                <div style="margin-bottom: 5px;">
                    <button class="follow-and-subscribe-button">Follow</button>
                    <button class="follow-and-subscribe-button">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Follow & Subscribe NYI -->

<?php
include("footer.php");
?>

<!-- 
    $watch = new VideoControl($_SESSION["uid"],$_GET["url"]);
    $watch->findVideo();
 -->