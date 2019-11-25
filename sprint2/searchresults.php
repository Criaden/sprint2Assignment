<?php
session_start();

require_once("Template.php");

$search = $_POST["search"];

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
					print "<li><a href=\"search.php\" class= 'active'>Search</a></li>";
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


			$data = array("type" => "3",
			"search" => $_POST["search"]);
		
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
 
		$resultObject = json_decode($return, true);
 
		// Verify returnobject contains what you expect.
 
		if ($httpStatus != 200) {  
			// Usually don't reflect httpStatus to user.        
			print "Something went wrong with the request: " . $httpStatus;        
			curl_close($ch);
			exit;
		}
 
		if (!is_object($resultObject)) {        
			print "Something went wrong decoding the return";        
			curl_close($ch);        
			exit;
		}
 
		if (property_exists($resultObject,"errorMessage")) {        
			print "Error: " . $resultObject->errorMessage;
		} else if (property_exists($resultObject,"result")){  
			print "<h1>Thanks for submitting your survey!</h1>";
		} else {        
			print "Something went wrong with the return, no result found";
		}

		curl_close($ch);
		
		
            print "<br style = “line-height:200px;”>";
            
			print("<table>");
			
			print("<tr>");
				print("<th>ID</th>");
				print("<th>Artist</th>");
				print("<th>Album Name</th>");
				print("<th>Link</th>");
			print("</tr>");

			
			foreach($resultObject as $values){
				print("<tr>");
				foreach($values as $keys){
					print("<td>$keys</td>");
				}
				
				print("</tr>");
			}
			
			print("</table>");

		$result = false;
		

print $page->getBottomSection();



?>