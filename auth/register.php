<?php
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = strtolower($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"]; // Ambil role dari input form

    if ($role !== "admin" && $role !== "user") {
        $role = "user"; // Default jika ada input aneh
    }

    $checkUser = $conn->query("SELECT * FROM users WHERE email='$email' OR username='$username'");
    if ($checkUser->num_rows > 0) {
        $error = "Email atau Username sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (fullname, email, username, password, role) VALUES ('$fullname', '$email', '$username', '$password', '$role')";
        if ($conn->query($query)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Gagal mendaftar!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Register - Museum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="font.css">
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="https://tse1.mm.bing.net/th?id=OIP.YSPZTWiohml25Doaqj4SlgHaHa&pid=Api&P=0&h=180" alt="Logo"
                class="w-20 h-20">
        </div>

        <!-- Judul -->
        <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
        <?php if (isset($error)) echo "<p class='text-red-500 text-sm'>$error</p>"; ?>


        <!-- Formulir -->
        <form method="POST">
            <label class="block mb-2 font-semibold">Nama Lengkap:</label>
            <input type="text" name="fullname" class="w-full p-2 border rounded mb-4"
                placeholder="Masukkan Nama Lengkap" required>

            <label class="block mb-2 font-semibold">Username:</label>
            <input type="text" name="username" class="w-full p-2 border rounded mb-4" placeholder="Masukkan Username"
                required>

            <label class="block mb-2 font-semibold">Email:</label>
            <input type="email" name="email" class="w-full p-2 border rounded mb-4" placeholder="Masukkan Email"
                required>

            <label class="block mb-2 font-semibold">Password:</label>
            <input type="password" name="password" class="w-full p-2 border rounded mb-4"
                placeholder="Masukkan Password" required>

            <button type="submit"
                class="w-full bg-orange-900 text-white py-2 rounded hover:bg-orange-600">Registrasi</button>
        </form>

        <!-- Link Login -->
        <p class="text-center mt-4">Sudah punya akun?
            <a href="login.php" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>

</body>

</html>