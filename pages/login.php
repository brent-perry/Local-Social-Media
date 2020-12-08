<div class="login_container">
	<div class="login_info">
		<form class="login_input_container" type="post" method="post">
			<input class="login_input" type="text" name="employee_id" placeholder="Employee ID" autocomplete="off"></input>
			<input class="login_input" type="password" name="password" placeholder="Password" autocomplete="off"></input>
			<button class="login_button" type="submit" name="login">Login</button>
		</form>
		<div class="not_registered"><a href="?page=register">Sign up</a></div>
	</div>
</div>

<?php
require 'internal/database.php';

if(isset($_POST["employee_id"]) && $_POST['employee_id'] !== ""){
	if (User::login($_POST['employee_id'], $_POST['password']))
	{
		$log = Log::get_instance();
		$log->write($user_ip .' : ' . $_SESSION['user']['emp_id'] . ' : USER LOGGED IN.');
		header('Location: ?page=post'); 
	}
	else  {	
		echo "<p class='hidden_messages'>Incorrect login details!</p>";
		$log = Log::get_instance();
		$log->write($user_ip .' : ' . $_POST['employee_id'] . ' : USER FAILED LOG IN.');
	}

}


 ?>
