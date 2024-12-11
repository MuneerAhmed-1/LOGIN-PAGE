<?php

require '../db/connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $shop_no = $_POST['shop_no'];
    $no_of_employees = $_POST['no_of_employees'];
    if (trim($name) == "" || trim($email) == "" || trim($password) == "" || trim($shop_no) == "" || trim($no_of_employees) == "") {
        echo json_encode(['success' => false, 'message' => 'All fields is required!']);
        exit;
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email']);
        exit;
    }

    $check_email = "SELECT email from users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already in use']);
        exit;
    }

    if (strlen(trim($password)) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
        exit;
    }
    
    $query = "
        INSERT INTO users (name, email, password, shop_no, no_of_employees) VALUES ('$name', '$email', '$password', '$shop_no', '$no_of_employees');
    ";

    $insert = $conn->query($query);
    if ($insert) {
        echo json_encode(['success' => true, 'message' => 'User created successfully', 'user' => [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'shop' => $shop_no,
            'customer' => $no_of_employees
        ]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No form submission']);
    exit;
}
