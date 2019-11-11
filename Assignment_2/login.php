<?php

require_once("DB.class.php");
require_once("Template.php");
require_once("nagivation.php");

$db = new DB();
 
if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

$page = new Template("My Page");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='hello.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();
		/*print "<div class= \"top\">";
			print "<h1> Assignment 1 - CIS 310 </h1>";
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\">Home</a></li>";
					print "<li><a href=\"survey.php\" class= 'active'>Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
					if(isset($_SESSION)){
						print "<li><a href=\"logout.php\">Logout</a></li>";
					}else{
						print "<li><a href=\"login.php\">Login</a></li>";
					}
				print "</ul>";
			print "</div>";
		print "</div>";*/

		
		if(isset($_POST["username"])){
			$username = $_POST["username"];
		}
		
		if(isset($_POST["password"])){
			$password = $_POST["password"];
		}

		if(isset($username)){
			$username = strtolower($username);
		}
		
		if(isset($_POST["username"]) && isset($_POST["password"])){
			$queryUser = "SELECT user.username,role.rolename FROM ((user LEFT JOIN user2role ON user.id=user2role.userid) LEFT JOIN role ON role.id=user2role.roleid);";

			$resultOne = $db->dbCall($queryUser);
		
			foreach($resultOne as $result) {
				$_SESSION['r'] = $result['username'];
				$_SESSION['re'] = $result['rolename'];
			}
		
			print $_SESSION['r'];
			print "<br>";
			print $_SESSION['re'];
		}
		
		if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
			print "<form name= \"login\" method= \"POST\">";
				print "Login: <br>";
				print "<input type=\"text\" name=\"username\"><br>";
				print "<input type=\"password\" name=\"password\"><br>";
			
				print "<input type=\"submit\" name=\"login\" value=\"Login\">";
			print "</form>";
		}else{
			print "<h1>You are currently logged in.</h1>";
		}
		
		print "<a href=\"logout.php\">Logout</a>";
		

print $page->getBottomSection();



?>