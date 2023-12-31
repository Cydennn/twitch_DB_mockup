<?php
include("../define.php");

if (isset($_POST["submitUser"])) {
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "../classes/Dbh.cls.php";
    include "../classes/login.cls.php";
    include "../classes/loginControl.cls.php";

    $login = new LoginControl($uid, $pwd);
    $login->loginUser();
    header("location: ../indexUser.php?error=none");
}
else if (isset($_POST["submitStreamer"])) {
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    include "../classes/Dbh.cls.php";
    include "../classes/login.cls.php";
    include "../classes/loginControl.cls.php";

    $login = new LoginControl($uid, $pwd);
    $login->loginStreamer();
    header("location: ../indexStreamer.php?error=none");
}
else {
    header("location: logout.inc.php");
}