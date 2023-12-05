<?php

class PartnerControl extends Partner
{
    private $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    public function findPartners()
    {
        $this->fetchPartners($this->uid);
    }
}

?>