<?php
//  header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response

 
// include db connect class
require('includes/config.php');

echo "in file";

$row = array();
 

 
// check for post data
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "check";
    echo $username;
 
    // get a product from products table
 //select url,description,duration from urls where userName='arun';
try{


    $result = $db->prepare('SELECT url, description, duration FROM urls where userName = :username');
			$result->execute(array('username' => $username));
			$row = $result->fetch(PDO::FETCH_ASSOC);


}

			catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
 
    if (!empty($row)) {

    	echo "result is not empty";
        // check for empty result
        if (mysql_num_rows($row) > 0) {
 
            //$result = mysql_fetch_array($result);
 
            $urldetails= array();
            $urldetails["url"] = $row["url"];
            $urldetails["description"] = $row["description"];
            $urldetails["duration"] = $row["duration"];
            
            // success
            $row["success"] = 1;
 
            // user node
            $row["urldetails"] = array();
 
            array_push($row["urldetails"], $urldetails);
 
            // echoing JSON response
            echo json_encode($row);
        } else {
            // no product found
            $row["success"] = 0;
            $row["message"] = "No Datafound";
 
            // echo no users JSON
            echo json_encode($row);
        }
    } else {
    	echo "line 59 else";
        // no product found
        $row["success"] = 0;
        $row["message"] = "No Datafound";
 
        // echo no users JSON
        echo json_encode($row);
    }
} else {
    // required field is missing

    echo "line 70 else";
    $row["success"] = 0;
    $row["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($row);
}
?>