<?php
include("../define.php");

if (isset($_POST["submitProfile"])) {
    include "../classes/Dbh.cls.php";
    include "../classes/profile.cls.php";
    include "../classes/profileControl.cls.php";

    $username = $_POST["username"];
    $email = $_POST["email"];
    $dob = $_POST["dob"];
    $nationality = $_POST["nationality"];
    $credit_card_number = $_POST["credit_card_number"];
    $ID = $_POST["ID"];
    $type = $_POST["type"];

    $profile = new ProfileControl($username, $email, $dob, $nationality, $credit_card_number, $ID);
    if ($type == "user") {

        $profile->updateUserProfile();
    } else {
        $profile->updateStreamerProfile();
    }
    header("location: ../profile.php?error=none");
} else {
    header("location: logout.inc.php");
}