<?php
// Koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "kasirtokobangunan");
// Mengambil nilai parameter kodetransaksi dari permintaan POST
$kodeTransaksi = $_POST['kodetransaksi'];
// $kodeTransaksi = 'TR001';

// Query untuk memanggil stored procedure dan mendapatkan hasilnya
$sql = "CALL GetTransaksiDetail3('$kodeTransaksi')";
$result = mysqli_query($conn, $sql);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
  // Mengubah hasil menjadi array asosiatif
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  
  // Menutup koneksi dan hasil
  mysqli_free_result($result);
  mysqli_close($conn);

  // Mengembalikan data dalam format JSON
  echo json_encode($data);
} else {
  // Handle jika query tidak berhasil
  echo json_encode(array('error' => 'Query error'));
}
?>
