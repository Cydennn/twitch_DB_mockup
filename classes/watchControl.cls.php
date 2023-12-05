<?php

class WatchControl extends Watch
{
    private $viewer;
    private $streamer;
    private $url;

    public function __construct($viewer, $streamer, $url)
    {
        $this->viewer = $viewer;
        $this->streamer = $streamer;
        $this->url = $url;
    }

    public function watchView()
    {
        $this->registerView($this->viewer, $this->streamer ,$this->url);
    }
}