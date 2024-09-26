<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechClinica</title>
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="login-style.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   
   <link rel="icon" href="images/favicon.png"/>

</head>
<body>

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

// Function to encrypt password using Vigenere cipher
function vigenere_encrypt($plaintext, $key) {
    $key = strtoupper($key);
    $keyLen = strlen($key);
    $keyIndex = 0;
    $ciphertext = '';

    // Iterate through each character of the plaintext
    for ($i = 0; $i < strlen($plaintext); $i++) {
        $char = $plaintext[$i];

        if (ctype_alpha($char)) {
            $offset = ord('A');
            $keyChar = $key[$keyIndex % $keyLen];
            $keyIndex++;

            $shift = ord(strtoupper($keyChar)) - $offset;
            $charCode = ord(strtoupper($char)) - $offset;
            $cipherCode = (($charCode + $shift) % 26) + $offset;
            $cipherChar = chr($cipherCode);

            if (ctype_lower($plaintext[$i])) {
                $cipherChar = strtolower($cipherChar);
            }

            $ciphertext .= $cipherChar;
        } else {
            $ciphertext .= $char;
        }
    }

    return $ciphertext;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $fullname = mysqli_real_escape_string($conn, $_POST['full']);
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    // Vigenere cipher key (you can generate a more secure key)
    $vigenereKey = "INFOSEC";

    // Encrypt password
    $encryptedPassword = vigenere_encrypt($password, $vigenereKey);

    // Prepare SQL query
    $sql = "INSERT INTO users (fullname, username, password,role) VALUES ('$fullname', '$username', '$encryptedPassword','patient')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration Successful!.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<!-- header section starts  -->

<header class="header fixed-top">

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="main.php" class="logo">Tech<span>Clinica.</span></a>

        

         <a href="login.php" class="link-btn">Login</a>
         
         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>

<div class="main">
            <h1 class="logo">Tech<span>Clinica.</span></h1>
            <h3>Register</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >

            <label for="first">
                        Fullname
                  </label>
                  <input type="text" 
                         id="full" 
                         name="full" 
                         placeholder="Enter your fullname" required>
                  <label for="first">
                        Username
                  </label>
                  <input type="text" 
                         id="user" 
                         name="user" 
                         placeholder="Enter your Username" required>

                  <label for="pass">
                        Password
                  </label>
                  <input type="password"
                         id="pass" 
                         name="pass"
                         placeholder="Enter your Password" required>
                  <br>
                  <br>
                  <div class="wrap">
                        <button type="submit"
                                name="login">
                             Register  
                        </button>
                  </div>
            </form>
            
      </div>
</body>

</html>

<!-- header section ends -->
