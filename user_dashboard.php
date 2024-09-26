<?php
session_start();
$name= $_SESSION['fullname'];


?>

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

</head>
<body>

<!-- header section starts  -->

<header class="header fixed-top">

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="user_dashboard.php" class="logo">Tech<span>Clinica.</span></a>

         <nav class="nav">
            <a href="user_dashboard.php#home">Home</a>
          
              <a href="user_dashboard.php#contact"> Appointment</a>
           
            <a href="user_status.php">Status</a>
         </nav>

         <a href="login.php" class="link-btn" name="logout">Log out</a>
         
         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

   <div class="container">

      <div class="row min-vh-100 align-items-center">
         <div class="content text-center text-md-left">
            <h3>Allow us to make your smile brighter.</h3>
            <p>DentalClinic Can Help You Get the Smile You've Always Wanted. We offer cosmetic dentistry, root canal therapy, cavity inspections, and more.</p>
            <a href="#contact" class="link-btn">Make an Appointment</a>
           
         </div>
      </div>

   </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<!-- about section ends -->

<!-- services section starts  -->

<section class="services" id="services">

   <h1 class="heading">our services</h1>

   <div class="box-container container">

      <div class="box">
         <img src="images/icon-1.svg" alt="">
         <h3>Alignment specialist</h3>
      </div>

      <div class="box">
         <img src="images/icon-2.svg" alt="">
         <h3>Cosmetic dentistry</h3>
      </div>

      <div class="box">
         <img src="images/icon-3.svg" alt="">
         <h3>Oral hygiene experts</h3>
      </div>

      <div class="box">
         <img src="images/icon-4.svg" alt="">
         <h3>Root canal specialist</h3>
      </div>

      <div class="box">
         <img src="images/icon-5.svg" alt="">
         <h3>Live dental advisory</h3>
      </div>

      <div class="box">
         <img src="images/icon-6.svg" alt="">
         <h3>Cavity inspection</h3>
      </div>

   </div>

</section>

<!-- services section ends -->

<!-- process section starts  -->

<section class="process">

   <h1 class="heading">work process</h1>

   <div class="box-container container">

      <div class="box">
         <img src="images/process-1.png" alt="">
         <h3>Cosmetic Dentistry</h3>
         <p>Cosmetic dentistry includes teeth whitening, dental implants, dental crowns, and teeth shaping.</p>
      </div>

      <div class="box">
         <img src="images/process-2.png" alt="">
         <h3>Pediatric Dentistry</h3>
         <p>Padiatric dentistry include stainless steel crowns, tooth-colored fillings, dental cleanings, and cavities.</p>
      </div>

      <div class="box">
         <img src="images/process-3.png" alt="">
         <h3>Dental Implants</h3>
         <p>Dental implants are artificial tooth roots that are surgically placed into the jawbone.</p>
      </div>

   </div>

</section>

<!-- process section ends -->

<!-- reviews section starts  -->


<!-- reviews section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

   <h1 class="heading">make appointment</h1>

   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <!--<?php
         if(isset($message)){
            foreach($message as $message){
               echo '<p class="message">'.$message.'</p>';
            }
         }
      ?>-->
      <span>Enter your name :</span>
      <input type="text" name="name" placeholder="<?php echo $name?>" value="<?php echo $name?>"  class="box" disabled>
      <span>Enter your email :</span>
      <input type="email" name="email" placeholder="Enter your email" class="box" required>
      <span>Enter your number :</span>
      <input type="number" name="number" placeholder="Enter your number" class="box" required>
      <span>Enter appointment date :</span>
      <input type="datetime-local" name="date" class="box" required>
      <input type="submit" value="make appointment" name="submit" class="link-btn">
   </form>

</section>

<!-- contact section ends -->

<!-- footer section starts  -->


<!-- footer section ends -->










<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>




<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = 'admin';
$dbname = "techclinica";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {

   $appointment_datetime = $_POST['date'];
   $sql = "SELECT COUNT(*) as count FROM appointment_table WHERE appointment_date = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $appointment_datetime);
   $stmt->execute();
   $stmt->bind_result($count);
   $stmt->fetch();
   $stmt->close();
   if ($count > 0) {
      $message = "Sorry, the selected appointment slot is already booked. Please choose another time.";
      echo "<script type='text/javascript'>alert('$message');</script>";
  } elseif (isset($_POST['logout']))  {
   session_destroy();
  }
  
  else {

    // Sanitize input data
    $name= $_SESSION['fullname'];
    $fullname = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $status= "Waiting for approval";

  

    // Prepare SQL query
    $sql = "INSERT INTO appointment_table (appointment_user, appointment_email, appointment_number,appointment_date,appointment_status) VALUES ('$name', '$username', '$number','$date','$status')";

    if ($conn->query($sql) === TRUE) {
      $message = "Appointment is added, wait for the approval";
      echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
  }
   

// Handle form submission


// Close connection
$conn->close();
?>
