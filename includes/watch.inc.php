<?php
include("../define.php");

if (!isset($_POST["submitVideo"]))
    header("location: ../indexStreamer.php");

// upload the file into the folder
if ($_FILES["file"]['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../videos/';
    $uploadFile = $uploadDir . basename($_FILES["file"]['name']);

    if (move_uploaded_file($_FILES["file"]['tmp_name'], $uploadFile)) {
        echo "File is valid, and was successfully uploaded and moved.\n";
    } else {
        echo "Possible file upload attack!\n";
    }
} else {
    echo "File upload failed with error code " . $_FILES['file']['error'] . "\n";
}

// create the video
$url = './videos/' . basename($_FILES["file"]['name']);
$thumbnail = '../images/placeholder.png';
$title = $_POST["title"];
$genre = $_POST["genre"];

$conn = new PDO("mysql:host=localhost;dbname=streamingplatform", USERNAME, PASSWORD);
$stmt = $conn->prepare(
    "INSERT INTO videos
    (title,
    url,
    thumbnail,
    peak_viewer,
    average_viewer,
    start_time,
    end_time)
    VALUES (?, ?, ?, ?, ?, ?, ?);"
);
$stmt->execute(
    array(
        $title,
        $url,
        $thumbnail,
        0,
        0,
        date('Y-m-d h:i:s'),
        DEFAULT_TIME
    )
);

// fetch the new video's ID
$videoID = $conn->lastInsertId();

// add sponsorships
foreach ($_POST["sID"] as $sID) {
    $stmt = $conn->prepare(
        "INSERT INTO include (videoID, sponsorshipID)
        VALUES (?, ?);"
    );
    $stmt->execute(array($videoID, $sID));
}

// stream
$stmt = $conn->prepare(
    "INSERT INTO stream (streamerID, videoID)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE videoID = videoID;"
);
$stmt->execute(array($_POST["streamerID"], $videoID));

header("location: ../watch.php?url=" . $url);