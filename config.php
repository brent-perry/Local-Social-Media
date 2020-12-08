<?Php


//PDO CONFIGURATION

define("DB_HOST", "127.0.0.1");
define("DB_PORT", "8889");
define("DB_HOSTPORT", "127.0.0.1:8889");


define("DB_NAME", "pbj");
define("DB_CHARSET", "utf8mb4");

define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");


//TIME ZONE
date_default_timezone_set('America/Los_Angeles');


//MAX POST LENGTH
define("POST_MAX", "255");


//PASSWORD HASH COST

define("HASH_COST","10");
