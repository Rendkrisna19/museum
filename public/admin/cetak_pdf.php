<?php
require '../../vendor/autoload.php'; // Pastikan Dompdf sudah diinstall dengan Composer
use Dompdf\Dompdf;
use Dompdf\Options;

// Konfigurasi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

$host = "localhost";
$user = "root";
$password = "";
$database = "museum_db";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_tamu_undangan ORDER BY created_at DESC";
$result = $conn->query($sql);

// HTML untuk PDF
$html = '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Tamu</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { width: 100px; height: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.jpg" class="logo">
        <h2>Data Rekapitulasi Tamu Undangan</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Kunjungan</th>
                <th>Instansi</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>';

// Tambahkan data dari database ke tabel
if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $html .= "
        <tr>
            <td>{$no}</td>
            <td>{$row['nama']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['tanggal_kunjungan']}</td>
            <td>{$row['instansi']}</td>
            <td>{$row['created_at']}</td>
        </tr>";
        $no++;
    }
} else {
    $html .= "<tr><td colspan='6' style='text-align:center;'>Tidak ada data</td></tr>";
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// Load HTML ke Dompdf
$dompdf->loadHtml($html);

// Atur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("Laporan_Buku_Tamu.pdf", ["Attachment" => false]);
?>