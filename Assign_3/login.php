<?php

require_once("DB.class.php");
require_once("Template.php");


$db = new DB();
 
if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

session_start();

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
					if(isset($_SESSION['password'])){
						if($_SESSION['password'] == 'admin'){
							print "<li><a href=\"admin.php\">Admin</a></li>";
						}
					}
					if(isset($_SESSION['username'])){
						print "<li><a href=\"logout.php\" class= 'active'>Logout</a></li>";
					}else{
						print "<li><a href=\"login.php\" class= 'active'>Login</a></li>";
					}
				print "</ul>";
			print "</div>";
		print "</div>";
		
		if(isset($_POST["username"]) && isset($_POST["password"])){
			$username = $_POST['username'];
			
			$queryUser = "SELECT roleid,userpass FROM ((user LEFT JOIN user2role ON user.id=user2role.userid) LEFT JOIN role ON role.id=user2role.roleid) WHERE user.username='$username';";
			
			$resultOne = $db->dbCall($queryUser);

			$database = $resultOne[0]['userpass'];
			
			if(password_verify($_POST['password'], $database)){
				if($resultOne[0]['roleid'] == "2"){
				$_SESSION['role'] = "admin";
				} else if($resultOne[0]['roleid'] == "1"){
					$_SESSION['role'] = "user";	
				}
			
				$_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
				
				header("Location: index.php");
			}
			
			
		}else if(isset($_SESSION['username']) && isset($_SESSION['password'])){
			print "<h1>You are currently logged in.</h1>";
			header("Location: index.php");
		}else if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
			print "<form name= \"login\" method= \"POST\">";
				
                print "<div class=\"center\">";

		        print "<h1> Login Page</h1>";

                print "</div>";
            
                print "Login: <br>";
				print "<input type=\"text\" name=\"username\" placeholder=\"Username:\"><br>";
				print "<input type=\"password\" name=\"password\" placeholder=\"Password:\"><br>";
			
				print "<input type=\"submit\" name=\"login\" value=\"Login\">";
			print "</form>";
		}
		
		print "<a href=\"logout.php\">Logout</a>";
		

print $page->getBottomSection();



?>