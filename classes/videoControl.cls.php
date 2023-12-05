<?php

class VideoControl extends Video
{
    private $uid;
    private $url;

    public function __construct($uid, $url)
    {
        $this->uid = $uid;
        $this->url = $url;
    }

    public function findVideo()
    {
        $this->fetchVideo($this->uid, $this->url);
    }
}
?>