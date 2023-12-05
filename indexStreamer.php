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
            <!-- query a new "stream" -->
            <h1>Streamer menu</h1>
            <form action="stream.inc.php" method="post" class="login-form">
                <h2>Title</h2>
                <input type="text" name="title" placeholder="title">
                <h2>URL</h2>
                <input type="text" name="url" placeholder="url">
                <h2>Genre</h2>
                <input type="text" name="genre" placeholder="genre(s)">
                <!-- Crude implementation of sponsorships list, NYI -->
                <?php

                $db = new PDO("mysql:host=localhost;dbname=twitch", USERNAME, PASSWORD);
                $stmt = $db->prepare("SELECT * FROM brands, offer, sponsorships WHERE brands.BrandID = offer.BrandID AND offer.SponsorshipsID = sponsorships.SponsorshipsID");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows) > 0) {
                    foreach ($rows as $row) {
                        echo '
                <div class="sponsor-preview">
                    <div class="info-bar">
                        <div>
                            <h2>' . $row["Sponsorship_Name"] . '</h2>
                        </div>
                        <div>
                            ' . $row["Brand_Name"] . '
                        </div>
                    </div>
                    <div>
                    <input type="checkbox" name="' . $row["Sponsorship_Name"] . '">
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