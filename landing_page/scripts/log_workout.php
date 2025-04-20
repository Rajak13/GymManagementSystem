<?php
require '../includes/config.php'; // Corrected path
require '../includes/auth.php';  // Corrected path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user_id = $_SESSION['user_id'];
        $workout_date = $_POST['workout_date'];
        $duration = (int) $_POST['duration'];
        $calories_burned = (int) $_POST['calories_burned'];
        $notes = $_POST['notes'] ?? '';

        $stmt = $pdo->prepare("INSERT INTO workout_logs (user_id, workout_date, duration, calories_burned, notes) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $workout_date, $duration, $calories_burned, $notes]);

        $_SESSION['success'] = "Workout logged successfully!";
        header("Location: ../members.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = "Error logging workout: " . $e->getMessage();
        header("Location: ../members.php");
        exit();
    }
}
?>