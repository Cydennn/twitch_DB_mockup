<?php

class ProfileControl extends Profile
{
    private $username;
    private $email;
    private $dob;
    private $nationality;
    private $credit_card_number;
    private $ID;

    public function __construct($username, $email, $dob, $nationality, $credit_card_number, $ID)
    {
        $this->username = $username;
        $this->email = $email;
        $this->dob = $dob;
        $this->nationality = $nationality;
        $this->credit_card_number = $credit_card_number;
        $this->ID = $ID;
    }
    public function updateUserProfile()
    {
        $this->userProfile(
            $this->username,
            $this->email,
            $this->dob,
            $this->nationality,
            $this->credit_card_number,
            $this->ID
        );
    }
    public function updateStreamerProfile()
    {
        $this->streamerProfile(
            $this->username,
            $this->email,
            $this->dob,
            $this->nationality,
            $this->credit_card_number,
            $this->ID
        );
    }
}