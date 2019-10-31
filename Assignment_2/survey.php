<?php

require_once("Template.php");

$page = new Template("Home");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='script.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

		print "<div class= \"top\">";
			print "<h1> Assignment 1 - CIS 310 </h1>";
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\">Home</a></li>";
					print "<li><a href=\"survey.php\" class= 'active'>Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
				print "</ul>";
			print "</div>";
		print "</div>";
		
		print "<form name= \"survey\" method= \"POST\" onsubmit= \"return checkSubmitted()\" action= \"submitted.php\">";
			print "Email:<br>";
			print "<input type=\"text\" name=\"userEmail\" id= \"email\"><br>";
			
			print "<br>";
			
			print "What is your major?<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"cisappdev\"> CIS-AppDev<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"cisnetworking\"> CIS-Networking<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"wdmd\"> WDMD<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"wd\"> WD<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"hti\"> HTI<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"other\"> Other<br>";
			
			print "<br>";
			
			print "What grade do you expect to receive in CNMT 310?<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"a\"> A<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"b\"> B<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"c\"> C<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"d\"> D<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"f\"> F<br>";
			
			print "<br>";
			
			print "What is your favorite pizza topping?<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"cheese\"> Cheese<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"sausage\"> Sausage<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"pepperoni\"> Pepperoni<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"pineapple\"> Pineapple<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"bbqchicken\"> BBQ Chicken<br><br>";
			
			print "<br>";
			
			print "<input type=\"submit\" value=\"submit\">";
			
			
		print "</form>";
		
print $page->getBottomSection();
?>