<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database Anda
$password = ""; // Sesuaikan dengan password database Anda
$database = "museum_db";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel user
$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="font.css">

</head>

<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <?php include "../components/Slidebar.php"; ?>

    <!-- Konten -->
    <div class="p-6 w-full ml-64 transition-all duration-300" id="content">
        <h2 class="text-2xl font-bold mb-4 text-center">Data User</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left">No</th>
                        <th class="py-3 px-4 text-left">Nama Lengkap</th>
                        <th class="py-3 px-4 text-left">Username</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Role</th>
                        <th class="py-3 px-4 text-left">Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-t border-gray-300'>
                                    <td class='py-3 px-4'>{$no}</td>
                                    <td class='py-3 px-4'>{$row['fullname']}</td>
                                    <td class='py-3 px-4'>{$row['username']}</td>
                                    <td class='py-3 px-4'>{$row['email']}</td>
                                    <td class='py-3 px-4'>{$row['role']}</td>
                                    <td class='py-3 px-4'>{$row['created_at']}</td>
                                  </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-3'>Tidak ada data user</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>