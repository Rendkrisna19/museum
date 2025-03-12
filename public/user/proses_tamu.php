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

// Ambil data dari form
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tanggal_kunjungan = $_POST['tanggal_kunjungan'];
$instansi = $_POST['instansi'];

// Query insert data
$sql = "INSERT INTO tbl_tamu_undangan (nama, alamat, tanggal_kunjungan, instansi) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $alamat, $tanggal_kunjungan, $instansi);

if ($stmt->execute()) {
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>