<?php

class Video extends Dbh
{
    public function fetchVideo($uid, $url)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM streamers, stream, videos WHERE streamers.StreamerID = ? AND videos.VideoURL = ? AND streamers.StreamerID = stream.StreamerID AND stream.VideoID = videos.VideoID");

        if (!$stmt->execute(array($uid,$url))) {
            $stmt = null;
            header("location: ../watch.php?error=stmtfailed");
            exit();
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row) > 0) {
            echo '
                <div class="wrapper-video">
                    <div class="video-container">
                        <h2>' . $row["Title"] . '</h2>
                        <iframe width="720" height="405" src="' . $row["URL"] . '">
                        </iframe>
                        <div>
                            <div style="text-align: right;">
                                Views: ' . $row["peakViewer"] . '
                            </div>
                            <div>
                                <div class="info-bar">
                                    <div class="streamer-info">
                                        <div>' . $_GET["link"] . '</div>
                                        <div>Followers: ' . $row["Follower_Count"] . '</div>
                                        <div>Subscribers: ' . $row["Subscriber_Count"] . '</div>
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
            ';
        }
    }
}