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

// Menghitung jumlah data tamu dan user
$queryTamu = "SELECT COUNT(*) as total_tamu FROM tbl_tamu_undangan";
$queryUser = "SELECT COUNT(*) as total_user FROM users";

$resultTamu = $conn->query($queryTamu);
$resultUser = $conn->query($queryUser);

$totalTamu = $resultTamu->fetch_assoc()['total_tamu'];
$totalUser = $resultUser->fetch_assoc()['total_user'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <?php include "../components/Slidebar.php"; ?>

    <!-- Konten -->
    <div class="p-6 w-full ml-64 transition-all duration-300" id="content">
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold">Dashboard Admin</h2>
                <p class="text-gray-600">Selamat datang di panel admin.</p>
            </div>
            <img src="assets/logo.png" alt="Logo Museum" class="h-16">
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold"><?php echo $totalTamu; ?></h3>
                    <p class="text-lg">Total Tamu Undangan</p>
                </div>
                <i class="fas fa-users text-3xl"></i>
            </div>

            <div class="bg-green-500 text-white p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold"><?php echo $totalUser; ?></h3>
                    <p class="text-lg">Total Pengguna</p>
                </div>
                <i class="fas fa-user text-3xl"></i>
            </div>
        </div>

        <!-- Tabel Buku Tamu (Ringkasan) -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4">Ringkasan Buku Tamu</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-3 px-4 text-left">No</th>
                            <th class="py-3 px-4 text-left">Nama</th>
                            <th class="py-3 px-4 text-left">Tanggal Kunjungan</th>
                            <th class="py-3 px-4 text-left">Instansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryRingkasan = "SELECT nama, tanggal_kunjungan, instansi FROM tbl_tamu_undangan ORDER BY created_at DESC LIMIT 5";
                        $resultRingkasan = $conn->query($queryRingkasan);
                        if ($resultRingkasan->num_rows > 0) {
                            $no = 1;
                            while ($row = $resultRingkasan->fetch_assoc()) {
                                echo "<tr class='border-t border-gray-300'>
                                        <td class='py-3 px-4'>{$no}</td>
                                        <td class='py-3 px-4'>{$row['nama']}</td>
                                        <td class='py-3 px-4'>{$row['tanggal_kunjungan']}</td>
                                        <td class='py-3 px-4'>{$row['instansi']}</td>
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center py-3'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>