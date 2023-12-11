<?php

use function PHPSTORM_META\type;

session_start();
include("header.php");

if (!isset($_SESSION["type"]))
    header("location: includes/logout.inc.php");

// users can only get here via clicking a link
if (!isset($_GET["url"]))
    header("location: indexUser.php");

if (isset($_GET["error"]) && $_GET["error"] == "sponsor") {
    echo '<script type="text/javascript">alert("Some expired sponsorships were omitted.");</script>';
}

$conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);

// side bar
$stmt = $conn->prepare(
    "SELECT username, title, url, thumbnail, peak_viewer 
    FROM streamers, stream, videos 
    WHERE streamers.streamerID = stream.streamerID AND stream.videoID = videos.videoID AND url <> ?;"
);

$stmt->execute(array($_GET["url"]));
$recvideos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// fetch video
$stmt = $conn->prepare(
    "SELECT streamers.streamerID, username, profile_picture, title, url, thumbnail, peak_viewer, videos.videoID 
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

// When user loads, query insert "watch" and "periods"
if ($_SESSION["type"] == "user") {
    // watch
    $stmt = $conn->prepare(
        "INSERT INTO watch (userID, videoID)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE videoID = videoID;"
    );
    $stmt->execute(array($_SESSION["ID"], $video["videoID"]));
    // periods
    $stmt = $conn->prepare(
        "INSERT INTO periods (userID, videoID, start_time, end_time)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE videoID = videoID;"
    );
    $stmt->execute(array($_SESSION["ID"], $video["videoID"], date('Y-m-d h:i:s'), DEFAULT_TIME));
}

// follow count
$stmt = $conn->prepare(
    "SELECT *
    FROM users, follow, streamers 
    WHERE streamers.streamerID = ? AND users.userID = follow.userID AND follow.streamerID = streamers.streamerID"
);

$stmt->execute(array($video["streamerID"]));
$followCount = count($stmt->fetchAll(PDO::FETCH_ASSOC));

// subscribe count
$stmt = $conn->prepare(
    "SELECT * 
    FROM users, subscribe, streamers 
    WHERE streamers.streamerID = ? AND users.userID = subscribe.userID AND subscribe.streamerID = streamers.streamerID"
);

$stmt->execute(array($video["streamerID"]));
$subCount = count($stmt->fetchAll(PDO::FETCH_ASSOC));

// Load the initial state of the 2 buttons on page load
$followValue = $subscribeValue = "0";
$followText = "Follow";
$subscribeText = "Subscribe";

// follow
$stmt = $conn->prepare(
    "SELECT *
    FROM follow
    WHERE streamerID = ? AND userID = ?"
);
$stmt->execute(array($video["streamerID"], $_SESSION["ID"]));
if (count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0) {
    $followValue = "1";
    $followText = "Unfollow";
}

// subscribe
$stmt = $conn->prepare(
    "SELECT *
    FROM subscribe
    WHERE streamerID = ? AND userID = ?"
);
$stmt->execute(array($video["streamerID"], $_SESSION["ID"]));
if (count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0) {
    $subscribeValue = "1";
    $subscribeText = "Unsubscribe";
}

?>

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
            <a style="color: inherit;text-decoration: none;" href="<?php
            if ($_SESSION["type"] == "streamer") {
                echo 'indexStreamer.php';
            } else {
                echo 'indexUser.php';
            }
            ?>">MAIN</a>
        </div>
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="includes/logout.inc.php">LOGOUT</a>
        </div>
    </div>
</div>
<div class="watch-wrapper">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar-wrapper">
        <div class="recommended-title">Recommended</div>
        <?php
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
            echo "No one else seems to be streaming for now...";
        }
        ?>

    </div>
    <!-- Display page content -->
    <!-- Video -->
    <div class="video-wrapper">
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
                    <div>
                        Followers:
                        <?php echo $followCount ?> | Subscribers:
                        <?php echo $subCount ?>
                    </div>
                </div>
            </div>
            <div class="follow-and-subscribe-wrapper">
                <div style="margin-bottom: 5px;">
                    <!-- Check if current user is follow/subscribing -->
                    <?php

                    ?>

                    <button id="toggle-follow" class="follow-and-subscribe-button" value="<?php echo $followValue ?>">
                        <?php echo $followText ?>
                    </button>
                    <button id="toggle-subscribe" class="follow-and-subscribe-button"
                        value="<?php echo $subscribeValue ?>">
                        <?php echo $subscribeText ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var sID = <?php echo $video["streamerID"] ?>;
        var vUrl = '<?php echo $video["url"] ?>';
        var vID = <?php echo $video["videoID"] ?>;
        // only used when user is viewer
        var uID = <?php echo $_SESSION["ID"] ?>;
        var userType = "<?php echo $_SESSION["type"] ?>";

        // follow & subscribe
        var fol = $("#toggle-follow");
        var sub = $("#toggle-subscribe");
        var sidebar = $("#sidebar");

        // hide UIs not for streamer
        if (userType == "streamer") {
            sidebar.hide();
            fol.hide();
            sub.hide();
        }

        // When user leaves, query update "periods" end time
        // When streamer leaves, query update "videos" end time
        $(window).bind('beforeunload', function () {
            $.ajax({
                type: "POST",
                url: "includes/unwatch.inc.php",
                data: { type: userType, url: vUrl, streamer: sID, user: uID, video: vID },
                async: false
            });
        });

        // toggle them
        fol.click(function () {
            if (fol.val() == "0") {
                fol.val("1");
                fol.load("includes/follow.inc.php", { type: "fol", func: "insert", streamer: sID, user: uID });
            } else {
                fol.val("0");
                fol.load("includes/follow.inc.php", { type: "fol", func: "delete", streamer: sID, user: uID });
            }

        });

        sub.click(function () {
            if (sub.val() == "0") {
                sub.val("1");
                sub.load("includes/follow.inc.php", { type: "sub", func: "insert", streamer: sID, user: uID });
            } else {
                sub.val("0");
                sub.load("includes/follow.inc.php", { type: "sub", func: "delete", streamer: sID, user: uID });
            }
        });
    });
</script>

<?php
include("footer.php");
?>