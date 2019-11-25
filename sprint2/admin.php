  
<?php		

session_start();

require_once("Template.php");

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

$data = array("type" => "1",
"desc" => "adminpage");
			
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
	print "<h1>Here are the survey results:</h1>";
} else {        
	print "Something went wrong with the return, no result found";
}

curl_close($ch);

print("<table>");
			
			print("<tr>");
				print("<th>ID</th>");
				print("<th>Submit Time</th>");
				print("<th>Email</th>");
				print("<th>Major</th>");
				print("<th>Grade</th>");
				print("<th>Pizza</th>");
			print("</tr>");

			
			foreach($resultObject as $values){
				print("<tr>");
				foreach($values as $keys){
					print("<td>$keys   </td>");
				}
				
				print("</tr>");
			}
			
print("</table>");
print $page->getBottomSection();