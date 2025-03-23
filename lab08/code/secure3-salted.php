<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password
$dbname = "Lab8_db";
$port = 3307; // Custom port for XAMPP



//Connects to the databse
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



function generateRandomSalt(){
  return base64_encode(random_bytes(12));
}

function insertUser($username,$password){
  $dsn = "mysql:host=localhost;port=3307;dbname=Lab8_db;charset=utf8";
  $pdo = new PDO($dsn, "root", "");
  $salt = generateRandomSalt(); //creates the salt
  $sql = "INSERT INTO users3 (Username,Password,Salt)
           VALUES(?,?,?)";
  $smt = $pdo->prepare($sql);
  $smt->execute(array($username,md5($password.$salt),$salt)); //appends the salt to the password and hashes it
}


//Check if the credentials match a user in the system with MD5 hash
function validateUser($username,$password){
  $dsn = "mysql:host=localhost;port=3307;dbname=Lab8_db;charset=utf8";
  $pdo = new PDO($dsn, "root", "");
  $sql = "SELECT  UserID FROM users2 WHERE  Username=? AND
        Password=?";
  $smt = $pdo->prepare($sql);
  $smt->execute(array($username,md5($password))); //execute the query
  if($smt->rowCount()){
    return true; //record found, return true.
  }
  return false; //record not found matching credentials, return false
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $action = $_POST['action'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($action == "login") {
    //Check if the user is in the system
    if (validateUser($username, $password)) {
      echo "Welcome $username";
    } else {
      echo "Invalid credentials";
    }
  } elseif ($action == "register") {
    //Insert a new user into the database
    insertUser($username, $password);
    echo "User $username registered successfully!";
  }
}

?>
<doctype html>
  <html>

  <head>
    <title>Secure1</title>
  </head>

  <body>
    <h1>Secure3 - Password Encryption with built-in MD5 with Salt (Even More Secure)</h1>

    <a href="index.php">Go to Secure1</a>
    <a href="secure2-md5.php">Go to Secure2</a>



    <h2>Register</h2>
    <form method="post">
      <input type="hidden" name="action" value="register" />
      <label>Enter Username</label>
      <input type="text" name="username" />
      <label>Enter Password</label>
      <input type="password" name="password" />
      <input type="submit" value="Register" />
    </form>

    <h2>Login</h2>
    <form method="post">
      <input type="hidden" name="action" value="login" />
      <label>Enter Username</label>
      <input type="text" name="username" />
      <label>Enter Password</label>
      <input type="password" name="password" />
      <input type="submit" value="login" />
    </form>

</doctype>



