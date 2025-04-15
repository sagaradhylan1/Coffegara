<?php
function getPostValue($key, $default = '') {
    return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "coffeeshop");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama   = getPostValue('nama');
    $noHp   = getPostValue('noHp');
    $menu   = getPostValue('menu');
    $harga  = filter_var(getPostValue('harga'), FILTER_VALIDATE_INT);
    $jumlah = filter_var(getPostValue('jumlah'), FILTER_VALIDATE_INT);
    $total  = filter_var(getPostValue('total'), FILTER_VALIDATE_INT);
    $metode = getPostValue('metode');
    $alamat = getPostValue('alamat');
    $waktu  = date('Y-m-d H:i:s');

    if (
        $nama === '' || $noHp === '' || $menu === '' || $metode === '' || $alamat === '' ||
        $harga === false || $harga <= 0 ||
        $jumlah === false || $jumlah <= 0 ||
        $total === false || $total <= 0
    ) 

    $stmt = $conn->prepare("INSERT INTO pembayaran (nama, nomerhp, menu, jumlah, total, metode, alamat, waktu)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiiss", $nama, $noHp, $menu, $jumlah, $total, $metode, $alamat, $waktu);

    if ($stmt->execute()) {
        echo "<script>alert('Pembayaran berhasil!'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan ke database!'); window.history.back();</script>";
    }

    $stmt->close();
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

<section class="book" id="pembayaran">
    <h1 class="heading">Halaman <span>Pembayaran</span></h1>

    <form id="pembayaranForm" method="POST" action="">
        <input type="text" id="namaPembeli" name="nama" class="box" readonly>
        <input type="text" id="noHp" name="noHp" class="box" readonly>
        <input type="text" id="menuDipesan" name="menu" class="box" readonly>
        <input type="text" id="hargaSatuan" class="box" readonly>
        <input type="hidden" id="harga" name="harga">
        <input type="text" id="jumlahDipesan" class="box" readonly>
        <input type="hidden" name="jumlah" id="jumlah">
        <input type="text" id="totalBayarDisplay" class="box" readonly>
        <input type="hidden" id="totalBayar" name="total">
        <select id="metode" name="metode" class="box" required>
            <option value="">Pilih Metode Pembayaran</option>
            <option value="QRIS">QRIS</option>
            <option value="COD">COD (Bayar di Tempat)</option>
        </select>
        <textarea id="alamat" name="alamat" class="box" rows="4" placeholder="Alamat Pengiriman" required></textarea>
        <input type="submit" value="Bayar Sekarang" class="btn">
    </form>
</section>

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

<script>
    const nama = localStorage.getItem('nama');
    const noHp = localStorage.getItem('noHp');
    const menu = localStorage.getItem('menuNama');
    const harga = parseInt(localStorage.getItem('menuHarga'));
    const jumlah = parseInt(localStorage.getItem('jumlah'));
    const total = harga * jumlah;

    document.getElementById('namaPembeli').value = nama || '';
    document.getElementById('noHp').value = noHp || '';
    document.getElementById('menuDipesan').value = menu || '';
    document.getElementById('hargaSatuan').value = 'Rp ' + (harga || 0).toLocaleString('id-ID');
    document.getElementById('harga').value = harga || 0;
    document.getElementById('jumlahDipesan').value = (jumlah || 0) + ' Item';
    document.getElementById('jumlah').value = jumlah || 0;
    document.getElementById('totalBayarDisplay').value = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('totalBayar').value = total;
</script>

<script>
    const firebaseConfig = {
        apiKey: 'AIzaSyAFdZxpR7gwEryIuXMqI81o5K4g5plU9cs',
        authDomain: 'coffeshopgr.firebaseapp.com',
        databaseURL: 'https://coffeshopgr-default-rtdb.firebaseio.com',
        projectId: 'coffeshopgr',
        storageBucket: 'coffeshopgr.appspot.com',
        messagingSenderId: '725990170884',
        appId: '1:725990170884:web:f56410ecc5d914a84ab051',
        measurementId: 'G-NYE45K98WJ'
    };
    firebase.initializeApp(firebaseConfig);

    document.getElementById('pembayaranForm').addEventListener('submit', function (e) {
        const metode = document.getElementById('metode').value;
        const alamat = document.getElementById('alamat').value;

        if (metode === '' || alamat.trim() === '') {
            alert("Metode pembayaran dan alamat tidak boleh kosong!");
            e.preventDefault();
            return;
        }

        const data = {
            nama: localStorage.getItem('nama'),
            noHp: localStorage.getItem('noHp'),
            menu: localStorage.getItem('menuNama'),
            harga: parseInt(localStorage.getItem('menuHarga')),
            jumlah: parseInt(localStorage.getItem('jumlah')),
            total: parseInt(localStorage.getItem('menuHarga')) * parseInt(localStorage.getItem('jumlah')),
            metode: metode,
            alamat: alamat,
            waktu: new Date().toISOString()
        };

        firebase.database().ref('pembayaran').push(data)
        .then(() => {
            console.log("Data berhasil disimpan ke Firebase");
        })
        .catch((error) => {
            e.preventDefault();
            alert("Gagal simpan ke Firebase: " + error.message);
        });
    });
</script>

</body>
</html>
