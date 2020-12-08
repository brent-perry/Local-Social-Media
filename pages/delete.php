<?php

// DELETE POST

if ($_SESSION['user'] == null){
	header("Location: ?page=login");
	die();
    }

$id = $_GET['id'];

foreach ($posts = User::get_single_post($id) as $row) {
    if ((User::is_admin()) || ($row['emp_username'] == $_SESSION["user"]["emp_username"]))
    {
        User::delete_post($id);
        header('Location: ?page=post');    
    } else {
        header("Location: ?page=profile");
        die();
    }
}

?>