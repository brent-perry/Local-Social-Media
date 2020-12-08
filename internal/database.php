<?php

$dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".DB_CHARSET."";

$options =
[
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false
];

try{
    
    $pdo = new PDO($dsn,DB_USERNAME,DB_PASSWORD,$options);

} catch (\PDOException $e) {

    echo $e->getMessage();
}


?>
