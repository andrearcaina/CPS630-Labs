<?php
session_start();
include '../database/config.php';

header('Content-Type: application/json');

$response = array('redirect' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["signup"])) {
        // Signup logic
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $dob = $_POST["dob"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telno = $_POST["telno"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $postalcode = $_POST["postalcode"];
        $balance = 0.00;

        $sql = "SELECT * FROM USERS WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO USERS(FirstName, LastName, Email, DOB, Pass, TelNo, Address, City, PostalCode, Balance) 
                    VALUES('$fname','$lname','$email','$dob','$password', '$telno', '$address', '$city', '$postalcode', $balance)";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $_SESSION["error"] = "Successfully Created Account, Please Log in with your credentials now.";
                $response['redirect'] = '../pages/signin.php';
            } else {
                $_SESSION["error"] = "Something went wrong, please try again.";
                $response['redirect'] = '../pages/signup.php';
            }
        } else {
            $_SESSION["error"] = "There already exists an account with that email. Please Sign In or try again with a different email";
            $response['redirect'] = '../pages/signup.php';
        }
    } elseif (isset($_POST["signin"])) {
        // Signin logic
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM USERS WHERE Email='$email' AND Pass='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $_SESSION["error"] = "Invalid Email or Password. Please try again.";
            $response['redirect'] = '../pages/signin.php';
        } else {
            $row = $result->fetch_assoc();
            $_SESSION["email"] = $email;
            $_SESSION["fname"] = $row["FirstName"];
            $_SESSION["lname"] = $row["LastName"];
            $_SESSION["user_id"] = $row["UserID"];
            $_SESSION["city"] = $row["City"];
            $response['redirect'] = '../index.php';
        }
    }
}

$conn->close();
echo json_encode($response);
?>
