<?php

require_once("DB.class.php");
require_once("Template.php");

$db = new DB();
 
if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

$search = $_POST["search"];

$search = strtolower($search);

$query = "SELECT  id, artist, album FROM albuminfo WHERE LOWER(id) = '$search' OR LOWER(artist) = '$search' OR LOWER(album) = '$search'";

$result = $db->dbCall($query);


$page = new Template("My Page");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='hello.js'></script>");
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

		if (!$result) {
            
            print "<br style = “line-height:200px;”>";
  
			print "You have submitted an invalid search, check for any misspelling in your search" . var_dump($db->getDBError());
		} else {
            
            print "<br style = “line-height:200px;”>";
            
			print("<table>");
			
			print("<tr>");
				print("<th>ID</th>");
				print("<th>Artist</th>");
				print("<th>Album Name</th>");
			print("</tr>");

			
			foreach($result as $values){
				print("<tr>");
				foreach($values as $keys){
					print("<td>$keys</td>");
				}
				
				print("</tr>");
			}
			
			print("</table>");

		$result = false;
		}

print $page->getBottomSection();



?>