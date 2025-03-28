<?php
session_start();
include '../database/config.php';

header('Content-Type: application/json');

$response = array('redirect' => '');
//Read JSON input sent from angularJS
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($data["signup"])) {
        // Signup logic
        $fname = $data["fname"];
        $lname = $data["lname"];
        $dob = $data["dob"];
        $email = $data["email"];
        $password = $data["password"];
        $telno = $data["telno"];
        $address = $data["address"];
        $city = $data["city"];
        $postalcode = $data["postalcode"];
        $balance = 0.00;

        $sql = "SELECT * FROM USERS WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO USERS(FirstName, LastName, Email, DOB, Pass, TelNo, Address, City, PostalCode, Balance) 
                    VALUES('$fname','$lname','$email','$dob','$password', '$telno', '$address', '$city', '$postalcode', $balance)";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $_SESSION["error"] = "Successfully Created Account, Please Log in with your credentials now.";
                $response['redirect'] = '../pages/signin.html';
            } else {
                $_SESSION["error"] = "Something went wrong, please try again.";
                $response['redirect'] = '../pages/signup.html';
            }
        } else {
            $_SESSION["error"] = "There already exists an account with that email. Please Sign In or try again with a different email";
            $response['redirect'] = '../pages/signup.html';
        }
    } elseif (isset($data["signin"])) {
        // Signin logic
        $email = $data["email"];
        $password = $data["password"];

        $sql = "SELECT * FROM USERS WHERE Email='$email' AND Pass='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $_SESSION["error"] = "Invalid Email or Password. Please try again.";
            $response['redirect'] = '../pages/signin.html';
        } else {
            $row = $result->fetch_assoc();
            $_SESSION["email"] = $email;
            $_SESSION["fname"] = $row["FirstName"];
            $_SESSION["lname"] = $row["LastName"];
            $_SESSION["user_id"] = $row["UserID"];
            $_SESSION["city"] = $row["City"];
            $response['redirect'] = '../index.html';
        }
    }
}

$conn->close();
echo json_encode($response);
?>