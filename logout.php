<?php
session_start();
require_once("Template.php");

$page = new Template("My Page");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='hello.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

		print "<div class= \"top\">";
			print "<h1> Sprint 3 - CIS 310 </h1>";
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\">Home</a></li>";
					print "<li><a href=\"survey.php\">Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
					if(isset($_SESSION['role'])){
						if($_SESSION['role'] == 'admin'){
							print "<li><a href=\"admin.php\">Admin</a></li>";
						}
					}
					if(isset($_SESSION['username'])){
						print "<li><a href=\"logout.php\">Logout</a></li>";
					}else{
						print "<li><a href=\"login.php\">Login</a></li>";
					}
					if(isset($_SESSION['username'])){
						print "<li>Welcome, ".$_SESSION['username']."</li>";
					}
				print "</ul>";
			print "</div>";
		print "</div>";
		
		

		if(isset($_SESSION)){
			session_destroy();
			$_SESSION['r'] = "";
			$_SESSION['re'] = "";
		}
		

		
		print "<h1> You are now logged out";

print $page->getBottomSection();



?>