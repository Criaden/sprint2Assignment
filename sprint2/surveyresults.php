<?php
require_once("Template.php");
require_once("DB.class.php");

$page = new Template("Home");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='script.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

$db = new DB();
 
if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

if(isset($_POST["userMajor"]) === true){
	$userMajor = $_POST["userMajor"];
}else{
	print("<br>");
	echo("Not a valid email address");
	print("<br>");
}
if(isset($_POST["userGrade"]) === true){
	$userGrade = $_POST["userGrade"];
}else{
	print("<br>");
	echo("Not a valid email address");
	print("<br>");
}
if(isset($_POST["userPizza"]) === true){
	$userPizza = $_POST["userPizza"];
}else{
	print("<br>");
	echo("Not a valid email address");
	print("<br>");
}
if(isset($_POST["userEmail"]) === true){
	$userEmail = $_POST["userEmail"];
	if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
		echo("");
	}else{
		print("<br>");
		echo("Not a valid email address");
		print("<br>");
	}
			
	$userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
}else{
	print("<br>");
	echo("Not a valid email address");
	print("<br>");
}
	
print $page->getTopSection();
		print "<div class= \"top\">";
			print "<h1> Assignment 2 - CIS 310 </h1>";
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\">Home</a></li>";
					print "<li><a href=\"survey.php\">Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
				print "</ul>";
			print "</div>";
		print "</div>";
		
		print "<h1> Survey Results, Welcome Admin  </h1>";
		
		$userEmail = strtolower($userEmail);
		$userMajor = strtolower($userMajor);
		$userGrade = strtolower($userGrade);
		$userPizza = strtolower($userPizza);

		$data = array("type" => "1",
			"email" => $userEmail,
			"major" => $userMajor,
			"grade" => $userGrade,
			"pizza" => $userPizza);
		
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
		
	
print $page->getBottomSection();
?>