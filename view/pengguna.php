<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data">
          <input type="text" name="username" placeholder="Username" class="form-control" required>
          <br>
          <input type="text" name="password" class="form-control" placeholder="Password" required>
          <br>
          <select name="hakakses" class="form-control">
            <option value="">- Pilih Hak Akses -</option>
            <option value="admin">Admin</option>
            <option value="kasir">kasir</option>
          </select>
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
include "koneksi/koneksi.php";
if (isset($_POST['addnewbarang'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hakakses = $_POST['hakakses'];
  $addtotable = mysqli_query($conn, "CALL InsertUser('$username', md5($password), '$password', '$hakakses')");

  if ($addtotable) {
    echo '<script>
                        alert("username berhasil ditambahkan.");
                        window.location.href="?halaman=pengguna";
                      </script>';
  } else {
    echo '<script>
                        alert("gagal");
                        window.location.href="?halaman=pengguna";
                      </script>';
  }
};
?>
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="button d-flex">
        <button type="button" class="btn btn-primary mt-2 mb-4 ml-auto" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus-circle" style="margin-right: 5px"></i>Tambah Pengguna
        </button>
      </div>
      <div class="card">
        <div class="card-body">
          <h3 class="mb-3">Pengguna</h3>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Username</th>
                  <th>Hak Akses</th>
                  <th class="d-flex justify-content-center">Aksi</th>
                </tr>
              </thead>
              <!-- <tbody>
                <tr>
                  <td>0851-8907-9453</td>
                  <td>Jl. Maju Mundur no 34, Sidoarjo</td>
                  <td>alipgacor@gmail.com</td>

                  <td class="d-flex justify-content-center align-items-center">
                    <a href="" class="btn btn-warning mx-2" title="Edit"><i class="fas fa-pencil-alt" style="color: #fff"></i></a>
                    |
                    <a href="" class="btn btn-danger mx-2" title="Hapus"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              </tbody> -->
              <tbody>
                <?php
                $ambilsemuadatastock = mysqli_query($conn, "select * from view_data_user");
                $i = 1;
                while ($data = mysqli_fetch_array($ambilsemuadatastock)) {

                  $username = $data['username'];
                  $hakakses = $data['level'];
                  $pass = $data['pass'];
                  $idu = $data['id_user'];
                ?>
                  <tr>
                    <td><?= $i++;?></td>
                    <td><?= $username; ?></td>
                    <td><?= $hakakses; ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit<?= $idu; ?>"><i class="fas fa-pencil-alt" style="color: #fff"></i></button>
                      |
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idu; ?>"><i class="fas fa-trash"></i></button>

                      </button>
                    </td>
                  </tr>
                  <!-- delete  Modal  -->
                  <div class="modal fade" id="delete<?= $idu; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- edit  Modal  -->
                        <div class="modal-header">
                          <h4 class="modal-title">Hapus Username?</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <form method="POST">
                          <div class="modal-body">
                            Apakah Anda yakin ingin menghapus <?= $username; ?> ?
                            <input type="hidden" name="idu" value="<?= $idu; ?>">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-danger" name="hapususer">Hapus</button>
                        </form>
                      </div>

                    </div>
                  </div>
          </div>

          <div class="modal fade" id="edit<?= $idu; ?>">
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
                    <input type="text" name="username" value="<?= $username; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="pass" value="<?= $pass; ?>" class="form-control" required>
                    <br>
                    <input type="hidden" name="idu" value="<?= $idu; ?>">
                    <button type="submit" class="btn btn-primary" name="updateuser">Submit</button>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      <?php
                };
                //update supplier
                if (isset($_POST['updateuser'])) {
                  $idu = $_POST['idu'];
                  $username = $_POST['username'];
                  $pass = $_POST['pass'];

                  $update = mysqli_query($conn, "CALL update_data_user2($idu,'$username',  md5($pass),'$pass');");
                  if ($update) {
                    echo '<script>
                      alert("Username berhasil diupdate.");
                      window.location.href="?halaman=pengguna";
                    </script>';
                  } else {
                    echo '<script>
                      alert("gagal di update.");
                      window.location.href="?halaman=pengguna";
                    </script>';
                  }
                }

                //menhapus barang dari stock
                if (isset($_POST['hapususer'])) {
                  $idu = $_POST['idu'];

                  $hapus = mysqli_query($conn, "CALL delete_data_user($idu);");
                  if ($hapus) {
                    echo '<script>
                      alert("username berhasil dihapus.");
                      window.location.href="?halaman=pengguna";
                    </script>';
                  } else {
                    echo '<script>
                    alert("username gagal dihapus.");
                    window.location.href="?halaman=pengguna";
                  </script>';
                  }
                };
      ?>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Nama Username</th>
          <th>Hak Akses</th>
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