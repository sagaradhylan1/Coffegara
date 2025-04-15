<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pemesanan - Coffee GyRess</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
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
      <a href="review.php">review</a>
    </nav>
  </header>

  <!-- FORM PEMESANAN -->
  <section class="book" id="order">
    <h1 class="heading">Formulir <span>Pemesanan</span></h1>

    <form id="orderForm" action="pembayaran.php" method="POST">
      <input type="text" id="menuNama" name="menuNama" class="box" readonly>
      <input type="text" id="menuHarga" name="menuHarga" class="box" readonly>
      <input type="text" placeholder="Nama Anda" id="nama" name="nama" class="box" required>
      <input type="number" placeholder="Nomor HP" id="nomor" name="nomor" class="box" required>
      <input type="number" placeholder="Jumlah Pesanan" id="jumlah" name="jumlah" class="box" required>
      <textarea placeholder="Alamat Lengkap Pengiriman" id="alamat" name="alamat" class="box" required></textarea>
      <select id="metode" name="metode" class="box" required>
        <option value="">-- Pilih Metode Pembayaran --</option>
        <option value="COD">Bayar di Tempat (COD)</option>
        <option value="Transfer">Transfer</option>
      </select>
      <textarea placeholder="Catatan Tambahan" id="catatan" name="catatan" class="box" rows="4"></textarea>
      <input type="submit" value="Kirim Pesanan" class="btn">
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
        <a href="index.php"><i class="fas fa-arrow-right"></i> Home</a>
        <a href="about.php"><i class="fas fa-arrow-right"></i> About</a>
        <a href="menu.php"><i class="fas fa-arrow-right"></i> Menu</a>
        <a href="index.php#review"><i class="fas fa-arrow-right"></i> Review</a>
      </div>
      <div class="box">
        <h3>kontak</h3>
        <a href="https://wa.me/6285931106769"><i class="fab fa-whatsapp"></i> +6285931106769</a>
        <a href="mailto:dilanparamaraja1@gmail.com"><i class="fas fa-envelope"></i> dilanparamaraja1@gmail.com</a>
      </div>
      <div class="box">
        <h3>ikuti kami</h3>
        <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
        <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
        <a href="https://wa.me/6287812249416"><i class="fab fa-whatsapp"></i> WhatsApp</a>
      </div>
    </div>
    <div class="credit">created by <span>Moch Sagara Dhylan</span> | all rights reserved</div>
  </section>
  <!-- LOADING SCREEN -->
  <div id="loadingScreen" style="display: none; position: fixed; top: 0; left: 0; 
    width: 100%; height: 100%; background: rgba(0,0,0,0.8); 
    color: white; align-items: center; justify-content: center; 
    z-index: 9999; font-size: 2rem; flex-direction: column;">
    <i class="fas fa-spinner fa-spin" style="font-size: 3rem; margin-bottom: 1rem;"></i>
    Memproses pembayaran transfer Anda...
  </div>
  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

  
<script>
  // Konfigurasi Firebase
  const firebaseConfig = {
    apiKey: "AIzaSyAFdZxpR7gwEryIuXMqI81o5K4g5plU9cs",
    authDomain: "coffeshopgr.firebaseapp.com",
    databaseURL: "https://coffeshopgr-default-rtdb.firebaseio.com",
    projectId: "coffeshopgr",
    storageBucket: "coffeshopgr.appspot.com",
    messagingSenderId: "725990170884",
    appId: "1:725990170884:web:f56410ecc5d914a84ab051",
    measurementId: "G-NYE45K98WJ",
  };

  // Inisialisasi Firebase
  firebase.initializeApp(firebaseConfig);
  const database = firebase.database();

  // Fungsi hitung total dan simpan ke localStorage
  function hitungTotalDanSimpan() {
    const hargaMenu = parseInt(localStorage.getItem('menuHarga') || 0);
    const jumlah = parseInt(document.getElementById('jumlah').value || 1);
    const total = hargaMenu * jumlah;
    localStorage.setItem('menuTotal', total);
  }

  // Isi otomatis data menu dari localStorage saat halaman dimuat
  window.addEventListener('DOMContentLoaded', () => {
    const namaMenu = localStorage.getItem('menuNama');
    const hargaMenu = localStorage.getItem('menuHarga');
    const jumlah = localStorage.getItem('menuJumlah');

    if (!namaMenu || !hargaMenu) {
      alert("Anda belum memilih menu. Silakan pilih dari menu terlebih dahulu.");
      window.location.href = "menu.php";
    } else {
      document.getElementById('menuNama').value = namaMenu;
      document.getElementById('menuHarga').value = hargaMenu;
      document.getElementById('jumlah').value = jumlah || 1;
    }
  });

document.getElementById('orderForm').addEventListener('submit', function(e) {
  e.preventDefault();

  hitungTotalDanSimpan();

  const email = localStorage.getItem('userEmail');
  if (!email) {
    alert("Email tidak ditemukan. Silakan login terlebih dahulu.");
    return;
  }

  const safeEmail = email.replace(/[.#$\[\]@]/g, "_");

  const nama = document.getElementById('nama').value;
  const nomor = document.getElementById('nomor').value;
  const menu = document.getElementById('menuNama').value;
  const harga = document.getElementById('menuHarga').value;
  const jumlah = document.getElementById('jumlah').value;
  const alamat = document.getElementById('alamat').value;
  const metode = document.getElementById('metode').value;
  const catatan = document.getElementById('catatan').value;
  const waktu = new Date().toLocaleString();
  const total = parseInt(harga) * parseInt(jumlah);

  const dataPemesanan = {
    email: email,
    nama: nama,
    nomor: nomor,
    menu: menu,
    harga: harga,
    jumlah: jumlah,
    total: total,
    alamat: alamat,
    metode: metode,
    catatan: catatan,
    waktu: waktu,
    status: metode === "Transfer" ? "pending" : "diproses"
  };

  const pesananRef = database.ref('pemesanan/' + safeEmail + '/pesanan');

  pesananRef.once('value')
    .then(snapshot => {
      const jumlahPesanan = snapshot.numChildren() + 1;
      const idPesanan = 'pesanan_' + jumlahPesanan;
      return pesananRef.child(idPesanan).set(dataPemesanan).then(() => idPesanan);
    })
    .then((idPesanan) => {
      // Simpan kembali data yang perlu disimpan
      const keepUserEmail = localStorage.getItem('userEmail');
      const keepMenuTotal = localStorage.getItem('menuTotal');
      localStorage.clear();
      localStorage.setItem('userEmail', keepUserEmail);
      localStorage.setItem('menuTotal', keepMenuTotal);

      if (metode === "Transfer") {
        // Tampilkan loading screen
        const loading = document.getElementById("loadingScreen");
        loading.style.display = "flex";

        const statusRef = database.ref('pemesanan/' + safeEmail + '/pesanan/' + idPesanan + '/status');

        // Listener status
        const unsubscribe = statusRef.on('value', (snapshot) => {
          const status = snapshot.val();
          console.log(status);
          if (status === "Berhasil") {
            // Hapus listener
            statusRef.off();
            loading.style.display = "none";
            window.location.href = "transaksi.php";
          }
        });

        // Timeout fallback jika status tidak berubah dalam 60 detik
        setTimeout(() => {
          statusRef.off(); // Matikan listener
          loading.style.display = "none";
          alert("Status belum berubah menjadi 'berhasil'. Silakan tunggu konfirmasi admin.");
        }, 1000000); // 60 detik

      } else {
        // Langsung arahkan ke transaksi jika metode COD
        window.location.href = "transaksi.php";
      }
    })
    .catch((error) => {
      alert('Gagal mengirim ke Firebase: ' + error.message);
    });
});



</script>

</body>
</html>
