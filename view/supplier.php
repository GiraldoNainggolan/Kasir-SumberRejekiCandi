<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="text" name="namasupplier" placeholder="Nama supplier" class="form-control" required>
          <br>
          <input type="text" name="contact" class="form-control" placeholder="Contact" required>
          <br>
          <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
          <br>
          <input type="text" name="produk" class="form-control" placeholder="Produk" required>
          <br>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="addnewsupplier">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php

include "koneksi/koneksi.php";
if (isset($_POST['addnewsupplier'])) {
  $namasupplier = $_POST['namasupplier'];
  $contact = $_POST['contact'];
  $alamat = $_POST['alamat'];
  $produk = $_POST['produk'];

  $addtotable = mysqli_query($conn, "CALL insert_data_supplier1('$namasupplier', '$contact','$alamat','$produk')");

  if ($addtotable) {
    echo '<script>
                        alert("supplier berhasil ditambahkan.");
                        window.location.href="?halaman=supplier";
                      </script>';
  } else {
    echo '<script>
                        alert("gagal");
                        window.location.href="?halaman=supplier";
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
          <i class="fas fa-plus-circle" style="margin-right: 5px"></i>Tambah Supplier
        </button>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="mb-3">Supplier</h3>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>Nama Supplier</th>
                  <th>Kontak</th>
                  <th>Alamat</th>
                  <th>Produk</th>
                  <th class="d-flex justify-content-center">Aksi</th>
                </tr>
              </thead>
              <!-- <tbody>
                <tr>
                  <td class="font-weight-medium">PT. Kalimun Jaya</td>
                  <td>0851-8907-9453</td>
                  <td>Jl. Maju Mundur no 34, Sidoarjo</td>
                  <td>Batu Bata, Pasir</td>
                  <td class="d-flex justify-content-center align-items-center">
                    <a href="" class="btn btn-warning mx-2" title="Edit"><i class="fas fa-pencil-alt" style="color: #fff"></i></a>
                    |
                    <a href="" class="btn btn-danger mx-2" title="Hapus"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              </tbody> -->
              <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn, "select * from view_data_supplier");
                $i = 1;
                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {

                  $namasupplier = $data['nama_supplier'];
                  $contact = $data['contact'];
                  $alamat = $data['alamat'];
                  $produk = $data['produk'];
                  $ids = $data['id_supplier'];
                ?>
                  <tr>

                    <td><?= $namasupplier; ?></td>
                    <td><?= $contact; ?></td>
                    <td><?= $alamat; ?></td>
                    <td><?= $produk; ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit<?= $ids; ?>"><i class="fas fa-pencil-alt" style="color: #fff"></i></button>
                      |
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $ids; ?>"><i class="fas fa-trash"></i></button>

                      </button>
                    </td>
                  </tr>
                  <!-- delete  Modal  -->
                  <div class="modal fade" id="delete<?= $ids; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- edit  Modal  -->
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Supplier?</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <form method="POST">
                          <div class="modal-body">
                            Apakah Anda yakin ingin menghapus <?= $namasupplier; ?> ?
                            <input type="hidden" name="ids" value="<?= $ids; ?>">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-danger" name="hapussupplier">Hapus</button>
                        </form>
                      </div>

                    </div>
                  </div>
          </div>

          <div class="modal fade" id="edit<?= $ids; ?>">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- edit  Modal  -->
                <div class="modal-header">
                  <h4 class="modal-title">Edit Supplier</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="namasupplier" value="<?= $namasupplier; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="contact" value="<?= $contact; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="produk" value="<?= $produk; ?>" class="form-control" required>
                    <br>
                    <input type="hidden" name="ids" value="<?= $ids; ?>">
                    <button type="submit" class="btn btn-primary" name="updatesupplier">Submit</button>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      <?php
                };
                //update supplier
                if (isset($_POST['updatesupplier'])) {
                  $ids = $_POST['ids'];
                  $namasupplier = $_POST['namasupplier'];
                  $contact = $_POST['contact'];
                  $alamat = $_POST['alamat'];
                  $produk = $_POST['produk'];

                    $update = mysqli_query($conn, "CALL update_data_supplier($ids,'$namasupplier', '$contact','$alamat','$produk');");
                    if ($update) {
                      echo '<script>
                      alert("Produk berhasil diupdate.");
                      window.location.href="?halaman=supplier";
                    </script>';
                    } else {
                      echo '<script>
                      alert("gagal di update.");
                      window.location.href="?halaman=supplier";
                    </script>';
                    }
                  }

                //menhapus barang dari stock
                if (isset($_POST['hapussupplier'])) {
                  $ids = $_POST['ids'];

                  $hapus = mysqli_query($conn, "CALL delete_data_supplier($ids);");
                  if ($hapus) {
                    echo '<script>
                      alert("Produk berhasil dihapus.");
                      window.location.href="?halaman=supplier";
                    </script>';
                  } else {
                    echo '<script>
                    alert("Produk gagal dihapus.");
                    window.location.href="?halaman=supplier";
                  </script>';
                  }
                };
      ?>
      <tfoot>
        <tr>
          <th>Nama Supplier</th>
          <th>Kontak</th>
          <th>Alamat</th>
          <th>Produk</th>
          <th class="d-flex justify-content-center">Aksi</th>
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