<?php
require_once __DIR__ . '/utils/error_config.php';
include_once '../db/config.php';
session_start();

//Check if user has permission
if (!isset($_SESSION['user_id']) || $_SESSION['role'] > 2) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

//Delete user
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    //Prevent deleting own account
    if ($user_id == $_SESSION['user_id']) {
        echo json_encode(['status' => 'error', 'message' => 'Cannot delete your own account']);
        exit();
    }

    //Check if user exists
    $check_sql = "SELECT role FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Prevent non-super-admin from deleting admins
        if ($_SESSION['role'] > 2) {
            echo json_encode(['status' => 'error', 'message' => 'Cannot delete admin accounts']);
            exit();
        }

        $delete_sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $delete_sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting user']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
}
exit();
?>
