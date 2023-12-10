<?php
include("../define.php");

if ($_POST["type"] == "streamer") {
    $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
    // update the value with placeholder end_time
    $stmt = $conn->prepare(
        "UPDATE videos
            SET end_time = ?
            WHERE videoID = ? AND end_time = ?;"
    );
    $stmt->execute(array(date('Y-m-d h:i:s'), $_POST["video"], DEFAULT_TIME));

} else if ($_POST["type"] == "user") {
    $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
    // update the value with placeholder end_time
    $stmt = $conn->prepare(
        "UPDATE periods
            SET end_time = ?
            WHERE userID = ? AND videoID = ? AND end_time = ?;"
    );
    $stmt->execute(array(date('Y-m-d h:i:s'), $_POST["user"], $_POST["video"], DEFAULT_TIME));
} else
    header("location: logout.inc.php");