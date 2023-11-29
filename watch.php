<?php
session_start();
include("header.php");
?>

<!-- Display page content -->
<?php
$watch = new PartnerControl($_SESSION["uid"]);
$profile->findPartners();
?>

<div class="wrapper-video">
    <div class="video-container">
        <h2>
            <?php //echo $row["Title"]; ?>
        </h2>
        <iframe width="720" height="405" src="https://www.youtube.com/embed/tgbNymZ7vqY">
        </iframe>
        <div>
            <div style="text-align: right;">
                View:
                <?php //echo $row["peakViewer"]; ?>
            </div>
            <div>
                <div class="info-bar">
                    <div class="streamer-info">
                        <div>
                            <?php //echo $_GET["link"]; ?>
                        </div>
                        <div>Followers:
                            <?php //echo $row["Follower_Count"]; ?>
                        </div>
                        <div>Subscribers:
                            <?php //echo $row["Subscriber_Count"]; ?>
                        </div>
                    </div>
                    <div class="follow-button">
                        <form action="follow.inc.php">
                            <button type="submit" name="follow">FOLLOW</button>
                        </form>
                    </div>
                    <div class="subscribe-button">
                        <form action="subsribe.inc.php">
                            <button type="submit" name="subscribe">SUBSCRIBE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include("footer.php");
?>