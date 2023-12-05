<?php

class Login extends Dbh
{
    protected function getUser($uid, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT User_pwd FROM users WHERE User_uid = ? OR User_email = ?;");

        if (!$stmt->execute(array($uid, $uid))) {
            $stmt = null;
            header("location: ../loginUser.php?error=stmtfailed");
            exit();
        }

        $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($loginData) == 0) {
            $stmt = null;
            header("location: ../loginUser.php?error=usernotfound");
            exit();
        }

        if ($pwd !== $loginData[0]["User_pwd"]) {
            $stmt = null;
            header("location: ../loginUser.php?error=wrongpassword");
            exit();
        }

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE User_uid = ? OR User_email = ? AND User_pwd = ?;");

        if (!$stmt->execute(array($uid, $uid, $pwd))) {
            $stmt = null;
            header("location: ../loginUser.php?error=stmtfailed");
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["ID"] = $user["UserID"];
        $_SESSION["uid"] = $user["User_uid"];
        $_SESSION["email"] = $user["User_email"];
        $_SESSION["type"] = "user";

        $stmt = null;
    }
    protected function getStreamer($uid, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT Streamer_pwd FROM streamers WHERE Streamer_uid = ? OR Streamer_email = ?;");

        if (!$stmt->execute(array($uid, $uid))) {
            $stmt = null;
            header("location: ../loginStreamer.php?error=stmtfailed");
            exit();
        }

        $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($loginData) == 0) {
            $stmt = null;
            header("location: ../loginStreamer.php?error=usernotfound");
            exit();
        }

        if ($pwd !== $loginData[0]["Streamer_pwd"]) {
            $stmt = null;
            header("location: ../loginStreamer.php?error=wrongpassword");
            exit();
        }

        $stmt = $this->connect()->prepare("SELECT * FROM streamers WHERE Streamer_uid = ? OR Streamer_email = ? AND Streamer_pwd = ?;");

        if (!$stmt->execute(array($uid, $uid, $pwd))) {
            $stmt = null;
            header("location: ../loginStreamer.php?error=stmtfailed");
            exit();
        }

        $streamer = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["ID"] = $streamer["StreamerID"];
        $_SESSION["uid"] = $streamer["Streamer_uid"];
        $_SESSION["email"] = $streamer["Streamer_email"];
        $_SESSION["type"] = "streamer";


        $stmt = null;
    }
}

?>