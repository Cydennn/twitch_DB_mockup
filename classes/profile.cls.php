<?php

class Profile extends Dbh
{
    public function userProfile($username, $email, $dob, $nationality, $credit_card_number, $ID)
    {
        $stmt = $this->connect()->prepare(
            "UPDATE users
             SET username = ?, email = ?, dob = ?, nationality = ?, credit_card_number = ? 
             WHERE userID = ?;"
        );
        $stmt->execute(array($username, $email, $dob, $nationality, $credit_card_number, $ID));
    }
    public function streamerProfile($username, $email, $dob, $nationality, $credit_card_number, $ID)
    {
        $stmt = $this->connect()->prepare(
            "UPDATE streamers
             SET username = ?, email = ?, dob = ?, nationality = ?, credit_card_number = ? 
             WHERE streamerID = ?;"
        );
        $stmt->execute(array($username, $email, $dob, $nationality, $credit_card_number, $ID));
    }
}