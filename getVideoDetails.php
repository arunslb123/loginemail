<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require('includes/config.php');

echo "in file";
 

 
// check for post data
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "check";
    echo $username;
 
    // get a product from products table
 //select url,description,duration from urls where userName='arun';

    $result = db->prepare('SELECT url, description, duration FROM urls WHERE userName = :username');
			$result->execute(array('username' => $username));
 
    if (!empty($result)) {

    	echo "result is not empty";
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $urldetails= array();
            $urldetails["url"] = $result["url"];
            $urldetails["description"] = $result["description"];
            $urldetails["duration"] = $result["duration"];
            
            // success
            $response["success"] = 1;
 
            // user node
            $response["urldetails"] = array();
 
            array_push($response["urldetails"], $urldetails);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No Datafound";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
    	echo "line 59 else";
        // no product found
        $response["success"] = 0;
        $response["message"] = "No Datafound";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing

    echo "line 70 else";
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>