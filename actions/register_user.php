<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include "../db/config.php";

// Handle Registering of users
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Stage 1: Input Processing
        $fname = trim($_POST['fname'] ?? '');    // Trim whitespace
        $lname = trim($_POST['lname'] ?? '');    // Trim whitespace
        $role = 2;                               // Hardcoded role for security
        $email = trim($_POST['email'] ?? '');    // Trim whitespace
        $password = ($_POST['password'] ?? '');  // Raw password for hashing

        $errors = [];

        // Validate first name
        if (empty($fname) || strlen($fname) > 50) {
            $errors[] = 'invalid_fname';
        }

        // Validate last name
        if (empty($lname) || strlen($lname) > 50) {
            $errors[] = 'invalid_lname';
        }

        // Validate email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'invalid_email';
        }

        // Validate password (uncommented for security)
        if (empty($password) || strlen($password) < 8) {
            $errors[] = 'weak_password';
        }

        // If there are validation errors, redirect back with error message
        if (!empty($errors)) {
            header('Location: ../view/register.php?msg=' . implode(',', $errors));
            exit();
        }

        // Stage 2: Check if email already exists
        $check_stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows > 0) {
            header('Location: ../view/register.php?msg=email_exists');
            exit();
        }
        $check_stmt->close();

        // Hash password with strong algorithm
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute insert statement
        $insert_stmt = $conn->prepare("
            INSERT INTO users (
                fname, 
                lname, 
                email, 
                password, 
                role, 
                created_at, 
                updated_at
            ) VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ");

        // Bind parameters with appropriate data types
        $insert_stmt->bind_param("ssssi", 
            $fname,
            $lname,
            $email,
            $hash_password,
            $role
        );

        // Execute the prepared statement
        if ($insert_stmt->execute()) {
            // Clear sensitive data from memory
            $password = null;
            $hash_password = null;

            header('Location: ../view/register.php?msg=success');
            exit();
        } else {
            throw new Exception("Registration failed");
        }

    } catch (Exception $e) {
        // Log the error securely (don't expose details to user)
        error_log("Registration error: " . $e->getMessage());
        
        header('Location: ../view/register.php?msg=error');
        exit();
    } finally {
        // Clean up resources
        if (isset($check_stmt)) {
            $check_stmt->close();
        }
        if (isset($insert_stmt)) {
            $insert_stmt->close();
        }
    }
} else {
    // Ensure that the script doesn't continue without a POST request
    die("Internal server error!");
}
?>
