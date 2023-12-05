<?php

class Video extends Dbh
{
    public function fetchVideo($uid, $url)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM streamers, stream, videos WHERE streamers.username = ? AND videos.url = ? AND streamers.streamerID = stream.streamerID AND stream.videoID = videos.videoID;");
        $stmt->execute(array($uid,$url));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row) > 0) {
            echo '
                <div class="wrapper-video">
                    <div class="video-container">
                        <h2>' . $row["title"] . '</h2>
                        <iframe width="720" height="405" src="' . $row["url"] . '">
                        </iframe>
                        <div>
                            <div style="text-align: right;">
                                Views: ' . $row["peak_viewer"] . '
                            </div>
                            <div>
                                <div class="info-bar">
                                    <div class="streamer-info">
                                        <div>' . $_GET["streamer"] . '</div>
                                    </div>
                                    <div class="follow-button">
                                        <form action="follow.inc.php?">
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