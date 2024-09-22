<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");


$servername = "localhost";
$username = "root";
$password = "";
$dbName = "techquest24";


$conn = new mysqli($servername, $username, $password, $dbName);


if ($conn->connect_error) {
    http_response_code(500); 
    echo json_encode(array("message" => "Database connection failed."));
    exit();
}


$sql = "SELECT * FROM registrations";


$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $registrations = array();

    
    while ($row = $result->fetch_assoc()) {
        $registrations[] = $row;
    }

    
    echo json_encode($registrations);

} else {
    
    echo json_encode(array("message" => "No registrations found."));
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$conn->close();
?>
