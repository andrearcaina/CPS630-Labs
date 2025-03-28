<?php
session_start();
include '../config/db.php';
include '../config/cors.php';

header('Content-Type: application/json');

error_log("Session auth ID: " . session_id());

$response = array('status' => 'error', 'message' => '');
// Read JSON input sent from AngularJS
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

        // Check if the email already exists
        $sql = "SELECT * FROM USERS WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows == 0) {
            // Insert the new user
            $sql = "INSERT INTO USERS(FirstName, LastName, Email, DOB, Pass, TelNo, Address, City, PostalCode, Balance) 
                    VALUES('$fname','$lname','$email','$dob','$password', '$telno', '$address', '$city', '$postalcode', $balance)";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'Successfully signed up. Please log in with your credentials.';
            } else {
                $response['message'] = 'Something went wrong. Please try again.';
            }
        } else {
            $response['message'] = 'An account with this email already exists. Please sign in or use a different email.';
        }
    } elseif (isset($data["signin"])) {
        // Signin logic
        $email = $data["email"];
        $password = $data["password"];

        $sql = "SELECT * FROM USERS WHERE Email='$email' AND Pass='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $response['message'] = 'Invalid email or password. Please try again.';
        } else {
            $row = $result->fetch_assoc();
            $_SESSION["email"] = $email;
            $_SESSION["fname"] = $row["FirstName"];
            $_SESSION["lname"] = $row["LastName"];
            $_SESSION["user_id"] = $row["UserID"];
            $_SESSION["city"] = $row["City"];
            $_SESSION["isAdmin"] = ($row["Email"] === "loquito@admin.com");

            $response['status'] = 'success';
            $response['message'] = 'Successfully logged in.';
        }
    }
}

$conn->close();
echo json_encode($response);
?>