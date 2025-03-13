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
    <link rel="stylesheet" href="font.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-center mb-4">
            <img src="https://tse1.mm.bing.net/th?id=OIP.YSPZTWiohml25Doaqj4SlgHaHa&pid=Api&P=0&h=180" alt="Logo"
                class="w-20 h-20">
        </div>
        <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
        <?php if (isset($error)) echo "<p class='text-red-500 text-sm'>$error</p>"; ?>
        <form method="POST">
            <label class="block mb-2">Username:</label>
            <input type="text" name="username" class="w-full p-2 border rounded mb-4" placeholder="Masukkan Username"
                required>

            <label class="block mb-2">Password:</label>
            <input type="password" name="password" class="w-full p-2 border rounded mb-4"
                placeholder="Masukkan password" required>

            <button type="submit"
                class="w-full bg-orange-900 text-white py-2 rounded hover:bg-orange-600">Login</button>
        </form>
        <p class="text-center mt-4">Belum punya akun? <a href="register.php" class="text-blue-500">Registrasi</a></p>
    </div>
</body>

</html>