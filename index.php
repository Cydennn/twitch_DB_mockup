<?php
include("header.php");
?>
<div class="wrapper">
    <div class="login-box">
        <div class="login-header">Welcome, please login</div>
        <div class="divider"></div>
        <div class="button-wrapper mb-mid">
            <a href="loginUser.php">
                <button class="login-button">Login as viewer</button>
            </a>
        </div>
        <div class="button-wrapper mb-small">
            <a href="loginStreamer.php">
                <button class="login-button">Login as streamer</button>
            </a>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>