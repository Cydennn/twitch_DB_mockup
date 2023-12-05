<?php

class LoginControl extends Login
{
    private $uid;
    private $pwd;

    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {
        if ($this->emptyInput()) {
            header("location: ../loginUser.php?error=emptyinput");
            exit();
        }
        $this->getUser($this->uid, $this->pwd);
    }
    public function loginStreamer()
    {
        if ($this->emptyInput()) {
            header("location: ../loginStreamer.php?error=emptyinput");
            exit();
        }
        $this->getStreamer($this->uid, $this->pwd);
    }
    private function emptyInput()
    {
        $res = false;
        if (empty($this->uid) || empty($this->pwd)) {

            $res = true;
        }
        return $res;
    }
}

?>