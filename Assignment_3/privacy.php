<?php
session_start();
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
					print "<li><a href=\"privacy.php\" class= 'active'>Privacy</a></li>";
					print "<li><a href=\"search.php\">Search</a></li>";
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
		
		print "<h1>Privacy Policy</h1>";
		
		
		print "<p>The University of Wisconsin System Administration (UWSA) recognizes the importance of protecting the privacy of information provided to us.</p>";

		print "<h2>Personal information</h2>";
		
		print "<p>We will use personal information that you provide via e-mail or through other online means only for purposes necessary to serve your needs, such as responding to an inquiry or other request for information. This may involve redirecting your inquiry or comment to another person or department better suited to meeting your needs.</p>";

		print "<p>Some webpages at UWSA may collect personal information about visitors and use that information for purposes other than those stated above. Each webpage that collects information will have a separate privacy statement that will tell you how that information is used.</p>";

		print "<h2>Collected Information</h2>";
		
		print "<p>UWSA monitors network traffic for the purposes of site management and security. We use this information to help diagnose problems and carry out other administrative tasks. We also use statistic information to determine which information is of most interest to users, to identify system problem areas, or to help determine technical requirements. The server log information does not include personal information.</p>";

		print "<h2>External websites</h2>";
		
		print "<p>This site contains links to other sites outside of UWSA. UWSA is not responsible for the privacy practices or the content of such websites.</p>";

		print "<h2>Questions</h2>";
		
		print "<p>If you have any questions about this privacy statement, the practices of this site, or your use of this website, please contact Webmaster.</p>";
		

print $page->getBottomSection();
?>