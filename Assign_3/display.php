<?php

require_once("DB.class.php");
require_once("Template.php");

$db = new DB();
 
if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

$query = "SELECT * FROM bookinfo";
$albums = array();
$counter = 1;

$result = $db->dbCall($query);


$page = new Template("My Page");
$page->addHeadElement("<script src='hello.js'></script>");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

		if (!$result) {
  
			print "You have received this error: " . var_dump($db->getDBError());
		} else {
			print("<table>");
			
			print("<tr>");
				print("<th>ID</th>");
				print("<th>Book Title</th>");
				print("<th>Author</th>");
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