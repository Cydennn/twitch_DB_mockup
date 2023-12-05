<?php
session_start();
include("header.php");
?>

<div class="wrapper">
    <div class="header">
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" <?php
            if ($_SESSION["type"] == "streamer") {
                echo 'href="indexStreamer.php"';
            } else {
                echo 'href="indexUser.php"';
            }
            ?>>MAIN</a>
        </div>
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="includes/logout.inc.php">LOGOUT</a>
        </div>
    </div>
    <div>
        <h1>Profile</h1>
        <h2>ID</h2>
        <p>
            <?php echo $_SESSION["type"] . '.' . $_SESSION["ID"] ?>
        </p>
        <h2>Username</h2>
        <p>
            <?php echo $_SESSION["uid"] ?>
        </p>
        <h2>Email</h2>
        <p>
            <?php echo $_SESSION["email"] ?>
        </p>

        <!-- Display streamer's partners -->
        <?php
        if ($_SESSION["type"] == "streamer") {
            echo "<h2>Followers</h2>";
            $profile = new PartnerControl($_SESSION["uid"]);
            $profile->findPartners();
        }
        ?>
    </div>
</div>

<?php
include("footer.php");
?>