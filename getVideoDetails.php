<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once 'db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["id"])) {
    $pid = $_GET['id'];
 
    // get a product from products table
    $result = mysql_query("SELECT *FROM bankdetails WHERE id = $id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $bankdetails= array();
            $bankdetails["id"] = $result["id"];
            $bankdetails["name"] = $result["name"];
            $bankdetails["amount"] = $result["amount"];
            
            // success
            $response["success"] = 1;
 
            // user node
            $response["bankdetails"] = array();
 
            array_push($response["bankdetails"], $bankdetails);
 
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
        // no product found
        $response["success"] = 0;
        $response["message"] = "No Datafound";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>