<?php
include("../define.php");

if ($_POST["func"] == "insert") {
    $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
    if ($_POST["type"] == "fol") {
        $stmt = $conn->prepare(
            "INSERT INTO follow (userID, start_date, streamerID)
            VALUE (?, ?, ?);"
        );
        $stmt->execute(array($_POST["user"], date("Y-m-d"), $_POST["streamer"]));
        echo "Unfollow";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO subscribe (userID, start_date, streamerID)
            VALUE (?, ?, ?);"
        );
        $stmt->execute(array($_POST["user"], date("Y-m-d"), $_POST["streamer"]));
        echo "Unsubscribe";
    }
} else if ($_POST["func"] == "delete") {
    $conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
    if ($_POST["type"] == "fol") {
        $stmt = $conn->prepare(
            "DELETE FROM follow 
            WHERE userID = ? AND streamerID = ?;"
        );
        $stmt->execute(array($_POST["user"], $_POST["streamer"]));
        echo "Follow";
    } else {
        $stmt = $conn->prepare(
            "DELETE FROM subscribe 
            WHERE userID = ? AND streamerID = ?;"
        );
        $stmt->execute(array($_POST["user"], $_POST["streamer"]));
        echo "Subscribe";
    }
} else
    header("location: ../indexUser.php");