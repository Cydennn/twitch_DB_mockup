<?php
session_start();
include("header.php");

if ($_SESSION["type"] !== "streamer")
    header("location: includes/logout.inc.php");

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

$stmt = $conn->prepare(
    "SELECT name
    FROM genres;"
);
$stmt->execute();
$genreslist = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <form action="includes/watch.inc.php" method="post" class="login-form" enctype="multipart/form-data">
        <h2>Title</h2>
        <input type="text" class="text-input" name="title" placeholder="title">
        <h2>Video</h2>
        <input type="file" name="file" accept="video/mp4">
        <h2>Genre</h2>
        <!-- genre list -->
        <select class="text-input" name="genre">
            <?php
            foreach ($genreslist as $genre) {
                echo '
                <option value="' . $genre["name"] . '">' . $genre["name"] . '</option>
                ';
            }
            ?>
        </select>
        <!-- sponsorships list -->

        <div class="sponsor-wrapper">
            <?php
            foreach ($sponsors as $sponsor) {
                echo '
                <div class="sponsor-container">
                    <div class="sponsor-name">' . $sponsor["sName"] . '</div>
                    <div style="margin-left: 10px; margin-right: 10px; text-align: justify;">
                        <div class="mb-small sponsor-description">' . $sponsor["description"] . '</div>
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
        <!-- streamerID -->
        <input type="hidden" name="streamerID" value="<?php echo $_SESSION["ID"] ?>">
        </div>
        <div style="display: flex; justify-content: center; margin-bottom: 30px;">
            <button style="width: 40%;" class="login-button" type="submit" name="submitVideo">Start Streaming</button>
        </div>
    </form>
</div>

<?php
include("footer.php");
?>