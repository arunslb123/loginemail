<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','us-cdbr-azure-southcentral-e.cloudapp.net');
define('DBUSER','b5e6932691e7ad');
define('DBPASS','431dfc7a');
define('DBNAME','acsm_4729051611eebc5');

//application address
define('DIR','https://aruncheck.azurewebsites.net/');
define('SITEEMAIL','noreply@arunprakash.org');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
