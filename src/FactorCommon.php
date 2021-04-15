<?php
namespace epii\factory\pattern;

class FactorCommon{

    private static $driver_class = null;
    private static $driver_config = null;
    private static $driver = null;
  
    private static $is_init = false;
 
    public static function init($driver_class_name, $config = array())
    {
        self::$driver_class = $driver_class_name;
        self::$driver_config = $config;
        self::$is_init = true;
        self::$driver = null;
    }
    public static function isInit()
    {
        return self::$is_init;
    }
    public static function getDriver()
    {
        if (self::$driver_class == null) {
            exit("Lock need set Driver");
        }
        if (self::$driver == null) {
            self::$driver = new self::$driver_class();
            if (self::$driver instanceof IDriverCommon) {
                $rconfig = self::$driver->require_configs();
                if ($rconfig) {
                    foreach ($rconfig as $value) {
                        if (!isset(self::$driver_config[$value])) {
                            exit(self::$driver_class . "need config key " . $value);
                        }
                    }
                }
                self::$driver->init(self::$driver_config);
            } else {
                exit("driver need instanceof IDriverCommon");
            }
        }
        return self::$driver;
    }

}
