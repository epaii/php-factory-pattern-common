<?php
namespace epii\factory\pattern;

interface IDriverCommon{
    public function init($config);
    public function require_configs();
}
