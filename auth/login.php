<?php
session_start();
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            // Redirect sesuai role
            if ($user["role"] == "admin") {
                header("Location: ../public/admin/index.php");
            } else {
                header("Location: ../public/user/index.php");
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login - Museum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
        <?php if (isset($error)) echo "<p class='text-red-500 text-sm'>$error</p>"; ?>

        <input type="text" name="username" placeholder="Username" required class="w-full p-2 border rounded mb-2">
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded mb-2">

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
        <p class="text-sm mt-2">Belum punya akun? <a href="register.php" class="text-blue-500">Register</a></p>
    </form>
</body>

</html>