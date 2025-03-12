<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database Anda
$password = ""; // Sesuaikan dengan password database Anda
$database = "museum_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_tamu_undangan ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <?php include "../components/Slidebar.php"; ?>

    <div class="ml-64 p-6 w-full transition-all duration-300" id="content">
        <h2 class="text-2xl font-bold mb-4 text-center">Laporan Buku Tamu</h2>

        <a href="cetak_pdf.php" target="_blank"
            class="px-4 py-2 bg-[#c8a876] text-white rounded-lg shadow hover:bg-[#2c2316] transition">
            Cetak PDF
        </a>

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md mt-4">
            <thead>
                <tr class="bg-gradient-to-r from-orange-500 to-purple-500 text-white">
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">Alamat</th>
                    <th class="py-3 px-4 text-left">Tanggal Kunjungan</th>
                    <th class="py-3 px-4 text-left">Instansi</th>
                    <th class="py-3 px-4 text-left">Tanggal Input</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100">
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-t border-gray-300'>
                                <td class='py-3 px-4'>{$no}</td>
                                <td class='py-3 px-4'>{$row['nama']}</td>
                                <td class='py-3 px-4'>{$row['alamat']}</td>
                                <td class='py-3 px-4'>{$row['tanggal_kunjungan']}</td>
                                <td class='py-3 px-4'>{$row['instansi']}</td>
                                <td class='py-3 px-4'>{$row['created_at']}</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center py-3'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>