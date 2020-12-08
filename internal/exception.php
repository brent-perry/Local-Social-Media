<?php

function exception_handler($exception)
{
echo "Uncaught exception: ".$exception->getMessage();
$log = Log::get_instance();
$log->write($exception->getMessage());
header('Location: ?page=error'); 
}

set_exception_handler('exception_handler');


?>
