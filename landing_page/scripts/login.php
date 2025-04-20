<?php
require '../includes/config.php';
require '../includes/auth.php';

session_start();

if (isLoggedIn()) {
    header("Location: ../members.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            throw new Exception("Both email and password are required");
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $_SESSION['error'] = "Account not found. Would you like to create one?";
            $_SESSION['show_signup_prompt'] = true; // Flag for signup button
            header("Location: ../index.php#loginModal");
            exit();
        }

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Incorrect password. Please try again.");
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['loggedin'] = true;

        header("Location: ../members.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../index.php#loginModal");
        exit();
    }
}
?>