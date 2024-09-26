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
        border: 3px solid #ddd; /* Add border to the entire table */
        font-family: Arial, sans-serif; /* Similar font to Arial */
        font-size: 17px;
        
      }
      th,
      td {
        padding: 10px;
        text-align: center;
       
      }
      th {
        background-color: #f2f2f2; /* Light grey header background */
        border-bottom: 3px solid #ddd; /* Add bottom border to headers */
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

         <a href="" class="logo">Tech<span>Clinica.</span></a>

         <nav class="nav">
         
            <a href="admin_logs.php">Logs</a>
            <a href="admin_dashboard.php">Appointments</a>
            <a href="Appointment_reports.php">Reports</a>
         </nav>

         <a href="login.php" class="link-btn" name="logout">Log out</a>
         
         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

</body>

<?php
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
$Waiting = 'Waiting For Approval';
$sql = "SELECT appointment_id, appointment_user, appointment_date, appointment_status FROM appointment_table WHERE appointment_status='$Waiting'";
$result = $conn->query($sql);

// Display table
if ($result->num_rows > 0) {
    echo "<table border='5'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['appointment_id']."</td>
                <td>".$row['appointment_user']."</td>
                <td>".$row['appointment_date']."</td>
                <td>".$row['appointment_status']."</td>
                <td>";

        // Display Approve button if appointment is pending
        if($row['appointment_status'] === 'Approved!'){
            echo "<button disabled>Already Approved</button>";
        }else{
            echo "<div class='con'><form action='approve-appointment.php' method='POST' onsubmit='return confirmApproval(\"".$row['appointment_user']."\")'>
            <input type='hidden' name='appointment_id' value='".$row['appointment_id']."'>
            <input type='submit' value='Approve'>
            <br>
          </form><form action='decline_appointment.php' method='POST' onsubmit='return declineApproval(\"".$row['appointment_user']."\")'>
            <input type='hidden' name='appointment_id' value='".$row['appointment_id']."'>
            <input type='submit' value='Decline'>
          </form>
           
           </div>
           
         
          ";


echo "</td></tr>";

        }
           
    }

    echo "</table>";
} else {
    echo "No appointments found.";
}





if (isset($_POST['logout'])) {
  session_destroy();
}else if (isset($_POST['decline']))
// Close connection
$conn->close();

?>
<script>
    function confirmApproval(appointmentUser) {
        return confirm("Are you sure you want to approve the appointment of " + appointmentUser + "?");
    }function declineApproval(appointmentUser) {
        return confirm("Are you sure you want to Decline the appointment of " + appointmentUser + "?");
    }
</script>




</html>