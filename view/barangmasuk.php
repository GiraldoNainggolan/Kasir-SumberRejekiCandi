<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="text" hidden>
          <select name="barangnya" class="form-control">
            <?php
            include "koneksi/koneksi.php";
            $ambilsemuadata = mysqli_query($conn, "select * from view_data_produk");
            while ($fethcarray = mysqli_fetch_array($ambilsemuadata)) {
              $namaproduk = $fethcarray['nama_produk'];
              $idproduk = $fethcarray['id_produk'];
            ?>

              <option value="<?= $idproduk; ?>"><?= $namaproduk; ?></option>
              <br>
            <?php
            }
            ?>
          </select>
          <br>
          <input type="number" name="jumlahmasuk" class="form-control" placeholder="Jumlah Masuk" required>
          <br>
          <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
          <br>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="addbarangmasuk">Submit</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<?php


if (isset($_POST['addbarangmasuk'])) {
  $barang = $_POST['barangnya'];
  $jumlahmasuk = $_POST['jumlahmasuk'];
  $penerima = $_POST['penerima'];

  $addtotable = mysqli_query($conn, "CALL InsertDataBarangMasuk($barang, $jumlahmasuk, '$penerima');");

  if ($addtotable) {
    echo '<script>
                        alert("barang masuk berhasil ditambahkan.");
                        window.location.href="?halaman=barangmasuk";
                      </script>';
  } else {
    echo '<script>
                        alert("gagal");
                        window.location.href="?halaman=barangmasuk";
                      </script>';
  }
};
?>
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="button d-flex">
        <button type="button" class="btn btn-primary mt-2 mb-4 ml-auto" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus-circle" style="margin-right: 5px"></i>Tambah Barang Masuk
        </button>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="mb-3">Daftar Produk</h3>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>Foto</th>
                  <th>Nama Produk</th>
                  <th>Jumlah Masuk</th>
                  <th>Penerima</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <!-- <tbody>
                <tr>
                  <td>
                    <div class="d-flex no-block align-items-center">
                      <img src="assets/images/Produk/batubata.jpg" alt="user" class="rounded-circle" width="45" height="45" />
                    </div>
                  </td>
                  <td class="font-weight-medium">Batu bata</td>
                  <td>PT Kalimun Jaya</td>
                  <td class="text-success font-weight-medium">
                    Rp. 9.000,00
                  </td>
                  <td>2.490</td>
                  <td>
                    <a href="" class="btn btn-warning" title="Edit"><i class="fas fa-pencil-alt" style="color: #fff"></i></a>
                    |
                    <a href="" class="btn btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>

              </tbody> -->
              <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM ViewDataBarangMasuk;");
                $i = 1;
                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {

                  $namaproduk = $data['nama_produk'];
                  $jumlahmasuk = $data['jumlah_masuk'];
                  $penerima = $data['penerima'];
                  $tanggal = $data['tanggal_masuk'];
                  $idb = $data['id_produk'];
                  $idbm = $data['id_barang_masuk'];


                  //cek apakah ada gambar
                  $gambar = $data['gambar']; //ambil gambar
                  if ($gambar == null) {
                    $img = 'No foto';
                  } else {
                    $img = '<img src= "images/' . $gambar . '" class="rounded-circle" width="45" height="45" />';
                  }
                ?>
                  <tr>

                    <td><?= $img; ?></td>
                    <td><?= $namaproduk; ?></td>
                    <td><?= $jumlahmasuk; ?></td>
                    <td><?= $penerima; ?></td>
                    <td><?= $tanggal; ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit<?= $idbm; ?>"><i class="fas fa-pencil-alt" style="color: #fff"></i></button>
                      |
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idbm; ?>"><i class="fas fa-trash"></i></button>

                      </button>
                    </td>
                  </tr>
                  <!-- delete  Modal  -->
                  <div class="modal fade" id="delete<?= $idbm; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- edit  Modal  -->
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Barang Masuk?</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <form method="POST">
                          <div class="modal-body">
                            Apakah Anda yakin ingin menghapus <?= $namaproduk; ?> ?
                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                            <input type="hidden" name="idbm" value="<?= $idbm;?>">
                            <input type="hidden" name="jumlahmasuk" value="<?= $jumlahmasuk; ?>">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                        </form>
                      </div>

                    </div>
                  </div>
          </div>

          <div class="modal fade" id="edit<?= $idbm; ?>">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- edit  Modal  -->
                <div class="modal-header">
                  <h4 class="modal-title">Edit Barang</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="penerima" value="<?= $penerima; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="jumlahmasuk" value="<?= $jumlahmasuk; ?>" class="form-control" required>

                    <br>
                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                    <input type="hidden" name="idbm" value="<?= $idbm; ?>">
                    <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      <?php
                };
                //update barang
                if (isset($_POST['updatebarangmasuk'])) {
                  $idb = $_POST['idb'];
                  $idbm = $_POST['idbm'];
                  $penerima = $_POST['penerima'];
                  $jumlahmasuk = $_POST['jumlahmasuk'];

                  $update = mysqli_query($conn, "CALL UpdateDataBarangMasuk($idbm, $jumlahmasuk, '$penerima');");
                  if ($update) {
                    echo '<script>
                      alert("barang masuk berhasil diupdate.");
                      window.location.href="?halaman=barangmasuk";
                    </script>';
                  } else {
                    echo '<script>
                      alert("gagal di update.");
                      window.location.href="?halaman=barangmasuk";
                    </script>';
                  }
                }



                //menhapus barang dari stock
                if (isset($_POST['hapusbarangmasuk'])) {
                  $idb = $_POST['idb'];
                  $idbm = $_POST['idbm'];
                  $jumlahmasuk = $_POST['jumlahmasuk'];

                  $hapus = mysqli_query($conn, "CALL DeleteDataBarangMasuk($idbm);");
                  if ($hapus) {
                    echo '<script>
                      alert("barang masuk berhasil dihapus.");
                      window.location.href="?halaman=barangmasuk";
                    </script>';
                  } else {
                    echo '<script>
                    alert("Produk gagal dihapus.");
                    window.location.href="?halaman=barangmasuk";
                  </script>';
                  }
                };
      ?>

      </tbody>
      <tfoot>
        <tr>
          <th>Foto</th>
          <th>Nama</th>
          <th>Supplier</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
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
<!-- ============================================================== -->
<!-- ============================================================== -->