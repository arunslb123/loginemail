
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("au-cdbr-azure-east-a.cloudapp.net", "b2c31362b2eda6", "ff62019c", "acsm_832eae7fe45825a");

$result = $conn->query("SELECT F_Name, Scientific_Name, Season  FROM flowers_info");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Name":"'  . $rs["F_Name"] . '",';
    $outp .= '"Scientific_Name":"'   . $rs["Scientific_Name"]        . '",';
    $outp .= '"Season ":"'. $rs["Season "]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>