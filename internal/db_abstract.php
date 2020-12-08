<?php

abstract class Database
	{
	protected static $pdo = null;

	// user functions

	// lazy loading pattern -> WORTH GOOGLING
	/**
	 * Returns a PDO instance.
	 * @return object
	 */
	public static function get_pdo()
		{
		if (self::$pdo === null)
			{
			$dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".DB_CHARSET;
			$options =
				[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false
				];
			self::$pdo = new PDO($dsn,DB_USERNAME,DB_PASSWORD,$options);
			}
		return self::$pdo;
		}

	/**
	 * Returns a user row from the database based on the eID
	 * @param  string $emp_id The eID to look up
	 * @return false|array      Assoc array if the user exists
	 */
	// public static function get_user_by_id($emp_id)
	// 	{
	// 	$pdo = self::get_pdo();
	// 	$statement = $pdo->prepare("SELECT * FROM `employees` WHERE `emp_id` = ?");
	// 	if ($statement->execute(escape_html([$emp_id])))
	// 		return $statement->fetch();
	// 	return false;
	// 	}

		public static function get_user_by_id($employee_id)
		{
				$pdo = self::get_pdo();
				$statement = $pdo->prepare("SELECT * FROM `employees` LEFT JOIN `departments` ON `employees`.`emp_dept_id` = `departments`.`id` WHERE `emp_id` = ?");
				if ($statement->execute([$employee_id]))
					return $statement->fetch();
					return false;
		}
		
		
		public static function get_user_by_username($username)
		{	
			$pdo = self::get_pdo();
			$statement = $pdo->prepare("SELECT * FROM `employees` LEFT JOIN `departments` ON `employees`.`emp_dept_id` = `departments`.`id` WHERE `emp_username` = ?");
			if ($statement->execute([$username]))
				return $statement->fetch();
				return false;
	}

}
