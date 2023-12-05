<?php
//session_start();
include("header.php");
?>

<div class="header">
    <div style="margin-left: 15px;">
        WELCOME, STREAMER
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
<div style="margin-left: 120px; margin-right: 120px;" >
    <div class="profile-wrapper">
        <div>
            <img class="profile-picture" src="./images/video1.png" alt="">
        </div>
        <div>
            <div style="font-size: 30px;" >Khuong</div>
            <div>Account creation date: 11-05-2003</div>
        </div>
    </div>
    <div class="content-wrapper" >
        <form action="">
            <div class="input-wrapper" >
                <p class="input-attribute" >Username</p>
                <input style="width: 80%;" class="text-input" type="text">
            </div>
            <div class="input-wrapper" >
                <p class="input-attribute" >Email</p>
                <input style="width: 80%;" class="text-input" type="text">
            </div>
            <div class="input-wrapper" >
                <p class="input-attribute" >Date of Birth</p>
                <input style="width: 80%;" class="text-input" type="text">
            </div>
            <div class="input-wrapper" >
                <p class="input-attribute" >Nationality</p>
                <input style="width: 80%;" class="text-input" type="text">
            </div>
            <div class="input-wrapper" >
                <p class="input-attribute" >Credit card number</p>
                <input style="width: 80%;" class="text-input" type="text">
            </div>
            <div style="display: flex; justify-content: center;" >
                <button style="width: 40%;" class="login-button" type="submit">Confirm change</button>
            </div>
        </form>
    </div>
    <!-- Enable this only when streamer is active -->
    <div class="content-wrapper">
        <div class="wrapper-title" >Statistics for Streamer</div>
        <div class="statistics-wrapper" >
            <div>Total subscribers: 10</div>
            <div>Total followers: 15</div>
            <div>Total donation earned: $20</div>
        </div>
    </div>
    <!-- Enable this only when streamer is active -->
    <div class="content-wrapper" >
        <div class="wrapper-title" >Donations received</div>
        <div class="donation-wrapper" >
            <p>In video STH, Kevin donated $5</p>
            <p>Donation message: "Keep up the good work"</p>
        </div>
        <div class="donation-wrapper" >
            <p>In video STH, Kevin donated $5</p>
            <p>Donation message: "Keep up the good work"</p>
        </div>
        <div class="donation-wrapper" >
            <p>In video STH, Kevin donated $5</p>
            <p>Donation message: "Keep up the good work"</p>
        </div>
        <div class="donation-wrapper" >
            <p>In video STH, Kevin donated $5</p>
            <p>Donation message: "Keep up the good work"</p>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>

<!-- (reuse if needed)
    if ($_SESSION["type"] == "streamer") {
        echo "<h2>Followers</h2>";
        $profile = new PartnerControl($_SESSION["uid"]);
        $profile->findPartners();
    }
-->