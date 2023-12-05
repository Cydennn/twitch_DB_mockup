<?php

class Dbh {
    protected function connect() {
        try {
            $username = "root";
            $password = "79NrgJPadD6UV6";
            $dbh = new PDO("mysql:host=localhost;dbname=twitch", $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}

?>