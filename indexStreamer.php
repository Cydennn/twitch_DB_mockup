<?php
session_start();
include("header.php");

if ($_SESSION["type"] !== "streamer")
    header("location: index.php");
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
<div class="streamer-menu">
    <!-- query a new "stream" -->
    <h1 style="width: 100%; text-align: center; margin-bottom: 0px;">Streamer menu</h1>
    <form action="watch.php" method="post" class="login-form">
        <h2>Title</h2>
        <input type="text" class="text-input" name="title" placeholder="title">
        <h2>Genre</h2>
        <select class="text-input" name="genre">
            <option value="action">Action</option>
            <option value="sandbox">Sandbox</option>
            <option value="adventure">Adventure</option>
        </select>
        <!-- Crude implementation of sponsorships list, NYI -->

        <div class="sponsor-wrapper">

            <?php
            $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
            $stmt = $conn->prepare(
                "SELECT sponsorships.sponsorshipID AS sID,
                sponsorships.name AS sName,
                description,
                minimum_time_req AS time,
                minimum_views_req AS views
            FROM brands, offer, sponsorships
            WHERE brands.BrandID = offer.BrandID AND offer.sponsorshipID = sponsorships.sponsorshipID"
            );
            $stmt->execute();
            $sponsors = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($sponsors as $sponsor) {
                echo '
                <div class="sponsor-container">
                    <div class="sponsor-name">' . $sponsor["sName"] . '</div>
                    <div style="margin-left: 10px; margin-right: 10px; text-align: justify;">
                        <div class="mb-small">' . $sponsor["description"] . '</div>
                        <div class="">Minimum stream time: ' . $sponsor["time"] . ' mins</div>
                        <div class="">Minimum views: ' . $sponsor["views"] . ' views</div>
                        <div style="display:flex; align-items: center; justify-content: center;">
                            <input type="checkbox" class="checkbox-streamer" name="sID[]" value="' . $sponsor["sID"] . '">
                            <label>Choose Sponsorship</label>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>

        </div>
        <div style="display: flex; justify-content: center; margin-bottom: 30px;">
            <button style="width: 40%;" class="login-button" type="submit" name="submitVideo">Start Streaming</button>
        </div>
    </form>
</div>

<!-- DELETED PHP PART (REUSE IF NEEDED)
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
-->

<?php
include("footer.php");
?>