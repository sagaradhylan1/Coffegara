<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Transfer Berhasil</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eaf4ff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .transfer-container {
      background: white;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      padding: 30px 25px;
      max-width: 400px;
      width: 100%;
      position: relative;
      text-align: center;
    }

    .logo {
      margin-bottom: 10px;
    }

    .logo img {
      width: 80px;
    }

    .checkmark {
      margin-bottom: 10px;
    }

    .checkmark img {
      width: 50px;
    }

    h2 {
      color: #0d6efd;
      margin: 0;
      font-size: 18px;
    }

    .divider {
      border-top: 2px dotted #ccc;
      margin: 15px 0;
    }

    .amount {
      font-size: 24px;
      font-weight: bold;
      margin: 10px 0 20px;
    }

    .detail {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
    }

    .detail b {
      color: #333;
    }

    .selesai-btn {
      background-color: #0d6efd;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 25px;
    }

    .selesai-btn:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>
  <div class="transfer-container">
    <div class="logo">
      <img src="image/bca.png" alt="BCA">
    </div>
    <div class="checkmark">
      <img src="image/ceklis.png" alt="Ceklis">
    </div>

    <div class="detail">
      <p><b>Nama Penerima:</b><br>Coffee GyRess</p>
      <p><b>Rekening Tujuan:</b><br>045-612-8851</p>
      <p><b>Nominal:</b><br><span id="totalAmount"></span></p>
      <p><b>Tanggal:</b><br><span id="tanggalSekarang"></span></p>
    </div>

    <button class="selesai-btn" onclick="window.location.href='index.html'">Selesai</button>
  </div>
  <script>
    // Ambil data 'menuTotal' dari localStorage
  let menuTotal = localStorage.getItem('menuTotal');
  
  // Cek apakah ada nilai 'menuTotal' di localStorage
  if (menuTotal) {
    // Konversi ke angka dan format dengan pemisah ribuan
    let formattedTotal = parseFloat(menuTotal).toLocaleString('id-ID');
    
    // Tampilkan ke elemen dengan ID 'totalAmount'
    document.getElementById('totalAmount').textContent = 'Rp. ' + formattedTotal;
  }
  //realtime waktu
    function formatTanggalSekarang() {
    const sekarang = new Date();

    const hari = sekarang.getDate().toString().padStart(2, '0');
    const bulanNama = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const bulan = bulanNama[sekarang.getMonth()];
    const tahun = sekarang.getFullYear();

    const jam = sekarang.getHours().toString().padStart(2, '0');
    const menit = sekarang.getMinutes().toString().padStart(2, '0');
    const detik = sekarang.getSeconds().toString().padStart(2, '0');

    return `${hari} ${bulan} ${tahun} ${jam}:${menit}:${detik}`;
  }

  // Tampilkan ke elemen
  document.getElementById('tanggalSekarang').textContent = formatTanggalSekarang();

  </script>
</body>
</html>
