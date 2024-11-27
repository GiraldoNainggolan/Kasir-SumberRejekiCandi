<div class="container-fluid">
  <!-- *************************************************************** -->
  <!-- Start First Cards -->
  <!-- *************************************************************** -->
  <div class="card-group">
    <div class="card border-right">
      <div class="card-body">
        <div class="d-flex d-lg-flex d-md-block align-items-center">
          <?php
          // Koneksi ke database
          include "koneksi/koneksi.php";

          // Query untuk menghitung total stock barang
          $queryTotalStockBarang = "SELECT count(username) AS username FROM user";
          $resultTotalStockBarang = mysqli_query($conn, $queryTotalStockBarang);
          $rowTotalStockBarang = mysqli_fetch_assoc($resultTotalStockBarang);
          $totalStockBarang = $rowTotalStockBarang['username'];
          ?>
          <div>
            <div class="d-inline-flex align-items-center">
              <?php echo "<h2 class='text-dark mb-1 font-weight-medium'>$totalStockBarang</h2>"; ?>
            </div>
            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
              Total Pengguna
            </h6>
          </div>
          <div class="ml-auto mt-md-3 mt-lg-0">
            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
          </div>
        </div>
      </div>

    </div>
    <div class="card border-right">
      <div class="card-body">
        <div class="d-flex d-lg-flex d-md-block align-items-center">
          <?php
          // Koneksi ke database
          include "koneksi/koneksi.php";

          // Query untuk menghitung total stock barang
          $queryTotalStockBarang = "SELECT sum(total_harga) AS total_harga FROM table_transaksi";
          $resultTotalStockBarang = mysqli_query($conn, $queryTotalStockBarang);
          $rowTotalStockBarang = mysqli_fetch_assoc($resultTotalStockBarang);
          $totalStockBarang = $rowTotalStockBarang['total_harga'];
          ?>
          <div>
            <div class="d-inline-flex align-items-center">
              <?php
              echo "<h3 class='text-dark mb-1 font-weight-medium'>Rp. " . number_format($totalStockBarang, 0, ',', '.') . ",-</h3>";
              ?>
            </div>
            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
              Total pendapatan
            </h6>
          </div>
          <div class="ml-auto mt-md-3 mt-lg-0">
            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="card border-right">
      <div class="card-body">
        <div class="d-flex d-lg-flex d-md-block align-items-center">
          <?php
          // Koneksi ke database


          // Query untuk menghitung total stock barang
          $queryTotalStockBarang = "SELECT sum(stock) AS stock FROM data_produk";
          $resultTotalStockBarang = mysqli_query($conn, $queryTotalStockBarang);
          $rowTotalStockBarang = mysqli_fetch_assoc($resultTotalStockBarang);
          $totalStockBarang = $rowTotalStockBarang['stock'];
          ?>
          <div>
            <div class="d-inline-flex align-items-center">
              <?php echo "<h2 class='text-dark mb-1 font-weight-medium'>$totalStockBarang</h2>"; ?>
            </div>
            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
              Total Stok
            </h6>
          </div>
          <div class="ml-auto mt-md-3 mt-lg-0">
            <span class="opacity-7 text-muted"><i data-feather="briefcase"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="d-flex d-lg-flex d-md-block align-items-center">
          <?php
          // Koneksi ke database


          // Query untuk menghitung total stock barang
          $queryTotalStockBarang = "SELECT count(kd_transaksi) AS kd_transaksi FROM table_transaksi";
          $resultTotalStockBarang = mysqli_query($conn, $queryTotalStockBarang);
          $rowTotalStockBarang = mysqli_fetch_assoc($resultTotalStockBarang);
          $totalStockBarang = $rowTotalStockBarang['kd_transaksi'];
          ?>
          <div>
            <div class="d-inline-flex align-items-center">
              <?php echo "<h2 class='text-dark mb-1 font-weight-medium'>$totalStockBarang</h2>"; ?>
            </div>
            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
              Total transaksi
            </h6>
          </div>
          <div class="ml-auto mt-md-3 mt-lg-0">
            <span class="opacity-7 text-muted"><i data-feather="clock"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- *************************************************************** -->
<!-- End First Cards -->
<!-- Start Top Leader Table -->
<!-- *************************************************************** -->

<!-- *************************************************************** -->
<!-- End Top Leader Table -->
<!-- *************************************************************** -->
</div>