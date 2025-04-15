<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Coffee GyRess</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .text-brown {
      color: #5C4033;
    }
    .bg-brown {
      background-color: #5C4033;
    }
    .hover\:bg-brown-dark:hover {
      background-color: #3e2a1f;
    }
  </style>
</head>
<body class="bg-amber-50 min-h-screen">

  <!-- Header -->
  <header class="bg-white shadow-md p-4 flex justify-between items-center">
    <a href="index.php" class="text-2xl font-bold text-brown flex items-center gap-2">
      Coffee GyRess
      <i class="fas fa-mug-hot"></i>
    </a>
    <nav class="flex items-center gap-6">
      <a href="index.php" class="text-gray-700 hover:text-amber-600 font-medium">Home</a>
      <a href="menu.php" class="text-gray-700 hover:text-amber-600 font-medium">Menu</a>
      <a href="admin.php" class="text-amber-700 font-semibold border-b-2 border-amber-700">Admin</a>

      <!-- Icon Logout -->
      <a href="#" onclick="logout()" class="text-gray-700 hover:text-red-600 flex items-center gap-1" title="Logout">
        <i data-feather="log-out"></i>
      </a>
    </nav>
  </header>

  <!-- Konten Admin -->
  <section class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-center text-brown mb-8">Dashboard <span class="text-amber-700">Admin</span></h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
      <table class="min-w-full text-sm text-gray-700">
        <thead class="bg-brown text-white">
          <tr>
            <th class="px-6 py-3 text-left">Email</th>
            <th class="px-6 py-3 text-left">Nama</th>
            <th class="px-6 py-3 text-left">No. HP</th>
            <th class="px-6 py-3 text-left">Menu</th>
            <th class="px-6 py-3 text-left">Jumlah</th>
            <th class="px-6 py-3 text-left">Total</th>
            <th class="px-6 py-3 text-left">Metode</th>
            <th class="px-6 py-3 text-left">Alamat</th>
            <th class="px-6 py-3 text-left">Waktu</th>
            <th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody id="tabelBodyPesanan" class="divide-y divide-gray-200 bg-white">
          <tr><td colspan="11" class="py-4 text-center text-gray-500">Memuat data...</td></tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

  <!-- Feather Icons Init -->
  <script>feather.replace();</script>

  <!-- Firebase Config -->
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

    const tabelBody = document.getElementById("tabelBodyPesanan");
    tabelBody.innerHTML = "";

    database.ref('pemesanan').on('value', (snapshot) => {
      tabelBody.innerHTML = "";

      if (!snapshot.exists()) {
        tabelBody.innerHTML = "<tr><td colspan='11' class='py-4 text-center text-gray-500'>Belum ada pesanan.</td></tr>";
        return;
      }

      snapshot.forEach((userSnap) => {
        const email = userSnap.key.replace(/_/g, "@");
        const pesananUser = userSnap.child("pesanan");

        pesananUser.forEach((pesananSnap) => {
          const data = pesananSnap.val();

          const row = document.createElement("tr");
          row.classList.add("hover:bg-amber-50");
          row.innerHTML = `
  <td class="px-6 py-4">${email}</td>
  <td class="px-6 py-4">${data.nama}</td>
  <td class="px-6 py-4">${data.nomor}</td>
  <td class="px-6 py-4">${data.menu}</td>
  <td class="px-6 py-4">${data.jumlah} item</td>
  <td class="px-6 py-4">Rp ${parseInt(data.total).toLocaleString('id-ID')}</td>
  <td class="px-6 py-4">${data.metode}</td>
  <td class="px-6 py-4">${data.alamat}</td>
  <td class="px-6 py-4">${data.waktu}</td>
  <td class="px-6 py-4">${data.status}</td>
  <td class="px-6 py-4 flex gap-1 flex-wrap">
    ${
      data.metode === "COD"
        ? `
          <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600" onclick="updateStatus('${userSnap.key}', '${pesananSnap.key}', 'Diproses')">Diproses</button>
          <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600" onclick="updateStatus('${userSnap.key}', '${pesananSnap.key}', 'Sedang Dikirim')">Sedang Dikirim</button>
          <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600" onclick="updateStatus('${userSnap.key}', '${pesananSnap.key}', 'Sudah Sampai')">Sampai</button>
        `
        : data.metode === "Transfer"
        ? `
          <button class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600" onclick="updateStatus('${userSnap.key}', '${pesananSnap.key}', 'Pending')">Pending</button>
          <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700" onclick="updateStatus('${userSnap.key}', '${pesananSnap.key}', 'Berhasil')">Berhasil</button>
        `
        : `<span class='text-gray-400 text-sm'>Tidak ada aksi</span>`
    }
  </td>
`;
1
          tabelBody.appendChild(row);
        });
      });
    });

    function updateStatus(userKey, pesananKey, status) {
      const statusRef = database.ref(`pemesanan/${userKey}/pesanan/${pesananKey}`);
      statusRef.update({ status: status }).then(() => {
        alert(`Status diperbarui menjadi: ${status}`);
      }).catch((error) => {
        console.error('Gagal update status:', error);
      });
    }

    function logout() {
  localStorage.removeItem("isLoggedIn");
  window.location.href = "../index.html";
}

  </script>

</body>
</html>
