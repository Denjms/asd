<?php
session_start();
$name= $_SESSION['fullname'];
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection parameters
    $host = 'localhost';
    $dbname = 'techclinica';
    $username = 'root';
    $password = 'admin';
    // Create MySQLi object
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    function generateReferenceNumber($length = 8) {
        $characters = '0123456789';
        $refNumber = '';
    
        for ($i = 0; $i < $length; $i++) {
            $refNumber .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $refNumber;
    }
    
    // Generate a reference number with default length (8 characters)
    $reference = generateReferenceNumber(20);
    $currentDateTime = date('Y-m-d H:i:s');
    $appointment_id = $_POST['appointment_id'];
    $status= "Declined";
    $stmt = $conn->prepare("UPDATE appointment_table SET appointment_status = ? WHERE appointment_id = ?");
    $stmt1=$conn->prepare( "INSERT INTO logs (reference_number, time_approved,appoint_status ,admin_name) VALUES ('$reference', '$currentDateTime','$status', '$name')");
    $stmt->bind_param("si", $status, $appointment_id);
    $stmt->execute();
    $stmt1->execute();


    // Execute update
    if ($stmt->execute()) {
        // Redirect back to view-appointments.php
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating appointment: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

   

} else {
    die("Method not allowed");
}
?>