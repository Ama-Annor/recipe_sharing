<?php
require_once '../db/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get JSON data from request
$data = json_decode(file_get_contents('php://input'), true);

// Log received data for debugging
error_log("Received data: " . print_r($data, true));

if (isset($data['user_id'], $data['name'], $data['email'])) {
    // Split the full name into first and last name
    $nameParts = explode(" ", $data['name'], 2);
    $fname = $nameParts[0];
    $lname = isset($nameParts[1]) ? $nameParts[1] : '';
    
    // First check if email already exists for a different user
    $check_email = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
    if (!$check_email) {
        echo json_encode(['success' => false, 'error' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    
    $check_email->bind_param("si", $data['email'], $data['user_id']);
    $check_email->execute();
    $result = $check_email->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Email already exists']);
        exit;
    }
    
    // Update user information
    $stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, updated_at = CURRENT_TIMESTAMP WHERE user_id = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("sssi", $fname, $lname, $data['email'], $data['user_id']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Update failed: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Missing required data']);
}
?>