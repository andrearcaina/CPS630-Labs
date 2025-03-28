<?php
session_start();
include '../config/db.php';

header('Content-Type: application/json');

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

$response = ['status' => 'error', 'message' => 'Invalid action'];

switch ($action) {
    case 'insert':
        $table = $_POST['table'];
        $fields = $_POST['fields'];

        $columns = implode(", ", array_keys($fields));
        $values = implode("', '", array_map(function($value) use ($conn) {
            return $conn->real_escape_string($value);
        }, array_values($fields)));

        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        if ($conn->query($sql) === TRUE) {
            $response = ['status' => 'success', 'message' => 'Record inserted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error inserting record: ' . $conn->error];
        }
        break;
    case 'delete':
        $table = $_POST['table'];
        $id = $_POST['id'];
        $id_column = $_POST['id_column'];

        $sql = "DELETE FROM $table WHERE $id_column = $id";
        if ($conn->query($sql) === TRUE) {
            $response = ['status' => 'success', 'message' => 'Record deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting record: ' . $conn->error];
        }
        break;
    case 'update':
        $table = $_POST['table'];
        $id = $_POST['id'];
        $id_column = $_POST['id_column'];
        $column = $_POST['column'];
        $value = $conn->real_escape_string($_POST['value']);

        $sql = "UPDATE $table SET $column = '$value' WHERE $id_column = $id";
        if ($conn->query($sql) === TRUE) {
            $response = ['status' => 'success', 'message' => 'Record updated successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error updating record: ' . $conn->error];
        }
        break;
    case 'select':
        $table = $_GET['table'];
        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $response = ['status' => 'success', 'data' => $data];
        } else {
            $response = ['status' => 'error', 'message' => 'No records found'];
        }
        break;
    default:
        $response = ['status' => 'error', 'message' => 'Invalid action'];
        break;
}

$conn->close();
echo json_encode($response);
?>
