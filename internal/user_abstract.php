<?php
require 'db_abstract.php';
abstract class User
	{
	/**
	 * Logs the user in
	 * @param  string $eid
	 * @param  string $password
	 * @return bool           Whether the login was successfull
	 */
	public static function login($employee_id,$password)
		{
		$user = Database::get_user_by_id($employee_id);
		if ($user)
			{
			if (password_verify($password,$user['emp_password']))
				{
					{
					// PASSWORD_HASH_COST should be a define() in your config.php
					$new_hash = password_hash($password,PASSWORD_BCRYPT,['cost' => HASH_COST]);
					}
				unset($user['emp_password']);
				$_SESSION['user'] = $user;
				return true;
				}
			}
		return false;
		}

	

	/**
	 * $new_details = ["emp_name" => "New Name", "emp_bio" => "New bio"];
	 *
	 * @param [type] $username
	 * @param [type] $new_details
	 * @return void
	 */
	public static function update_avatar($new_avatar, $emp_id = null)
		{
		if ($emp_id === null)
			{
			if (!self::is_logged_in())
				return false;
			$emp_id = $_SESSION['user']['emp_id'];
			}
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `employees` SET `emp_avatar` = ? WHERE `emp_id` = ?");
		$statement->execute([$new_avatar,$emp_id]);

			if (self::is_logged_in() && $_SESSION['user']['emp_id'] === $emp_id)
			$_SESSION['user']['emp_avatar'] = $new_avatar;
		}



	public static function update_bio($new_bio, $emp_id = null)
		{
		if ($emp_id === null)
			{
			if (!self::is_logged_in())
				return false;
			$emp_id = $_SESSION['user']['emp_id'];
			}
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `employees` SET `emp_bio` = ? WHERE `emp_id` = ?");
		$statement->execute([$new_bio,$emp_id]);
		if (self::is_logged_in() && $_SESSION['user']['emp_id'] === $emp_id)
			$_SESSION['user']['emp_bio'] = $new_bio;
		}



// ADMIN RELATED

	public static function deactivate_user_byID($deactivate_user_byID = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `employees` SET `emp_active` = 0 WHERE `emp_id` = ?");
		$statement->execute([$_POST['deactivate_user_byID']]);
		}

	public static function deactivate_user($deactivate_user = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `employees` SET `emp_active` = 0 WHERE `emp_username` = ?");
		$statement->execute([$_POST['deactivate_user']]);
		}

	public static function activate_user($activate_user = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `employees` SET `emp_active` = 1 WHERE `emp_username` = ?");
		$statement->execute([$_POST['activate_user']]);
		}

	public static function activate_user_byID($activate_user_byID = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `employees` SET `emp_active` = 1 WHERE `emp_username` = ?");
		$statement->execute([$_POST['activate_user_byID']]);
		}
		


// GET POST RELATED

	public static function get_post_by_username($username = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("SELECT `posts`.`id`,`emp_username`,`emp_avatar`,`post_timestamp`,`post_text`,`post_visible`,`post_likes` FROM `posts` LEFT JOIN `employees` ON `posts`.`post_emp_id` = `employees`.`emp_id` WHERE `emp_username` = ? AND `emp_active` = 1 ORDER BY `post_timestamp` DESC");
		$statement->execute([$username]);
		return $statement->fetchAll();
		}

	public static function delete_post($id = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("DELETE FROM posts WHERE id = ?");
		$statement->execute([$id]);
		}

	public static function get_single_post($id = null)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("SELECT `posts`.`id`,`emp_username`,`emp_avatar`,`post_timestamp`,`post_text`,`post_visible`,`post_likes` FROM `posts` LEFT JOIN `employees` ON `posts`.`post_emp_id` = `employees`.`emp_id` WHERE `post_visible` = 1 AND `posts`.`id` = ?");
		$statement->execute([$id]);
		return $statement->fetchAll();
		}
		
	public static function get_post_count()
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("SELECT COUNT(`id`) As `total_records` FROM `posts`");
		$statement->execute();
		$row = $statement->fetch();
		return $row['total_records'];
		}

	public static function get_all_posts($offset,$total_records_per_page)
		{
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("SELECT `posts`.`id`,`emp_username`,`emp_avatar`,`post_timestamp`,`post_text`,`post_visible`, `post_likes` FROM `posts` LEFT JOIN `employees` ON `posts`.`post_emp_id` = `employees`.`emp_id` WHERE `post_visible` = 1 AND `emp_active` = 1 ORDER BY `post_timestamp` DESC LIMIT ?, ?");
		$statement->execute([$offset,$total_records_per_page]);
		return $statement->fetchAll();
		}


// SEND POST TO DB

	public static function send_post($post_text , $emp_id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("INSERT INTO posts(post_text,post_emp_id,post_visible) VALUES(?,?,1);");
		$statement->execute([escape_html($post_text) , $emp_id]);
		}



// LIKE BUTTON

	public static function liked_post($id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("SELECT * FROM `posts` WHERE id = ?");
		$statement->execute([$id]);
		$row = $statement->fetch();
		return $row['post_likes'];
		}

	public static function insert_likes($emp_id, $id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("INSERT INTO `likes` (`likes_emp_id`, `likes_post_id`) VALUES (?,?)");
		$statement->execute([$emp_id,$id]);
		$row = $statement->fetchAll();
		}
	
	public static function update_likes($n, $id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE posts SET post_likes = ?+1 WHERE id = ?");
		$statement->execute([$n,$id]);
		}
	
	public static function delete_likes($emp_id, $id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("DELETE FROM `likes` WHERE `likes_emp_id`= ? AND`likes_post_id`= ?");
		$statement->execute([$emp_id,$id]);
		$row = $statement->fetchAll();
		}
	
	public static function update_dislikes($n, $id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("UPDATE `posts` SET `post_likes` = ?-1 WHERE `id` = ?");
		$statement->execute([$n,$id]);
		}
			
	public static function user_liked($emp_id, $id = null){
		$pdo = Database::get_pdo();
		$statement = $pdo->prepare("SELECT COUNT(`id`) AS `liked` FROM `likes` WHERE `likes_emp_id` = ? AND `likes_post_id` = ?");
		$statement->execute([$emp_id,$id]);
		$results = $statement->fetch();
		return $results['liked'];
		}
	


	
			// try {


			// } catch (\PDOException $e) {
	
			// 	echo $e->getMessage();
			// 	$log = Log::get_instance();
			// 	$log->write($user_ip .' : ' . $_SESSION["user"]["emp_username"] . ' : ' . $e->getMessage());
			// }
	
		

		
	/**
	 * Logs the user out
	 * @return void
	 */
	public static function logout()
		{
		unset($_SESSION['user']);
		}

	/**
	 * Check if a user is logged in
	 * @return boolean
	 */
	public static function is_logged_in()
		{
		return isset($_SESSION['user']);
		}

	/**
	 * Returns whether the user is an admin or not
	 * @return boolean
	 */
	public static function is_admin()
		{
		if (self::is_logged_in())
			return ($_SESSION['user']['emp_role_id'] == 1);
		return false;
		}

	/**
	 * Returns the user object as assoc array or null if not logged in.
	 * @return null|array
	 */
	public static function get_user()
		{
		if (self::is_logged_in())
			return $_SESSION['user'];
		return null;
		}

	/**
	 * Check whether a user with the specified eID exists.
	 * @param  string $eid
	 * @return boolean
	 */
	static public function exists($eid)
		{
		$user = Database::get_user_by_eid($eid);
		return $user != false;
		}

	static public function register()
		{
		 $pdo = Database::get_pdo();
		 $statement = $pdo->prepare("select `emp_username` from `employees` where `emp_username` = ?");
		 $statement2 = $pdo->prepare("select * from `existingid` where `emp_id` = ?");
		 $statement3 = $pdo->prepare("select `emp_id` from `employees` where `emp_id` = ?");
		 $first = $_POST['first_name'];
		 $last = $_POST['last_name'];
		 $fullname = $first . " " . $last;
		 $username = $_POST['username'];
		 $employee_id = $_POST['employee_id'];
		 $department_id = $_POST['emp_dept_id'];
		 $password = $_POST['password'];
		 $confirm_password = $_POST['confirm_password'];
		 $statement->execute([$username]);
		 $existingusername = $statement->fetch();
		 $statement2->execute([$employee_id]);
		 $existingid = $statement2->fetch();
		 $statement3->execute([$employee_id]);
		 $registered_id = $statement3->fetch();
		 $options = ['cost' => 10];
		 $default_role = 2;
		 $default_avatar = "internal/profile_img/default.jpg";
		 $emp_active = 1;

			 if (!preg_match('#[0-9]#', $first) && !preg_match('#[0-9]#', $last)) {
			  if (!$existingusername) {
			    if ($existingid && !$registered_id) {
			      if (strlen($password) >= 6) {
			        if ($password === $confirm_password) {
			          $hashedpass = password_hash($password,PASSWORD_BCRYPT,$options);
								$register = $pdo->prepare("insert into `employees`(emp_name, emp_password, emp_username, emp_dept_id, emp_role_id, emp_avatar, emp_active, emp_id) VALUES (?,?,?,?,?,?,?,?)");
			          $register->execute([$fullname, $hashedpass, $username, $department_id, $default_role, $default_avatar, $emp_active, $employee_id]);

			          $log = Log::get_instance();
			          $log->write($_POST["username"] . ' : USER REGISTERED.');
					  header('Location: ?page=login'); 
			          exit;
			      }
			        else {
			          echo "<p class='hidden_messages'>The passwords you entered do not match!</p>";
			        }
			      }
			      else {
			        echo "<p class='hidden_messages'>Your password should be a minimum of 6 characters.</p>";
			      }
			    }
			    else {
			      echo "<p class='hidden_messages'>The employee ID you entered does not exist or it is already registered.</p>";
			    }
			  }
			  else {
			    echo "<p class='hidden_messages'>The username you entered already exists!</p>";
			  }
			 }
			 else{
			  echo "<p class='hidden_messages'>Please make sure that your first and last name don't contain any numbers!</p>";
		 }

		
	 }
	

	};



	//  if (User::is_admin())
	//  {
	//  // user is an admin
	//  }
 

/*
$username = $_POST['username'];
$password = $_POST['password'];

$result = User::login($username, $password);

if ($result)
	echo 'You logged in!';

User::logout();

if (User::is_logged_in())
	{
	// user is logged in!
	}


if (User::exists($eid))
	{
	// user with specified eID exists
	}

$user = User::get_user();
echo $user['display_name'];


*/
