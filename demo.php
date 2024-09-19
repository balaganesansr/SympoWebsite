<?php
// Allow cross-origin requests (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

// Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "techquest24";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(array("message" => "Database connection failed."));
    exit();
}

// Define the SQL query to fetch data from the `registrations` table
$sql = "SELECT * FROM registrations";

// Execute the query
$result = $conn->query($sql);

// Check if any records were returned
if ($result->num_rows > 0) {
    $registrations = array();

    // Fetch each row and add it to the registrations array
    while ($row = $result->fetch_assoc()) {
        $registrations[] = $row;
    }

    // Return the data as JSON
    echo json_encode($registrations);

} else {
    // If no records are found
    echo json_encode(array("message" => "No registrations found."));
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Close the connection
$conn->close();
?>
