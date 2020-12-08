<div class='post_list_container'>

<?php
if ($_SESSION['user'] == null){
	header("Location: ?page=login");
	die();
    }

$id = $_GET['id'];
$emp_id = $_SESSION["user"]["emp_id"];

foreach ($posts = User::get_single_post($id) as $row) {
	$now = new DateTime();
	$post_date = new DateTime($row['post_timestamp']);
	$diff = $now -> diff($post_date);

	$days = $diff->days;
	if 	($days < 1) {
		$timelate = ($diff->h . " hours");
		if 	($diff->h < 1) {
			$timelate = ($diff->i . " minutes");}}
	else $timelate = ($days . " days");


	echo "<div class='post_content'><div class='avatar_edit_delete_container'><div class='avatar'><img class='profile_img spin' src='" . $row['emp_avatar'] . "'></div>";
	echo "<div class='post_username'>" . $row['emp_username'];
	echo "<div class='post_timestamp'>" . $timelate . " ago</div></div>";


	if ((User::is_admin()) || ($row['emp_username'] == $_SESSION["user"]["emp_username"]))
	{
		echo "<div class='post_delete' id='post_delete_container'></div><a href='?page=delete&id=".$row['id']."'><img class='delete_icon icons' src='images/delete_icon.png'/></a>";}
		else {};
	echo "</div><div class='post_text'>" . $row['post_text'] . "</div><div class='post_link'>";
	
	if ($row['post_likes'] == 1){
		$likes = " Like";
	}else{
		$likes = " Likes";
	}

	$results = User::user_liked($emp_id,$row['id']);
	if ($results == 1 ){
	echo "<div class='liked'><a href='?page=unlike&id=".$row['id']."'><img class='icons' id='thumbs_up' src='images/thumbs_up_icon.png'></a> ".$row['post_likes'].$likes."</div></div></div>"; 

	} else {

	echo "<div class='unliked like_button_container'><a href='?page=like&id=".$row['id']."'><img class='icons like_button' id='thumbs_up' src='images/thumbs_up_icon.png'></a> ".$row['post_likes'].$likes."</div></div></div>"; 

	}
}
    
	?>
</div>
