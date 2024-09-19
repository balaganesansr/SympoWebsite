<?php
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required fields are set
    if (isset($_POST['email'], $_POST['teamName'], $_POST['mobileNumber'], $_POST['collegeName'])) {
        $email = $_POST['email'];
        $phone = $_POST['mobileNumber'];
        $collegeName = $_POST['collegeName'];
        $teamName = $_POST['teamName'];
        $teamLeader = $_POST['teamLeader'];
        $memberTwo = isset($_POST['memberTwo']) ? $_POST['memberTwo'] : null;
        $memberThree = isset($_POST['memberThree']) ? $_POST['memberThree'] : null;

        // Event checkbox values
        $colloquium = isset($_POST['colloquium']) ? $_POST['colloquium'] : null;
        $quaestium = isset($_POST['quaestium']) ? $_POST['quaestium'] : null;
        $algotium = isset($_POST['algotium']) ? $_POST['algotium'] : null;
        $innovarium = isset($_POST['innovarium']) ? $_POST['innovarium'] : null;
        $designium = isset($_POST['designium']) ? $_POST['designium'] : null;
        $blendarium = isset($_POST['blendarium']) ? $_POST['blendarium'] : null;

        // Database connection variables
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "techquest24";

        // Create a new MySQLi connection
        $conn = new mysqli($servername, $username, $password, $dbName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // FTP file upload
            $ftp_server = "ftp.mzcet.in";
            $ftp_username = "techquest23@mzcet.in";
            $ftp_password = "Volume@3908";
            $ftp_directory = "/files/";

            // Ensure the file input is set and not empty
            if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['fileToUpload']['name'];
                $file_temp = $_FILES['fileToUpload']['tmp_name'];
                $remote_file = $ftp_directory . $email . '_' . $file_name;

                // Connect to FTP server
                $ftp_conn = ftp_connect($ftp_server);
                $login_result = ftp_login($ftp_conn, $ftp_username, $ftp_password);
                ftp_pasv($ftp_conn, true);

                if ($ftp_conn && $login_result) {
                    // Upload the file
                    if (ftp_put($ftp_conn, $remote_file, $file_temp, FTP_BINARY)) {
                        // Set the screenshot value to the remote file path
                        $screenshot_value = $remote_file;
                    } else {
                        echo "File upload failed.";
                        // Set the screenshot value to NULL
                        $screenshot_value = null;
                    }

                    // Close the FTP connection
                    ftp_close($ftp_conn);
                } else {
                    echo "FTP connection failed.";
                    // Set the screenshot value to NULL
                    $screenshot_value = null;
                }
            } else {
                echo "No file uploaded or upload error.";
                $screenshot_value = null;
            }

            // Prepare SQL queries
            $Select = "SELECT email FROM registrations WHERE email = ?";
            $Insert = "INSERT INTO registrations (teamName, teamLeader, memberTwo, memberThree, email, mobileNumber, collegeName, colloquium, quaestium, algotium, innovarium, designium, blendarium, screenshot, registration_date) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param(
                    "ssssssssssssss",
                    $teamName,
                    $teamLeader,
                    $memberTwo,
                    $memberThree,
                    $email,
                    $phone,
                    $collegeName,
                    $colloquium,
                    $quaestium,
                    $algotium,
                    $innovarium,
                    $designium,
                    $blendarium,
                    $screenshot_value
                );

                if ($stmt->execute()) {
                    header('Location: success.html');
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                header('Location: alreadyRegistered.html');
                exit();
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All required fields must be filled.";
        die();
    }
} else {
    header('Location: error.html');
    exit();
}
?>
