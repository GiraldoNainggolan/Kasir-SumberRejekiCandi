<style>
  .col-sm-12 {
    background: white;
    padding: 20px;
  }

  @media print {
    table {
      align-content: center;
    }

    .btn {
      display: none !important;
    }

    .ds {
      display: none;
    }

    .cari {
      display: none !important;
      box-shadow: none !important;
    }

    hr {
      display: none;
    }

    .hd {
      display: none;
    }

    .left-sidebar {
      display: none !important;
    }
    .footer {
			display: none !important;
		}
  }
</style>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Kode Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCariTransaksi">
          <div class="form-group">
            <label for="kodetransaksi">Kode Transaksi:</label>
            <input type="text" class="form-control" id="kodetransaksi" placeholder="Masukkan Kode Transaksi" required>
          </div>
        </form>
        <div id="hasilPencarian">
          <table class="table">
            <thead>
              <tr>
                <th>Kode transaksi</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <!-- Data akan ditambahkan melalui JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row d-flex justify-content-between mb-4">
            <h3 class="mb-3">Laporan Keuangan</h3>
            <p class=""><span><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></p>
            <div class="unduh">
              <a href="#" class="btn btn-outline-danger" onclick="window.print();">
                <i class="far fa-file-pdf" style="margin-right: 5px"></i>PDF</a>

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Cari Transaksi
              </button>
            </div>
          </div>

          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>Kode Transaksi</th>
                  <th>Jumlah Beli</th>
                  <th>Total Beli</th>
                  <th>Tanggal Beli</th>

                </tr>
              </thead>
              <!-- <tbody>
                        <tr>
                          <td class="font-weight-medium">Penjualan Bulanan</td>
                          <td>Januari 2024</td>
                          <td>
                            <a href=""><span class="badge">[detail]</span></a>
                          </td>
                          <td class="text-primary">Rp. 23.000.000,00</td>
                          
                        </tr>
                        
                      </tbody> -->
              <tbody>
                <?php
                include "koneksi/koneksi.php";
                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM view_transaksi_summary;");
                while ($data = mysqli_fetch_array($ambilsemuadata)) {

                  $kodetransaksi = $data['kd_transaksi'];
                  $jumlahbeli = $data['jumlah_beli'];
                  $totalharga = $data['total_harga'];
                  $tanggalbeli = $data['tanggal_beli'];
                ?>
                  <tr>
                    <td><?= $kodetransaksi; ?></td>
                    <td><?= $jumlahbeli; ?></td>
                    <td><?= "Rp." . number_format($totalharga) . ",-"; ?></td>
                    <td><?= $tanggalbeli; ?></td>
                  </tr>

          </div>

        </div>

      <?php
                };

      ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="2">Total :</th>
          <th class="bg-primary text-white">
            <?php
            $ambilsubtotal = mysqli_query($conn, "SELECT SUM(sub_total) AS ada FROM view_transaksi_summary;");
            while ($data = mysqli_fetch_array($ambilsubtotal)) {
              // echo $data['ada'];
              echo "Rp." . number_format($data['ada']) . ",-";
            }
            ?>
          </th>
        </tr>
      </tfoot>
      </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- *************************************************************** -->
<!-- End Top Leader Table -->
<!-- *************************************************************** -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(e) {
      var modal = $(this);
      var kodeBarang = modal.find('input[name="kodebarang"]').val(); // Ambil nilai input kode barang

      // Lakukan AJAX request untuk mendapatkan data dari server
      $.ajax({
        type: 'POST',
        url: 'view/cari_kode_barang.php', // Ganti dengan path ke script server Anda
        data: {
          kd_transaksi_param: kodeBarang // Kirim parameter kode barang ke server
        },
        dataType: 'json',
        success: function(data) {
          // Bersihkan isi tabel modal sebelum menambahkan data baru
          modal.find('.modal-body table tbody').empty();

          // Loop untuk menambahkan baris data ke tabel modal
          $.each(data, function(index, row) {
            var html = '<tr>' +
              '<td>' + row.kd_pretransaksi + '</td>' +
              '<td>' + row.nama_produk + '</td>' +
              '<td>' + row.jumlah + '</td>' +
              '<td>' + row.sub_total + '</td>' +
              '</tr>';
            modal.find('.modal-body table tbody').append(html);
          });
        },
        error: function(xhr, status, error) {
          // Handle error jika ada
          console.error(xhr.responseText);
        }
      });
    });
  }); -->
<!-- </script> -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    // Fungsi untuk menampilkan hasil pencarian setelah modal ditampilkan
    // $('#exampleModal').on('shown.bs.modal', function (e) {
    //   var modal = $(this);
    //   var kodeTransaksi = modal.find('#kodetransaksi').val(); // Ambil nilai input kode transaksi dari modal

    //   // Lakukan AJAX request untuk mendapatkan data dari server
    //   $.ajax({
    //     type: 'POST',
    //     url: 'view/cari_kode_barang.php', // Ganti dengan path ke script PHP Anda
    //     data: {
    //       kodetransaksi: kodeTransaksi // Kirim parameter kode transaksi ke server
    //     },
    //     dataType: 'json',
    //     success: function(data) {
    //       console.log(data)
    //       // Bersihkan isi tabel sebelum menambahkan data baru
    //       $('#tableBody').empty();

    //       // Periksa jika data tidak kosong
    //       if (data.length > 0) {
    //         // Loop untuk menambahkan baris data ke tabel
    //         $.each(data, function(index, row) {
    //           var html = '<tr>' +
    //                      '<td>' + row.kd_transaksi + '</td>' +
    //                      '<td>' + row.total_harga + '</td>' +
    //                      '<td>' + row.jumlah_beli + '</td>' +
    //                     //  '<td>' + row.sub_total + '</td>' +
    //                      '</tr>';
    //           $('#tableBody').append(html); // Tambahkan baris ke tabel
    //         });
    //       } else {
    //         // Jika data kosong, tampilkan pesan kosong
    //         $('#tableBody').html('<tr><td colspan="4">Data tidak ditemukan.</td></tr>');
    //       }
    //     },
    //     error: function(xhr, status, error) {
    //       // Handle error jika ada
    //       console.error(xhr.responseText);
    //     }
    //   });
    // });

    // // Bersihkan input dan tabel saat modal ditutup
    // $('#exampleModal').on('hidden.bs.modal', function (e) {
    //   $('#kodetransaksi').val(''); // Bersihkan input kode transaksi
    //   $('#tableBody').empty(); // Bersihkan isi tabel
    // });
    // Fungsi untuk menampilkan hasil pencarian setiap kali input kode transaksi berubah
    $('#kodetransaksi').on('input', function() {
      var kodeTransaksi = $(this).val(); // Ambil nilai input kode transaksi

      // Lakukan AJAX request untuk mendapatkan data dari server
      $.ajax({
        type: 'POST',
        url: 'view/cari_kode_barang.php', // Ganti dengan path ke script PHP Anda
        data: {
          kodetransaksi: kodeTransaksi // Kirim parameter kode transaksi ke server
        },
        dataType: 'json',
        success: function(data) {
          // Bersihkan isi tabel sebelum menambahkan data baru
          $('#tableBody').empty();

          // Periksa jika data tidak kosong
          if (data.length > 0) {
            // Loop untuk menambahkan baris data ke tabel
            $.each(data, function(index, row) {
              var html = '<tr>' +
                '<td>' + row.kd_transaksi + '</td>' +
                '<td>' + row.total_harga + '</td>' +
                '<td>' + row.jumlah_beli + '</td>' +
                // '<td>' + row.sub_total + '</td>' +
                '</tr>';
              $('#tableBody').append(html); // Tambahkan baris ke tabel
            });
          } else {
            // Jika data kosong, tampilkan pesan kosong
            $('#tableBody').html('<tr><td colspan="4">Data tidak ditemukan.</td></tr>');
          }
        },
        error: function(xhr, status, error) {
          // Handle error jika ada
          console.error(xhr.responseText);
        }
      });
    });

    // Bersihkan input dan tabel saat modal ditutup
    $('#exampleModal').on('hidden.bs.modal', function(e) {
      $('#kodetransaksi').val(''); // Bersihkan input kode transaksi
      $('#tableBody').empty(); // Bersihkan isi tabel
    });

  });
</script>