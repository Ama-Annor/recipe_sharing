<?php
require_once '../db/config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get JSON data from request
$data = json_decode(file_get_contents('php://input'), true);

// Log received data for debugging
error_log("Delete request received for user_id: " . print_r($data, true));

if (isset($data['user_id'])) {
    // First check if this is not the last admin
    $check_admin = $conn->prepare("SELECT COUNT(*) as admin_count FROM users WHERE role IN (1, 2)");
    if (!$check_admin) {
        echo json_encode(['success' => false, 'error' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    
    $check_admin->execute();
    $admin_result = $check_admin->get_result();
    $admin_count = $admin_result->fetch_assoc()['admin_count'];

    $check_user = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
    if (!$check_user) {
        echo json_encode(['success' => false, 'error' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    
    $check_user->bind_param("i", $data['user_id']);
    $check_user->execute();
    $user_result = $check_user->get_result();
    $user_role = $user_result->fetch_assoc()['role'];

    if ($admin_count <= 1 && ($user_role == 1 || $user_role == 2)) {
        echo json_encode(['success' => false, 'error' => 'Cannot delete the last administrator']);
        exit;
    }

    // Proceed with deletion
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("i", $data['user_id']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Delete failed: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'No user ID provided']);
}
?>