<?php
require_once '../db/config.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

if ($action === 'getTotalUsers') {
    $stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode(['total_users' => $data['total_users']]);
} elseif ($action === 'getTotalRecipes') {
    $stmt = $conn->prepare("SELECT COUNT(*) as total_recipes FROM recipes");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode(['total_recipes' => $data['total_recipes']]);
} else {
    echo json_encode(['error' => 'Invalid action']);
}
?>