<?php
header("Content-Type: application/json; charset=UTF-8");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data from POST request
    $teamName = isset($_POST['teamName']) ? $_POST['teamName'] : null;
    $teamLeader = isset($_POST['leader']) ? $_POST['leader'] : null;
    $memberTwo = isset($_POST['memberTwo']) ? $_POST['memberTwo'] : null;
    $memberThree = isset($_POST['memberThree']) ? $_POST['memberThree'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $mobileNumber = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : null;
    $collegeName = isset($_POST['collegeName']) ? $_POST['collegeName'] : null;

    // Checkbox values
    $colloquium = isset($_POST['colloquium']) ? 1 : 0;
    $quaestium = isset($_POST['quaestium']) ? 1 : 0;
    $algotium = isset($_POST['algotium']) ? 1 : 0;
    $innovarium = isset($_POST['innovarium']) ? 1 : 0;
    $designium = isset($_POST['designium']) ? 1 : 0;
    $blendarium = isset($_POST['blendarium']) ? 1 : 0;

    // Handle file upload
    $screenshot = isset($_FILES['payment-screenshot']) ? $_FILES['payment-screenshot']['name'] : null;

    // Create an associative array with the form data
    $response = array(
        "teamName" => $teamName,
        "teamLeader" => $teamLeader,
        "memberTwo" => $memberTwo,
        "memberThree" => $memberThree,
        "email" => $email,
        "mobileNumber" => $mobileNumber,
        "collegeName" => $collegeName,
        "colloquium" => $colloquium,
        "quaestium" => $quaestium,
        "algotium" => $algotium,
        "innovarium" => $innovarium,
        "designium" => $designium,
        "blendarium" => $blendarium,
        "screenshot" => $screenshot
    );

    // Output the data in JSON format
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error message
    echo json_encode(array("error" => "Invalid request method."));
}
?>
