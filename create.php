<?php
// Database connection variables
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbName = "techquest24";
$servername = "www.mzcet.in";
$username = "mzcetin1_techquest22";
$password = "Possible@123";
$dbName = "mzcetin1_techquest22";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the studentregistration table
$sql = "CREATE TABLE IF NOT EXISTS studentregistration (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    teamName VARCHAR(255) NOT NULL,
    teamLeader VARCHAR(255) NOT NULL,
    memberTwo VARCHAR(255) NULL,
    memberThree VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mobileNumber VARCHAR(255) NOT NULL,
    collegeName VARCHAR(255) NOT NULL,
    colloquium VARCHAR(255) NULL,
    quaestium VARCHAR(255) NULL,
    algotium VARCHAR(255) NULL,
    innovarium VARCHAR(255) NULL,
    designium VARCHAR(255) NULL,
    blendarium VARCHAR(255) NULL,
    screenshot VARCHAR(255) NULL,
    registration_date VARCHAR(255) NULL
)";

// Execute the query and check if the table was created
if ($conn->query($sql) === TRUE) {
    echo "Table studentregistration created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
