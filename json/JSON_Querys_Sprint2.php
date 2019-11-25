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
$input = json_decode($rawData, true);

/*  Step 4:  Check for property.   */


/*  Step 5:  Retrieve data.  In this case,
	setting up an array of hex values
	to color names and then seeing 
	if the input is found in the array
*/


$queryType = array(
  "login" => "0",
  "admin" => "1",
  "survey" => "2",
  "search" => "3"
);

if ($input['type'] == 0) {
  $username = $input['username'];
	
  $queryUser = "SELECT roleid,userpass FROM ((user LEFT JOIN user2role ON user.id=user2role.userid) LEFT JOIN role ON role.id=user2role.roleid) WHERE user.username='$username';";
			
  $resultOne = $db->dbCall($queryUser);
}else if($input['type'] == 1){
  $queryUser = "SELECT * FROM surveyTable";
  
  $resultOne = $db->dbCall($queryUser);
}else if($input['type'] == 2){
  $userEmail = $input['email'];
  $userMajor = $input['major'];
  $userGrade = $input['grade'];
  $userPizza = $input['pizza'];

  $query = "INSERT INTO surveytable(submittime, email, major, grade, pizzatype) VALUES(NOW(), '$userEmail', '$userMajor', '$userGrade', '$userPizza');";
  
  $resultTwo = $db->dbCall($query);
  
  $resultOne = "submitted";
}else if($input['type'] == 3){
  $search = $input['search'];
	
  $search = strtolower($search);

  $query = "SELECT  id, artist, album, link FROM albuminfo WHERE LOWER(id) = '$search' OR LOWER(artist) = '$search' OR LOWER(album) = '$search'";

  $resultOne = $db->dbCall($query);
  
  var_dump($resultOne);
}

$queryType = array(
  "login" => "0",
  "survey" => "1",
  "search" => "2"
);

/*if(array_key_exists($input->login,$queryType){
	
}*/

/*if (!array_key_exists($input->type,$queryType)) {
  print json_encode(array("result" => array("ErrorMessage" => "Type doesn't exist")));
  exit;
}*/

/*  Step 6:  Create output.  */
print json_encode($resultOne);
