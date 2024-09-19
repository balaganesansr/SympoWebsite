<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Email'], $_POST['TeamName'], $_POST['Mobile_No'], $_POST['collegename'])) {
        $Email = $_POST['Email'];
        $Phone = $_POST['Mobile_No'];
        $colg = $_POST['collegename'];
        $TeamName = $_POST['TeamName'];
        $TeamLeader = $_POST['TeamLeader'];
        $MemberOne = $_POST['Memberone'];
        $MemberTwo = $_POST['MemberTwo'];
        $KnowledgeBowl = isset($_POST['Knowlegde_Bowl']) ? $_POST['Knowlegde_Bowl'] : null;
        $Quizardry = isset($_POST['Quizardry']) ? $_POST['Quizardry'] : null;
        $TechVein = isset($_POST['Tech_vein']) ? $_POST['Tech_vein'] : null;
        $DesignUp = isset($_POST['Design_up']) ? $_POST['Design_up'] : null;
        $CodeLog = isset($_POST['CodeLog']) ? $_POST['CodeLog'] : null;
        
        $servername = "www.mzcet.in";
        $username = "mzcetin1_techquest22";
        $password = "Possible@123";
        $dbName = "mzcetin1_techquest22";
        
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

            $file_name = $_FILES['fileToUpload']['name'];
            $file_temp = $_FILES['fileToUpload']['tmp_name'];
            $remote_file = $ftp_directory . $Email . '_' . $file_name;
            // Connect to FTP server
            $ftp_conn = ftp_connect($ftp_server);
            $login_result = ftp_login($ftp_conn, $ftp_username, $ftp_password);
            ftp_pasv($conn_id, true);
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

            $Select = "SELECT Email FROM studentregestration WHERE Email = ?";
            $Insert = "INSERT INTO studentregestration (TeamName, TeamLeader, Memberone, MemberTwo, Email, Mobile_No, Knowlegde_Bowl, Quizardry, Tech_vein, Design_up, CodeLog, CollegeName, ScreenShot) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
   
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
   
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param(
                    "sssssssssssss",
                    $TeamName,
                    $TeamLeader,
                    $MemberOne,
                    $MemberTwo,
                    $Email,
                    $Phone,
                    $KnowledgeBowl,
                    $Quizardry,
                    $TechVein,
                    $DesignUp,
                    $CodeLog,
                    $colg,
                    $screenshot_value // Use the screenshot value here
                );
       
                if ($stmt->execute()) {
                    header('Location: Successfull.html');
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            } else {
                header('Location: someone.html');
                exit();
            }
   
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All fields are required.";
        die();
    }
} else {
    header('Location: Error.html');
    exit();
}
?>
