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
		

		print "<form name= \"search\" method= \"POST\" action= \"searchresults.php\">";
			print "Search: <br>";
			print "<input type=\"text\" name=\"search\"><br>";
			
			print "<input type=\"submit\" name=\"submit\" value=\"Search\">";
		print "</form>";
		
print $page->getBottomSection();
?>