  
<?php		

session_start();

require_once("Template.php");
require_once("DB.class.php");

require_once("Template.php");
$page = new Template("Home");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->addHeadElement("<script src='script.js'></script>");
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
					if(isset($_SESSION['role'])){
						if($_SESSION['role'] == 'admin'){
							print "<li><a href=\"admin.php\" class='active'>Admin</a></li>";
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
		

$db = new DB();
 
if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

$queryShow = "SELECT * FROM surveytable";

$result = $db->dbCall($queryShow);

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