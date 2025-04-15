<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $noHp = $_POST['noHp'];
  $menu = $_POST['menu'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  $total = $_POST['total'];
  $metode = $_POST['metode'];
  $alamat = $_POST['alamat'];

  $conn = new mysqli("localhost", "root", "", "coffeeshop");
  if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
  }

  $sql = "INSERT INTO pembayaran (nama, noHp, menu, harga, jumlah, total, metode, alamat) 
          VALUES ('$nama', '$noHp', '$menu', '$harga', '$jumlah', '$total', '$metode', '$alamat')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Pembayaran berhasil!'); window.location='index.html';</script>";
  } else {
    echo "Gagal simpan ke MySQL: " . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran - Coffee GyRess</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-database-compat.js"></script>
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div id="menu-btn" class="fas fa-bars"></div>
    <a href="index.html" class="logo">coffee <i class="fas fa-mug-hot"></i></a>
    <nav class="navbar">
      <a href="index.html">home</a>
      <a href="about.html">about</a>
      <a href="menu.html">menu</a>
      <a href="review.html">review</a>
    </nav>
  </header>

  <!-- SECTION PEMBAYARAN -->
  <section class="book" id="pembayaran">
    <h1 class="heading">Halaman <span>Pembayaran</span></h1>

    <form id="pembayaranForm" method="POST">
      <input type="text" id="namaPembeli" name="nama" class="box" readonly>
      <input type="text" id="noHp" name="noHp" class="box" readonly>
      <input type="text" id="menuDipesan" name="menu" class="box" readonly>
      <input type="text" id="hargaSatuan" class="box" readonly>
      <input type="text" id="jumlahDipesan" name="jumlah" class="box" readonly>
      <input type="text" id="totalBayar" name="total" class="box" readonly>
      <input type="hidden" id="harga" name="harga">
      <select id="metode" name="metode" class="box" required>
        <option value="">Pilih Metode Pembayaran</option>
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="QRIS">QRIS</option>
        <option value="COD">COD (Bayar di Tempat)</option>
      </select>
      <textarea id="alamat" name="alamat" class="box" rows="4" placeholder="Alamat Pengiriman" required></textarea>
      <input type="submit" value="Bayar Sekarang" class="btn">
    </form>
  </section>

  <!-- FOOTER -->
  <section class="footer">
    <div class="box-container">
      <div class="box">
        <h3>cabang kami</h3>
        <a href="#"><i class="fas fa-arrow-right"></i> Indonesia</a>
        <a href="#"><i class="fas fa-arrow-right"></i> Singapore</a>
        <a href="#"><i class="fas fa-arrow-right"></i> Malaysia</a>
      </div>
      <div class="box">
        <h3>tautan cepat</h3>
        <a href="index.html"><i class="fas fa-arrow-right"></i> Home</a>
        <a href="about.html"><i class="fas fa-arrow-right"></i> About</a>
        <a href="menu.html"><i class="fas fa-arrow-right"></i> Menu</a>
        <a href="index.html#review"><i class="fas fa-arrow-right"></i> Review</a>
      </div>
      <div class="box">
        <h3>kontak</h3>
        <a href="https://wa.me/6285931106769" target="_blank"><i class="fab fa-whatsapp"></i> +6285931106769</a>
        <a href="mailto:dilanparamaraja1@gmail.com"><i class="fas fa-envelope"></i> dilanparamaraja1@gmail.com</a>
      </div>
      <div class="box">
        <h3>ikuti kami</h3>
        <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
        <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
        <a href="https://wa.me/6287812249416" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
      </div>
    </div>
    <div class="credit">created by <span>Moch Sagara Dhylan</span> | all rights reserved</div>
  </section>

  <!-- SCRIPT -->
  <script>
  const firebaseConfig = {
    apiKey: "AIzaSyAFdZxpR7gwEryIuXMqI81o5K4g5plU9cs",
    authDomain: "coffeshopgr.firebaseapp.com",
    databaseURL: "https://coffeshopgr-default-rtdb.firebaseio.com",
    projectId: "coffeshopgr",
    storageBucket: "coffeshopgr.appspot.com",
    messagingSenderId: "725990170884",
    appId: "1:725990170884:web:f56410ecc5d914a84ab051",
    measurementId: "G-NYE45K98WJ"
  };

  firebase.initializeApp(firebaseConfig);
  const database = firebase.database();

  const nama = localStorage.getItem('nama');
  const noHp = localStorage.getItem('noHp');
  const menu = localStorage.getItem('menuNama');
  const harga = parseInt(localStorage.getItem('menuHarga'));
  const jumlah = parseInt(localStorage.getItem('jumlah'));
  const total = harga * jumlah;

  document.getElementById('namaPembeli').value = nama;
  document.getElementById('noHp').value = noHp;
  document.getElementById('menuDipesan').value = menu;
  document.getElementById('harga').value = harga;
  document.getElementById('hargaSatuan').value = 'Rp ' + harga.toLocaleString('id-ID');
  document.getElementById('jumlahDipesan').value = jumlah + ' Item';
  document.getElementById('totalBayar').value = 'Rp ' + total.toLocaleString('id-ID');

  document.getElementById('pembayaranForm').addEventListener('submit', function (e) {
    const metode = document.getElementById('metode').value;
    const alamat = document.getElementById('alamat').value.trim();

    if (!metode || !alamat) {
      e.preventDefault();
      alert("Mohon lengkapi metode pembayaran dan alamat.");
      return;
    }

    database.ref('pembayaran').push({
      nama,
      noHp,
      menu,
      harga,
      jumlah,
      total,
      metode,
      alamat,
      waktu: Date.now()
    });
  });
  </script>

</body>
</html>
