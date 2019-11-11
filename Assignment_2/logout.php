<?php

require_once("Template.php");

$page = new Template("My Page");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='hello.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

		print "<div class= \"top\">";
			print "<h1> Assignment 1 - CIS 310 </h1>";
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\">Home</a></li>";
					print "<li><a href=\"survey.php\">Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
					print "<li><a href=\"login.php\">Login</a></li>";
				print "</ul>";
			print "</div>";
		print "</div>";
		
		session_start();

		if(isset($_SESSION)){
			session_destroy();
			$_SESSION['r'] = "";
			$_SESSION['re'] = "";
		}
		

		
		print "<h1> You are now logged out";

print $page->getBottomSection();



?>