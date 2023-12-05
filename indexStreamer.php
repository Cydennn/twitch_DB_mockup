<?php
session_start();
if (!isset($_SESSION["type"]) || $_SESSION["type"] != "streamer") {
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
    <div class="streamer-menu">
        <div>
            <!-- query a new "stream" -->
            <h1>Streamer menu</h1>
            <form action="stream.inc.php" method="post" class="login-form">
                <h2>Title</h2>
                <input type="text" name="title" placeholder="title">
                <h2>URL</h2>
                <input type="text" name="url" placeholder="url">
                <h2>Genre</h2>
                <input type="text" name="genre" placeholder="genre(s)">
                <h2>Sponsorships</h2>
                <!-- Crude implementation of sponsorships list, NYI -->
                <?php

                $db = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
                $stmt = $db->prepare("SELECT brands.name AS bname, sponsorships.name AS sname FROM brands, offer, sponsorships WHERE brands.brandID = offer.brandID AND offer.sponsorshipID = sponsorships.sponsorshipID;");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows) > 0) {
                    foreach ($rows as $row) {
                        echo '
                <div class="sponsor-preview">
                    <div>
                        <div>
                            ' . $row["sname"] . '
                        </div>
                        <div>
                            By ' . $row["bname"] . '
                        </div>
                    </div>
                    <div>
                    <input type="checkbox" name="' . $row["sname"] . '">
                    </div>
                </div>';
                    }
                } else {
                    echo "No sponsorship available";
                }
                ?>
                <button style="margin-top: 10px;" type="submit" name="submitVideo">Stream</button>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>