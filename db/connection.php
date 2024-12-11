<?php

$conn = mysqli_connect('localhost', 'root', '', 'bmt');
if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">Connection failed: ' . $conn->connect_error . '</div>');
}