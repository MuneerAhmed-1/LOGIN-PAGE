<?php

require '../db/connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (trim($email) == "" || trim($password) == "") {
        echo json_encode(['success' => false, 'message' => 'All fields is required!']);
        exit;
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email']);
        exit;
    }

    if (strlen(trim($password)) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
        exit;
    }

    $query = "SELECT email, password from users WHERE email='$email' AND password='$password'";
    $login = $conn->query($query);
    if (mysqli_num_rows($login) > 0) {
        echo json_encode(['success' => true, 'message' => 'Login successful!']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials!']);
        exit;
    }

    $response = [
        'success' => true,
        'email' => $email,
        'password' => $password,
    ];

    echo json_encode($response);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'No form submission']);
    exit;
}
