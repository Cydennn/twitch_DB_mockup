<?php
//session_start();
include("header.php");
?>

<!-- Display page content -->
<!-- Header -->
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
<div class="watch-wrapper">
    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <div class="recommended-title" >Recommended</div>
        <a href="" class="recommended-wrapper">
            <div>Streamer</div>
            <div>10</div>
        </a>
        <a href="" class="recommended-wrapper">
            <div>Streamer</div>
            <div>10</div>
        </a>
        <a href="" class="recommended-wrapper">
            <div>Streamer</div>
            <div>10</div>
        </a>
        <a href="" class="recommended-wrapper">
            <div>Streamer</div>
            <div>10</div>
        </a>
        <a href="" class="recommended-wrapper">
            <div>Streamer</div>
            <div>10</div>
        </a>
    </div>
    <!-- Video -->
    <div class="video-wrapper">
        <div>
            <video class="video-watch" controls>
                <source src="./videos/video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="video-info-wrapper" >
            <div class="video-info-streamer-wrapper" >
                <!-- profile pic -->
                <div>
                    <img class="profile-picture" src="./images/video1.png" alt="">
                </div>
                <div>
                    <div class="video-info-streamer-name" >Streamer</div>
                    <!-- genre -->
                    <div class="video-info-genre-wrapper" >
                        <div class="video-info-genre" >Action</div>
                        <div class="video-info-genre" >Sandbox</div>
                        <div class="video-info-genre" >Role-playing</div>
                    </div>
                </div>
            </div>
            <div class="follow-and-subscribe-wrapper" >
                <div style="margin-bottom: 5px;" >
                    <button class="follow-and-subscribe-button" >Follow</button>
                    <button class="follow-and-subscribe-button" >Subscribe</button>
                </div>
                <div>
                    Followers: 5 | Subscribers: 8
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