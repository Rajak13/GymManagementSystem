// scripts/log_nutrition.php
<?php
require '../includes/config.php';
require '../includes/auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $log_date = $_POST['log_date'];
    $calories = (int)$_POST['calories'];
    $protein = (float)$_POST['protein'];
    $carbs = (float)$_POST['carbs'];
    $fats = (float)$_POST['fats'];
    $water = (int)$_POST['water'];

    $stmt = $pdo->prepare("REPLACE INTO nutrition_logs 
        (user_id, log_date, calories, protein, carbs, fats, water)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$user_id, $log_date, $calories, $protein, $carbs, $fats, $water])) {
        $_SESSION['success'] = "Nutrition logged successfully!";
    } else {
        $_SESSION['error'] = "Failed to log nutrition";
    }
}
header("Location: ../members.php");