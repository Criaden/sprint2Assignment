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
			$data = array("type" => "0",
				"username" => $_POST["username"], "password" => $_POST["password"]);
			
			$dataJson = json_encode($data);
			
			$contentLength = strlen($dataJson);

			$header = array(  'Content-Type: application/json',       
				'Accept: application/json',  
				'Content-Length: ' . $contentLength);
 
			$url = "https://cnmtsrv2.uwsp.edu/~smenz063/json/JSON_Querys_Sprint2.php";
 
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 
			$return = curl_exec($ch);
 
			// Check HTTP Status
 
			$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
			$resultObject = json_decode($return);
 
			// Verify returnobject contains what you expect.
 
			if ($httpStatus != 200) {  
				// Usually don't reflect httpStatus to user.        
				print "Something went wrong with the request: " . $httpStatus;        
				curl_close($ch);
				exit;
			}
 
			$resultObject = json_decode($return);
			if (!is_object($resultObject)) {        
				print "Something went wrong decoding the return";        
				curl_close($ch);        
				exit;
			}
 
			if (property_exists($resultObject,"errorMessage")) {        
				print "Error: " . $resultObject->errorMessage;
			} else if (property_exists($resultObject,"result")){                  
				$username = $_POST['username'];
			} else {        
				print "Something went wrong with the return, no result found";
			}

			curl_close($ch);
			
			
			
			header("Location: index.php");
			
		}else if(isset($_SESSION['username']) && isset($_SESSION['password'])){
			print "<h1>You are currently logged in.</h1>";
			header("Location: index.php");
		}else if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
			print "<form name= \"login\" method= \"POST\">";
				
                print "<div class=\"center\">";

		        print "<h1> Login Page";

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