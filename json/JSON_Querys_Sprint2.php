<?php

require_once("DB.class.php");

$db = new DB();

if(!$db->getConnStatus()){
	print "An error has occured with connection\n";
	exit;
}

/*  Step 1:  Receive Data */
$rawData = file_get_contents("php://input");

/*  Step 2: Check if data is there */ 
if (is_null($rawData) || empty($rawData)) {
                print "No input detected";
                exit;
}

/*  Step 3:  Execute json_decode()  */
$input = json_decode($rawData);

/*  Step 4:  Check for property.   */


/*  Step 5:  Retrieve data.  In this case,
	setting up an array of hex values
	to color names and then seeing 
	if the input is found in the array
*/
$queryType = array(
  "login" => "0",
  "survey" => "1",
  "search" => "2"
);

if ($queryType['login'] == $input['type']) {
  $username = $input['username'];
	
  $queryUser = "SELECT roleid,userpass FROM ((user LEFT JOIN user2role ON user.id=user2role.userid) LEFT JOIN role ON role.id=user2role.roleid) WHERE user.username='$username';";
			
  $resultOne = $db->dbCall($queryUser);

  $database = $resultOne[0]['userpass'];
			
  if(password_verify($input['password'], $database)){
	if($resultOne[0]['roleid'] == "2"){
		$_SESSION['role'] = "admin";
	} else if($resultOne[0]['roleid'] == "1"){
		$_SESSION['role'] = "user";	
	}
			
	$_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
  }
}

$queryType = array(
  "login" => "0",
  "survey" => "1",
  "search" => "2"
);

/*if(array_key_exists($input->login,$queryType){
	
}*/

if (!array_key_exists($input->type,$queryType)) {
  print json_encode(array("result" => array("ErrorMessage" => "Type doesn't exist")));
  exit;
}

/*  Step 6:  Create output.  */
print json_encode(array("result" => $queryType[$input->type]));
