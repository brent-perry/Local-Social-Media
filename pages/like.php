<?php
if ($_SESSION['user'] == null){
	header("Location: ?page=login");
	die();
    }

$id = $_GET['id'];
$emp_id = $_SESSION["user"]["emp_id"];

$result = User::liked_post($id);
$n = $result;

User::insert_likes($emp_id,$id);
User::update_likes($n,$id);

header('Location: ' . $_SERVER['HTTP_REFERER'].'#'.$id);

