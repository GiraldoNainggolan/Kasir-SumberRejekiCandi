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
            $ambilsemuadata = mysqli_query($conn, "select * from view_data_supplier");
            while ($fethcarray = mysqli_fetch_array($ambilsemuadata)) {
              $namasupplier = $fethcarray['nama_supplier'];
              $idsupplier = $fethcarray['id_supplier'];
            ?>

              <option value="<?=  $namasupplier; ?>"><?= $namasupplier; ?></option>
              <br>
            <?php
            }
            ?>
          </select>
          <br>
          <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
          <br>
          <input type="number" name="stock" class="form-control" placeholder="Stock" required>
          <br>
          <input type="number" name="harga" class="form-control" placeholder="Harga Jual" required>
          <br>
          <input type="file" name="file" class="form-control">
          <br>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
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


if (isset($_POST['addnewbarang'])) {
  $namabarang = $_POST['namabarang'];
  $supplier = $_POST['barangnya'];
  $stock = $_POST['stock'];
  $harga = $_POST['harga'];

  //soal gambar
  $allowed_extension = array('png', 'jpg');
  $nama = $_FILES['file']['name']; //ngambil nama file gambar
  $dot = explode('.', $nama);
  $ekstensi = strtolower(end($dot));
  $ukuran = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];

  //penamaan file 
  $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file dengan nama
  if (in_array($ekstensi, $allowed_extension) === true) {
    if ($ukuran < 15000000) {
      move_uploaded_file($file_tmp, 'images/' . $image);
      $addtotable = mysqli_query($conn, "CALL insert_data_produk2('$namabarang', '$supplier', $stock ,$harga, '$image')");

      if ($addtotable) {
        echo '<script>
                        alert("Produk berhasil ditambahkan.");
                        window.location.href="?halaman=dataproduk";
                      </script>';
      } else {
        echo '<script>
                        alert("gagal");
                        window.location.href="?halaman=dataproduk";
                      </script>';
      }
    } else {
      // kalau lebih dari 15 mb
      echo '
              <script>
                  alert("gambar kebesaran");
                  window.location.href="?halaman=dataproduk";
              </script>';
    }
  } else {
    //kalau tidak support
    echo '
              <script>
                  alert("File harus png/jpg");
                  window.location.href="?halaman=dataproduk";
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
          <i class="fas fa-plus-circle" style="margin-right: 5px"></i>Tambah Produk
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
                  <th>Nama</th>
                  <th>Supplier</th>
                  <th>Harga</th>
                  <th>Stok</th>
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
                $ambilsemuadatastock = mysqli_query($conn, "select * from view_data_produk");
                $i = 1;
                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {

                  $namabarang = $data['nama_produk'];
                  $supplier = $data['supplier'];
                  $stock = $data['stock'];
                  $idb = $data['id_produk'];
                  $harga = $data['harga'];

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
                    <td><?= $namabarang; ?></td>
                    <td><?= $supplier; ?></td>
                    <td><?= "Rp." . number_format($harga) . ",-"; ?></td>
                    <td><?= $stock; ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit<?= $idb; ?>"><i class="fas fa-pencil-alt" style="color: #fff"></i></button>
                      |
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idb; ?>"><i class="fas fa-trash"></i></button>

                      </button>
                    </td>
                  </tr>
                  <!-- delete  Modal  -->
                  <div class="modal fade" id="delete<?= $idb; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- edit  Modal  -->
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Barang?</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <form method="POST">
                          <div class="modal-body">
                            Apakah Anda yakin ingin menghapus <?= $namabarang; ?> ?
                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
                        </form>
                      </div>

                    </div>
                  </div>
          </div>

          <div class="modal fade" id="edit<?= $idb; ?>">
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
                    <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="supplier" value="<?= $supplier; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="harga" value="<?= $harga; ?>" class="form-control" required>
                    <br>
                    <input type="file" name="file" class="form-control">
                    <br>
                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                    <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      <?php
                };
                //update barang
                if (isset($_POST['updatebarang'])) {
                  $idb = $_POST['idb'];
                  $namabarang = $_POST['namabarang'];
                  $supplier = $_POST['supplier'];
                  $harga = $_POST["harga"];

                  //soal gambar
                  $allowed_extension = array('png', 'jpg');
                  $nama = $_FILES['file']['name']; //ngambil nama file gambar
                  $dot = explode('.', $nama);
                  $ekstensi = strtolower(end($dot));
                  $ukuran = $_FILES['file']['size'];
                  $file_tmp = $_FILES['file']['tmp_name'];

                  //penamaan file 
                  $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi; //menggabungkan nama file dengan nama

                  if ($ukuran == 0) {
                    //jika tidak ingin diupload
                    // $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi= '$deskripsi' where idbarang = '$idb'");
                    $update = mysqli_query($conn, "update data_produk set nama_produk='$namabarang', supplier= '$supplier', harga ='$harga'  where id_produk = '$idb'");
                    if ($update) {
                      echo '<script>
                      alert("Produk berhasil diupdate.");
                      window.location.href="?halaman=dataproduk";
                    </script>';
                    } else {
                      echo '<script>
                      alert("gagal di update.");
                      window.location.href="?halaman=dataproduk";
                    </script>';
                    }
                  } else {
                    //jika ingin upload
                    move_uploaded_file($file_tmp, 'images/' . $image);
                    $update = mysqli_query($conn, "update data_produk set nama_produk='$namabarang', supplier= '$supplier', gambar ='$gambar'  where id_produk = '$idb'");
                    if ($update) {
                      echo '<script>
                      alert("Produk berhasil diupdate.");
                      window.location.href="?halaman=dataproduk";
                    </script>';
                    } else {
                      echo '<script>
                      alert("gagal di update.");
                      window.location.href="?halaman=dataproduk";
                    </script>';
                    }
                  }
                }

                //menhapus barang dari stock
                if (isset($_POST['hapusbarang'])) {
                  $idb = $_POST['idb'];

                  $gambar = mysqli_query($conn, "select * from data_produk where id_produk='$idb'");
                  $get = mysqli_fetch_array($gambar);
                  $img = 'images/' . $get['gambar'];
                  unlink($img);

                  $hapus = mysqli_query($conn, "CALL delete_data_produk($idb);");
                  if ($hapus) {
                    echo '<script>
                      alert("Produk berhasil dihapus.");
                      window.location.href="?halaman=dataproduk";
                    </script>';
                  } else {
                    echo '<script>
                    alert("Produk gagal dihapus.");
                    window.location.href="?halaman=dataproduk";
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