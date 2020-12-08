<?php
if ($_SESSION['user'] == null){
	header("Location: ?page=login");
	die();
	}
	
require 'includes/bioupdate.php';
require 'internal/database.php';

$emp_id = $_SESSION["user"]["emp_id"];


$statement = $pdo->prepare("SELECT * FROM `posts` WHERE `post_emp_id` = ? ORDER BY `post_timestamp` desc LIMIT 1");
$statement->execute([$_SESSION["user"]["emp_id"]]);
$posts = $statement->fetch();

if ($posts == null) 
{
$posttext = "SUCH EMPTY!";
$posttimestamp = "SUCH EMPTY!";
}
else 
{
$_SESSION["post"] = $posts;
$posttext = $_SESSION["post"]['post_text'];
$posttimestamp = $_SESSION["post"]['post_timestamp'];
};
?>
<div class='post_list_container'>
<div class="profile_container">
	
<?php 

if (!empty($_FILES) && !empty($_FILES['profile_img']))
{
$type = $_FILES['profile_img']['type'];
if ($type === 'image/jpeg' || $type === 'image/png')
	{
	$ext = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);
	$destination = 'internal/profile_img/'. $_SESSION["user"]["emp_id"] . "." .$ext;
	move_uploaded_file($_FILES["profile_img"]["tmp_name"],$destination);

	User::update_avatar($destination);
	header('Location: ?page=profile'); 
	}
else
	$upload_error = true;
}
?>
	<div class="employee_info">
		<div class="profile_image_container">
			<img class="profile_image spin" src="<?php echo $_SESSION["user"]["emp_avatar"]; ?>"/>
			<form class="upload_form" action="" method="post" enctype="multipart/form-data">
				<div class="upload_container">
					<label>
						<div>
							<input class="upload_img" type="file" name="profile_img" id="profile_img"/>
							<img class="icons" id="folder_icon" src="images/folder.png"/>
							<p>Choose Image</p>
						</div>
					</label>
					<label>
						<div>
							<input class="upload_img" type="submit" value="Upload file"/>
							<img class="icons" id="upload_icon" src="images/upload_icon.png"/>
							<p>Upload Image</p>
						</div>
					</label>
				</div>
			</form>
		</div>
		<p id="employee_info"><span class="profile_span">Name:</span> <?php echo $_SESSION["user"]["emp_name"]; ?></p>
		<p id="employee_info"><span class="profile_span">Username:</span> <?php echo $_SESSION["user"]["emp_username"]; ?></p>
		<p id="employee_info"><span class="profile_span">Employee ID:</span> <?php echo $_SESSION["user"]["emp_id"]; ?></p>
		<p id="employee_info"><span class="profile_span">Department:</span> <?php echo $_SESSION["user"]["deptname"]; ?></p>
		
		<form class="edit_form" action="" method="post">
		<p id="employee_info"><span class="profile_span">Description: 
			<input class="edit" type="submit" value="Upload file"/>
			<a href=#bioupdate> <img class="icons" id="edit_icon" src="images/edit_icon.png"> </a></br></span>
		<?php echo $_SESSION["user"]["emp_bio"]; ?></p>	
		</form>

	</div>
</div>

<?php

foreach ($posts = User::get_post_by_username($_SESSION["user"]["emp_username"]) as $row) {
	$now = new DateTime();
	$post_date = new DateTime($row['post_timestamp']);
	$diff = $now -> diff($post_date);

	$days = $diff->days;
	if 	($days < 1) {
		$timelate = ($diff->h . " hours");
		if 	($diff->h < 1) {
			$timelate = ($diff->i . " minutes");}}
	else $timelate = ($days . " days");

	echo "<div id=".$row['id']." class='post_content'><div class='avatar_edit_delete_container'>";
	echo "<div id='timestamp' class='post_timestamp'>" . $timelate . " ago</div>";


	if ((User::is_admin()) || ($row['emp_username'] == $_SESSION["user"]["emp_username"]))
	{
		echo "<div class='post_delete' id='post_delete_container'></div><a href='?page=delete&id=".$row['id']."'><img class='delete_icon icons' src='images/delete_icon.png'/></a>";}
		else {};
	echo "</div><div class='post_text'>" . $row['post_text'] . "</div><div class='post_link'><a href='?page=share&id=".$row['id']."'><img id='share_icon' class='icons' src='images/share_icon.png'/></a>";


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
