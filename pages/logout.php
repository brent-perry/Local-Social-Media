<?php
    $log = Log::get_instance();
	$log->write($user_ip .' : ' . $_SESSION['user']['emp_id'] . ' : USER LOGGED OUT.'); 
	unset($_SESSION["user"]); 
    header('Location: ?page=login'); 

?>
