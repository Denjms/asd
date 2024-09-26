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

<!-- header section starts  -->

<header class="header fixed-top">

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="" class="logo">Tech<span>Clinica.</span></a>

         <nav class="nav">
           
         </nav>
         <a href="" class="link-btn">Login</a>
         

         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>
<div class="main">
            <h1 class="logo" >Tech<span>Clinica.</span></h1>
            <h3>Enter your login credentials</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
                  <label for="first">
                        Username
                  </label>
                  <input type="text" 
                         id="username" 
                         name="user" 
                         placeholder="Enter your Username" required>

                  <label for="password">
                        Password
                  </label>
                  <input type="password"
                         id="pass" 
                         name="pass"
                         placeholder="Enter your Password" required>
                    <br>
                  <div class="wrap">
                        <button type="submit"
                                name="login">
                                Login
                              
                        </button>
                  </div>
                  <br>
            </form>
            <p>Not registered?
                  <a href="register.php"
                     style="text-decoration: none;">
                        Create Account
                  </a>
            </p>
      </div>
</body>

<?php
// Database connection parameters
$host = 'localhost'; // or your database host
$dbusername = 'root';
$dbpassword = 'admin';
$dbname = 'techclinica';

// Connect to MySQL database
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

// Check if the form is submitted
if(isset($_POST['login'])) {
    // Retrieve username and password from form submission
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // SQL injection prevention (optional)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $vigenereKey = "INFOSEC";
    $encryptedPassword = vigenere_encrypt($password, $vigenereKey);
  
    
    // Query to fetch user from database
    $sql = "SELECT * FROM users WHERE username='$username' and password = '$encryptedPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role']; 
        $_SESSION['fullname'] = $row['fullname']; 

        if ($row['role'] == 'admin') {
        
            header("Location: admin_dashboard.php");
            
            
        } else {
            
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        // Login failed
       
        $message = "Login failed. Invalid username or password.";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
  
}

// Close database connection
$conn->close();
?>



</html>