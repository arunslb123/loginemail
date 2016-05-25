<?php
 header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response

 
// include db connect class
require('includes/config.php');




 

 
// check for post data
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

 
    // get a product from products table
 //select url,description,duration from urls where userName='arun';
try{




   //  $result = $db->prepare('SELECT url, description, duration FROM urls where userName = :username');
			// $result->execute(array('username' => $username));
			//$row = $result->fetch(PDO::FETCH_ASSOC);

			$stmt = $db->prepare("SELECT url,description,duration FROM urls WHERE userName = :username");
		   $stmt->execute(array(':username' => $_SESSION['username']));
		   //$stmt->fetch();
		//echo $stmt;
		//$row = $stmt->fetch(PDO::FETCH_ASSOC);

			
$outputString = "[";

				while($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($outputString != "[") 
     {
     	$outputString .= ",";
     }
    $outputString .= '{"title":"'  . $rs["description"] . '",';
    $outputString .= '"url":"'   . $rs["url"]        . '",';
    $outputString .= '"time":"'. $rs["duration"]     . '"}'; 
}
$outputString .="]";

echo $outputString;

}

			catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
?>