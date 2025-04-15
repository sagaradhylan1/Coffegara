<?php
// Koneksi ke MySQL (sesuaikan username dan password Laragon kamu)
$conn = new mysqli("localhost", "root", "", "coffeeshop");

// Cek koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$menu = $_POST['menu'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$metode = $_POST['metode'];
$alamat = $_POST['alamat'];
$total = $harga * $jumlah;

// Simpan ke MySQL
$sql = "INSERT INTO pembayaran (nama, hp, menu, harga, jumlah, metode, alamat, total) VALUES ('$nama', '$hp', '$menu', '$harga', '$jumlah', '$metode', '$alamat', '$total')";

if ($conn->query($sql) === TRUE) {
  echo "Pembayaran berhasil disimpan ke MySQL.<br>";
} else {
  echo "Gagal simpan ke MySQL: " . $conn->error;
}

// Simpan ke Firebase Realtime Database
$data = [
  "nama" => $nama,
  "hp" => $hp,
  "menu" => $menu,
  "harga" => $harga,
  "jumlah" => $jumlah,
  "metode" => $metode,
  "alamat" => $alamat,
  "total" => $total
];

// Kirim ke Firebase via REST API
$firebase_url = "https://coffeshopgr-default-rtdb.firebaseio.com";
$options = [
  'http' => [
    'method'  => 'POST',
    'header'  => 'Content-type: application/json',
    'content' => json_encode($data)
  ]
];
$context = stream_context_create($options);
$result = file_get_contents($firebase_url, false, $context);
if ($result) {
  echo "Data juga dikirim ke Firebase.";
} else {
  echo "Gagal kirim ke Firebase.";
}
?>
