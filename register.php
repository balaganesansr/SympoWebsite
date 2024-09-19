<?php

$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "techquest";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamName = $_POST['teamName'];
    $collegeName = $_POST['collegeName'];
    $leader = $_POST['leader'];
    $memberTwo = isset($_POST['memberTwo']) ? $_POST['memberTwo'] : null;
    $memberThree = isset($_POST['memberThree']) ? $_POST['memberThree'] : null;
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];

    $colloquium = isset($_POST['colloquium']) ? 1 : 0;
    $quaestium = isset($_POST['quaestium']) ? 1 : 0;
    $algotium = isset($_POST['algotium']) ? 1 : 0;
    $innovarium = isset($_POST['innovarium']) ? 1 : 0;
    $designium = isset($_POST['designium']) ? 1 : 0;
    $blendarium = isset($_POST['blendarium']) ? 1 : 0;
 
    $paymentScreenshot = $_FILES['payment-screenshot']['name'];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($paymentScreenshot);
    
    if (move_uploaded_file($_FILES['payment-screenshot']['tmp_name'], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO registrations (teamName, collegeName, leader, memberTwo, memberThree, email, mobileNumber, colloquium, quaestium, algotium, innovarium, designium, blendarium, paymentScreenshot) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiiiiiiiis", $teamName, $collegeName, $leader, $memberTwo, $memberThree, $email, $mobileNumber, $colloquium, $quaestium, $algotium, $innovarium, $designium, $blendarium, $targetFile);
        
        if ($stmt->execute()) {
            header("Location: success.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
