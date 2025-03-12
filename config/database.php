<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "museum_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambahkan admin jika belum ada
$checkAdmin = $conn->query("SELECT * FROM users WHERE role='admin'");
if ($checkAdmin->num_rows === 0) {
    $adminPassword = password_hash("admin123", PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (fullname, email, username, password, role) VALUES ('Admin Museum', 'admin@gmail.com', 'admin', '$adminPassword', 'admin')");
}
?>