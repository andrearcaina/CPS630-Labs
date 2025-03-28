<?php
session_start();
include '../config/db.php';
include '../config/cors.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$action = isset($input['action']) ? $input['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

$response = ['status' => 'error', 'message' => 'Invalid action'];

switch ($action) {
    case 'insert':
        $table = isset($input['table']) ? $input['table'] : '';
        $fields = isset($input['fields']) ? $input['fields'] : [];

        if (empty($table) || empty($fields)) {
            $response = ['status' => 'error', 'message' => 'Table name or fields are missing'];
            break;
        }

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
        $table = isset($input['table']) ? $input['table'] : '';
        $record = isset($input['record']) ? $input['record'] : [];

        if (empty($table) || empty($record)) {
            $response = ['status' => 'error', 'message' => 'Table name or record data is missing'];
            break;
        }

        $whereClauses = [];
        foreach ($record as $key => $value) {
            $whereClauses[] = "$key = '" . $conn->real_escape_string($value) . "'";
        }
        $whereClause = implode(" AND ", $whereClauses);

        $sql = "DELETE FROM $table WHERE $whereClause";
        if ($conn->query($sql) === TRUE) {
            $response = ['status' => 'success', 'message' => 'Record deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error deleting record: ' . $conn->error];
        }
        break;
    case 'update':
        $table = isset($input['table']) ? $input['table'] : '';
        $record = isset($input['record']) ? $input['record'] : [];
        $column = isset($input['column']) ? $input['column'] : '';
        $value = isset($input['value']) ? $conn->real_escape_string($input['value']) : '';

        if (empty($table) || empty($record) || empty($column)) {
            $response = ['status' => 'error', 'message' => 'Missing required parameters'];
            break;
        }

        $whereClauses = [];
        foreach ($record as $key => $val) {
            if ($key !== $column) { // Exclude the column being updated
                $whereClauses[] = "$key = '" . $conn->real_escape_string($val) . "'";
            }
        }
        $whereClause = implode(" AND ", $whereClauses);

        $sql = "UPDATE $table SET $column = '$value' WHERE $whereClause";

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
