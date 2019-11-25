<?php
session_start();
require_once("Template.php");

$page = new Template("Home");
$page->addHeadElement("<link rel=\"stylesheet\" href=\"styles.css\">");
$page->finalizeTopSection();
$page->finalizeBottomSection();

print $page->getTopSection();

		print "<div class= \"top\">";
			print "<h1> Sprint 3 - CIS 310 </h1>";
	
			print "<div class=\"topnavbar\">";
				print "<ul>";
					print "<li><a href=\"index.php\">Home</a></li>";
					print "<li><a href=\"survey.php\" class= 'active'>Survey</a></li>";
					print "<li><a href=\"privacy.php\">Privacy</a></li>";
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
		
		
		$emailERR = $majorERR = $gradeERR = $pizzaERR = "";
		$email = $major = $grade = $pizza = "";
		
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if(empty($_POST["userEmail"]) == true){
					$emailERR = "Email is required<br>";
				}else{
					$email = test_input($_POST["userEmail"]);
					$_SESSION["email"] = test_input($_POST["userEmail"]);
				}
				
				if(empty($_POST["userMajor"]) == true){
					$majorERR = "Major is required<br>";
				}else{
					$major = test_input($_POST["userMajor"]);
					$_SESSION["major"] = test_input($_POST["userMajor"]);				
				}	
				
				if(empty($_POST["userGrade"])){
					$gradeERR = "Grade is required<br>";
				}else{
					$grade = test_input($_POST["userGrade"]);
					$_SESSION["grade"] = test_input($_POST["userGrade"]);
				}
				
				if(empty($_POST["userPizza"])){
					$pizzaERR = "Pizza topping is required<br>";
				}else{
					$pizza = test_input($_POST["userPizza"]);
					$_SESSION["pizza"] = test_input($_POST["userPizza"]);
				}	
				
				if($email != "" && $major != "" && $grade != "" && $pizza != ""){
					$url="submitted.php";
					echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
				}
		}
		
		
		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
	
		print "<form name= \"survey\" method= \"POST\" action=". htmlspecialchars($_SERVER['PHP_SELF']) .">";
			print "Email:<br>";
			print "<span class='error'>". $emailERR . "</span>";
			print "<input type=\"text\" name=\"userEmail\" id= \"email\"><br>";
			
			
			print "<br>";
			
			print "What is your major?<br>";
			print "<span class='error'>". $majorERR . "</span>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"cisappdev\"> CIS-AppDev<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"cisnetworking\"> CIS-Networking<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"wdmd\"> WDMD<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"wd\"> WD<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"hti\"> HTI<br>";
			print "<input type=\"checkbox\" name=\"userMajor\" value=\"other\"> Other<br>";
			
			
			print "<br>";
			
			print "What grade do you expect to receive in CNMT 310?<br>";
			print "<span class='error'>". $gradeERR . "</span>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"a\"> A<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"b\"> B<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"c\"> C<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"d\"> D<br>";
			print "<input type=\"radio\" name=\"userGrade\" value=\"f\"> F<br>";
			
			
			print "<br>";
			
			print "What is your favorite pizza topping?<br>";
			print "<span class='error'>". $pizzaERR . "</span>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"cheese\"> Cheese<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"sausage\"> Sausage<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"pepperoni\"> Pepperoni<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"pineapple\"> Pineapple<br>";
			print "<input type=\"radio\" name=\"userPizza\" value=\"bbqchicken\"> BBQ Chicken<br>";
			
			
			print "<br><br>";
			
			print "<input type=\"Submit\" value=\"submit\">";
			
			
			
		print "</form>";
		
		
		
print $page->getBottomSection();

?>