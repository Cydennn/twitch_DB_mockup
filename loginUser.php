<?php
include("header.php");
?>
<script>document.title = "Viewer Login"</script>
<div class="wrapper">
    <div class="login-box">
        <div>
            <h1>Viewer Login</h1>
            <form action="includes/login.inc.php" method="post" class="login-form">
                <input type="text" name="uid" placeholder="username/email">
                <input type="password" name="pwd" placeholder="password">
                <button style="margin-top: 10px;" type="submit" name="submitUser">Login</button>
            </form>
        </div>
        <div style="margin-top: 10px;">
            <a href="loginStreamer.php">
                Login as streamer instead?
            </a>
        </div>
        <div>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Error: empty field(s).</p>";
                } else if ($_GET["error"] == "usernotfound") {
                    echo "<p>Error: user not found.</p>";
                } else if ($_GET["error"] == "stmt failed") {
                    echo "<p>Error: Something went wrong, please try again.</p>";
                } else if ($_GET["error"] == "wrongpassword") {
                    echo "<p>Error: wrong password.</p>";
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>