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
		
$userEmail = strtolower($userEmail);
$userMajor = strtolower($userMajor);
$userGrade = strtolower($userGrade);
$userPizza = strtolower($userPizza);
$query = "INSERT INTO surveyTable(submittime, email, major, grade, pizzatype) VALUES(NOW(), '$userEmail', '$userMajor', '$userGrade', '$userPizza');";
$result = $db->dbCall($query);
$queryShow = "SELECT * FROM surveyTable";
$result = $db->dbCall($queryShow);
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
		
		print("<table>");
			
			print("<tr>");
				print("<th>ID</th>");
				print("<th>Submit Time</th>");
				print("<th>Email</th>");
				print("<th>Major</th>");
				print("<th>Grade</th>");
				print("<th>Pizza</th>");
			print("</tr>");
			
			foreach($result as $values){
				print("<tr>");
				foreach($values as $keys){
					print("<td>$keys   </td>");
				}
				
				print("</tr>");
			}
			
		print("</table>");
		
	
print $page->getBottomSection();
?>