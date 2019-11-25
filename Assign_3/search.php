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
		

        print "<div class=\"center\">";

		print "<h1> Album Search Page</h1>";

        print "</div>";


		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if(empty($_POST["search"]) == true){
					$emailERR = "Invalid Search<br>";
				}else{
					$email = test_input($_POST["search"]);
					$_SESSION["search"] = test_input($_POST["search"]);
				}
				if(isset($_SESSION["search"])){
					header("Location: searchresults.php");
				}
		}
		
		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}


		print "<form name= \"search\" method= \"POST\" action=". htmlspecialchars($_SERVER['PHP_SELF']) .">";
			print "Search: <br>";
			print "<input type=\"text\" name=\"search\" placeholder=\"Please enter an album:\"><br>";
			print "<input type=\"submit\" name=\"submit\" value=\"Search\">";
		print "</form>";
		
print $page->getBottomSection();
?>