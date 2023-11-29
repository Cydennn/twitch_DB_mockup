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
    <div class="streamer-menu">
        <div>
            <h1>Streamer menu</h1>
            <form action="stream.php" method="post" class="login-form">
                <h2>Title</h2>
                <input type="text" name="title" placeholder="title">
                <h2>URL</h2>
                <input type="text" name="url" placeholder="url">
                <h2>Genre</h2>
                <input type="text" name="genre" placeholder="genre(s)">
                <button style="margin-top: 10px;" type="submit" name="submitVideo">Stream</button>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>