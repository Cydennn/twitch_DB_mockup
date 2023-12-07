<?php

class Login extends Dbh
{
    protected function getUser($uid, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT `password` FROM users WHERE username = ? OR email = ?;");

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

        if ($pwd !== $loginData[0]["password"]) {
            $stmt = null;
            header("location: ../loginUser.php?error=wrongpassword");
            exit();
        }

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ? OR email = ? AND password = ?;");

        if (!$stmt->execute(array($uid, $uid, $pwd))) {
            $stmt = null;
            header("location: ../loginUser.php?error=stmtfailed");
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["ID"] = $user["userID"];
        $_SESSION["uid"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["type"] = "user";

        $stmt = null;
    }
    protected function getStreamer($uid, $pwd)
    {
        $stmt = $this->connect()->prepare("SELECT password FROM streamers WHERE username = ? OR email = ?;");

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

        if ($pwd !== $loginData[0]["password"]) {
            $stmt = null;
            header("location: ../loginStreamer.php?error=wrongpassword");
            exit();
        }

        $stmt = $this->connect()->prepare("SELECT * FROM streamers WHERE username = ? OR email = ? AND password = ?;");

        if (!$stmt->execute(array($uid, $uid, $pwd))) {
            $stmt = null;
            header("location: ../loginStreamer.php?error=stmtfailed");
            exit();
        }

        $streamer = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["ID"] = $streamer["streamerID"];
        $_SESSION["uid"] = $streamer["username"];
        $_SESSION["email"] = $streamer["email"];
        $_SESSION["type"] = "streamer";


        $stmt = null;
    }
}