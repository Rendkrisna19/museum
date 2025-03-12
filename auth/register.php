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
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
        <?php if (isset($error)) echo "<p class='text-red-500 text-sm'>$error</p>"; ?>
        <input type="text" name="fullname" placeholder="Nama Lengkap" required class="w-full p-2 border rounded mb-2">
        <input type="email" name="email" placeholder="Email" required class="w-full p-2 border rounded mb-2">
        <input type="text" name="username" placeholder="Username" required class="w-full p-2 border rounded mb-2">
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded mb-2">

        <!-- <select name="role" class="w-full p-2 border rounded mb-2">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select> -->

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Register</button>
        <p class="text-sm mt-2">Sudah punya akun? <a href="login.php" class="text-blue-500">Login</a></p>
    </form>
</body>

</html>