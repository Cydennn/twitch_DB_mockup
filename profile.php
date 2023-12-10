<?php
session_start();
include("header.php");

if (!isset($_SESSION["type"]))
    header("location: includes/logout.inc.php");
?>

<div class="header">
    <div style="margin-left: 15px;">
        WELCOME,
        <?php echo (strtoupper($_SESSION["type"])) ?>
    </div>
    <div class="header-nav">
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="<?php
            if ($_SESSION["type"] == "streamer") {
                echo 'indexStreamer.php';
            } else {
                echo 'indexUser.php';
            }
            ?>">MAIN</a>
        </div>
        <div class="header-items">
            <a style="color: inherit;text-decoration: none;" href="includes/logout.inc.php">LOGOUT</a>
        </div>
    </div>
</div>

<?php
$conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
$stmt;
$user;
if ($_SESSION['type'] == 'user') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE users.userID = ?;");
    $stmt->execute(array($_SESSION["ID"]));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare("SELECT * FROM streamers WHERE streamers.streamerID = ?;");
    $stmt->execute(array($_SESSION["ID"]));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div style="margin-left: 120px; margin-right: 120px;">
    <div class="profile-wrapper">
        <div>
            <img class="profile-picture" src="./images/placeholder.png" alt="">
        </div>
        <div>
            <div style="font-size: 30px;">
                <?php echo $user["username"] ?>
            </div>
            <div>Account creation date:
                <?php echo $user["account_create_date"] ?>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <form action="includes/profile.inc.php" method="post">
            <div class="input-wrapper">
                <p class="input-attribute">Username</p>
                <input style="width: 80%;" name="username" class="text-input" type="text"
                    value="<?php echo $user["username"] ?>">
            </div>
            <div class="input-wrapper">
                <p class="input-attribute">Email</p>
                <input style="width: 80%;" name="email" class="text-input" type="text"
                    value="<?php echo $user["email"] ?>">
            </div>
            <div class="input-wrapper">
                <p class="input-attribute">Date of Birth</p>
                <input style="width: 80%;" name="dob" class="text-input" type="text" value="<?php echo $user["dob"] ?>">
            </div>
            <div class="input-wrapper">
                <p class="input-attribute">Nationality</p>
                <input style="width: 80%;" name="nationality" class="text-input" type="text"
                    value="<?php echo $user["nationality"] ?>">
            </div>
            <div class="input-wrapper">
                <p class="input-attribute">Credit card number</p>
                <input style="width: 80%;" name="credit_card_number" class="text-input" type="text"
                    value="<?php echo $user["credit_card_number"] ?>">
            </div>

            <!-- Hidden inputs for query identification -->
            <input type="hidden" name="ID" value="<?php echo $_SESSION["ID"] ?>">
            <input type="hidden" name="type" value="<?php echo $_SESSION["type"] ?>">

            <div style="display: flex; justify-content: center;">
                <button style="width: 40%;" name="submitProfile" class="login-button" type="submit">Confirm
                    change</button>
            </div>
        </form>
        <div>
            <?php if (isset($_GET["error"]) && $_GET["error"] == "none")
                echo 'Profile updated successfully.'; ?>
        </div>
    </div>
    <!-- Enable this only when streamer is active -->

    <?php
    // follow
    $stmt = $conn->prepare(
        "SELECT * 
        FROM users, follow, streamers 
        WHERE streamers.streamerID = ? AND users.userID = follow.userID AND follow.streamerID = streamers.streamerID"
    );
    $stmt->execute(array($_SESSION["ID"]));
    $followCount = count($stmt->fetchAll(PDO::FETCH_ASSOC));

    // subscribe
    $stmt = $conn->prepare(
        "SELECT * 
        FROM users, subscribe, streamers 
        WHERE streamers.streamerID = ? AND users.userID = subscribe.userID AND subscribe.streamerID = streamers.streamerID"
    );
    $stmt->execute(array($_SESSION["ID"]));
    $subCount = count($stmt->fetchAll(PDO::FETCH_ASSOC));

    // donate
    $stmt = $conn->prepare(
        "SELECT users.username AS donateName, donation_amount, donation_message 
        FROM users, donate, streamers 
        WHERE streamers.streamerID = ? AND users.userID = donate.userID AND donate.streamerID = streamers.streamerID"
    );
    $stmt->execute(array($_SESSION["ID"]));
    $donate = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $donateSum = 0;
    foreach ($donate as $donater) {
        $donateSum = $donateSum + $donater["donation_amount"];
    }
    ?>

    <div id="streamer-stats">
        <div class="content-wrapper">
            <div class="wrapper-title">Statistics for Streamer</div>
            <div class="statistics-wrapper">
                <div>Total subscribers:
                    <?php echo $subCount ?>
                </div>
                <div>Total followers:
                    <?php echo $followCount ?>
                </div>
                <div>Total donation earned: $
                    <?php echo $donateSum ?>
                </div>
            </div>
        </div>
        <!-- Enable this only when streamer is active -->
        <div class="content-wrapper">
            <div class="wrapper-title">Donations received</div>
            <?php
            foreach ($donate as $donater) {
                echo '
                    <div class="donation-wrapper">
                        <p>' . $donater["donateName"] . ' donated $' . $donater["donation_amount"] . '</p>
                        <p>Donation message: "' . $donater["donation_message"] . '"</p>
                    </div>
                ';
            }
            ?>
        </div>
    </div>

    <script>
        var div = document.getElementById("streamer-stats");
        if ("<?php echo $_SESSION["type"] ?>" !== "streamer")
            div.style.display = "none";
    </script>
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