<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechClinica</title>
   <link rel="stylesheet" href="style.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   
   <link rel="icon" href="images/favicon.png"/>
   <style>
    
      table {
        border-collapse: collapse;
        width: 75%;
        border: 1px solid #ddd; /* Add border to the entire table */
        font-family: Arial, sans-serif; /* Similar font to Arial */
        font-size: 17px;
      }
      th,
      td {
        padding: 10px;
        text-align: center;
      }
      th {
        background-color: #009EFF; /* Light grey header background */
        border-bottom: 1px solid #ddd; /* Add bottom border to headers */
      }
      tr:nth-child(even) {
        background-color: #f9f9f9; /* Lighter even row color */
      }
      input {
        background-color: #007bff; /* Blue button color */
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
      }
      button{
        background-color: #39e366; /* Blue button color */
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
      }
    </style>
</head>

<body>

<!-- header section starts  -->

<header class="header fixed-top">

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="user_dashboard.php" class="logo">Tech<span>Clinica.</span></a>

         <nav class="nav">
           
            <a href="admin_logs">Logs</a>
            <a href="admin_dashboard.php">Appointments</a>
            <a href="Appointment_reports.php">Reports</a>
         </nav>

         <a href="login.php" class="link-btn">Log out</a>
         
         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

</body>

<?php
session_start();

$name = $_SESSION['fullname'];
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

// Query to fetch appointments
$sql = "SELECT reference_number , time_approved, appoint_status, admin_name FROM logs";
$result = $conn->query($sql);

// Display table
if ($result->num_rows > 0) {
    echo "<table border='5'>
            <tr>
              
                <th>Reference Number</th>
                <th>Date</th>
                <th>status</th>
                <th>admin</th>
              
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                
                <td>".$row['reference_number']."</td>
                <td>".$row['time_approved']."</td>
                <td>".$row['appoint_status']."</td>
                 <td>".$row['admin_name']."</td>
                ";

        // Display Approve button if appointment is pending
           
    }

    echo "</tr></table>";
} else {
    echo "No appointments found.";
}

// Close connection
$conn->close();
?>
<script>
    function confirmApproval(appointmentId) {
        return confirm("Are you sure you want to approve appointment ID " + appointmentId + "?");
    }
</script>




</html>