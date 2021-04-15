<?php
namespace epii\factory\pattern;
 
trait driverTrait{
    private $config = [];
    public function init($config)
    {
        $this->config = $config;
    }
}
