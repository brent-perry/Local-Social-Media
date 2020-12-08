<?php

class Log
{
private static $instance = null;

public static function get_instance()
    {
    if (is_null(self::$instance))
        self::$instance = new self();
        return self::$instance;
    }

    private function __construct(){}

    public function write($message)
    {
$handle = fopen('pbj.log','a');
    {
        fwrite($handle, date("Ymd-His T : ") . $message . "\n");
        fclose($handle);
    }
    }
}






