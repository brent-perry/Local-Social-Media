<?php
	ob_start();
	session_start();

	require 'config.php';
	require 'includes/ip.php';
	require 'includes/log.php';
	require 'internal/exception.php';


	$page = 'homepage';

	if (!empty($_GET['page']))
	$page = $_GET['page'];

	$page = str_replace('.','',$page);
	$page = str_replace('/','',$page);


// HEAD
	require 'includes/head.php';


//BODY
			error_reporting(E_ALL);
			ini_set('display_errors','On');

			

			require 'includes/clock.php';
		


			$page_file =  "pages/" . $page . ".php";
			if (file_exists($page_file))
			require  "pages/" . $page . ".php";
			else require "pages/error.php"; 
			require 'includes/footer.php';



			function escape_html($html)
			{
			return htmlspecialchars($html, ENT_HTML5);
			}  
			
			require 'includes/to_top.php';
			
?>