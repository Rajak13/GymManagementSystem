<?php
require '../includes/config.php';
require '../includes/auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['session_id'])) {
    try {
        $session_id = (int)$_POST['session_id'];
        $user_id = $_SESSION['user_id'];

        // Check session availability
        $pdo->beginTransaction();
        
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE id = ? FOR UPDATE");
        $stmt->execute([$session_id]);
        $session = $stmt->fetch();

        if (!$session) {
            throw new Exception("Session not found");
        }

        if ($session['current_participants'] >= $session['max_participants']) {
            throw new Exception("Session is fully booked");
        }

        // Create booking
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, session_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $session_id]);

        // Update participants count
        $stmt = $pdo->prepare("UPDATE sessions SET current_participants = current_participants + 1 WHERE id = ?");
        $stmt->execute([$session_id]);

        $pdo->commit();

        $_SESSION['success'] = "Session booked successfully!";
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Booking failed: " . $e->getMessage();
    }
    header("Location: members.php");
    exit();
}
?>