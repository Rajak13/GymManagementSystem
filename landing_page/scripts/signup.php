<?php
session_start();
require '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $required = ['first_name', 'email', 'password', 'confirm_password'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Required field missing: " . $field);
            }
        }

        if ($_POST['password'] !== $_POST['confirm_password']) {
            throw new Exception("Passwords do not match");
        }

        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST['phone'] ?? '');
        $password = trim($_POST['password']);

        // Validation
        $errors = [];
        if (empty($first_name)) $errors[] = "First name is required";
        if (empty($email)) $errors[] = "Email is required";
        if (empty($password)) $errors[] = "Password is required";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
        if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters";

        if (!empty($errors)) {
            throw new Exception(implode("<br>", $errors));
        }

        // Check existing user
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            throw new Exception("Email already registered");
        }

        // Hash password and create user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users 
            (first_name, last_name, email, phone, password) 
            VALUES (?, ?, ?, ?, ?)");

        if ($stmt->execute([$first_name, $last_name, $email, $phone, $hashed_password])) {
            // Automatically log in the user after registration
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_email'] = $email;
            $_SESSION['loggedin'] = true;

            header("Location: ../members.php"); // Redirect to members page
            exit();
        }

        throw new Exception("Registration failed");

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ..scripts/signup.php");
        exit();
    }
}
?>