<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = [
    'nama' => $_POST['nama'],
    'nohp' => $_POST['nohp'],
    'menu' => $_POST['menu'],
    'jumlah' => $_POST['jumlah'],
    'total' => $_POST['total'],
    'alamat' => $_POST['alamat'],
    'metode' => $_POST['metode'],
    'waktu' => date('Y-m-d H:i:s')
  ];

  $file = fopen("data_pembayaran.txt", "a");
  fwrite($file, json_encode($data) . PHP_EOL);
  fclose($file);

  echo "<h3>Pembayaran berhasil disimpan! Terima kasih :)</h3>";
  echo '<a href="index.html">Kembali ke Beranda</a>';
}
?>
