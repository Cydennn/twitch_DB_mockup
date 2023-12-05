<?php

class Watch extends Dbh
{
    public function registerView($viewer, $streamer, $url)
    {
        // watch relationship
        $stmt = $this->connect()->prepare("SELECT userID FROM users WHERE username = ?;");
        $stmt->execute(array($viewer));
        $userID = $stmt->fetch(PDO::FETCH_ASSOC)["userID"];

        $stmt = $this->connect()->prepare("SELECT videoID FROM videos WHERE url = ?;");
        $stmt->execute(array($url));
        $videoID = $stmt->fetch(PDO::FETCH_ASSOC)["videoID"];

        $stmt = $this->connect()->prepare("INSERT INTO watch (userID, videoID) VALUES (?, ?);");
        $stmt->execute(array($userID, $videoID));

        // view count
        $stmt = $this->connect()->prepare("UPDATE videos SET peak_viewer = peak_viewer + 1 WHERE url = ?;");
        $stmt->execute(array($url));
    }
}