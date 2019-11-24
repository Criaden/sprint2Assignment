<?php
require_once("Template.php");

$page = new Template("Home");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='script.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

session_start();

print $page->getTopSection();
		
		print "<div class= \"top\">";
			print "<h1> Sprint 3 - CIS 310 </h1>";
			
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\" class= 'active'>Home</a></li>";
					print "<li><a href=\"survey.php\">Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
					if(isset($_SESSION['role'])){
						if($_SESSION['role'] == "admin"){
							print "<li><a href=\"admin.php\">Admin</a></li>";
						}
					}
					if(isset($_SESSION['username']) && isset($_SESSION['username'])){
						print "<li><a href=\"logout.php\">Logout</a></li>";
					}else{
						print "<li><a href=\"login.php\">Login</a></li>";
					}
					print "<div class=\"topwelcome\">";
					if(isset($_SESSION['username'])){
						print "<li>Welcome, ".$_SESSION['username']."</li>";
					}
					print "</div>";
				print "</ul>";
			print "</div>";
		print "</div>";
		
        print "<div class=\"center\">";

		print "<h1 id= \"bodyMain\"> Welcome to Assignment 2, Sprint 3!</h1>";

        print "</div>";

print $page->getBottomSection();
?>