<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full"></div>

<div class="row" style="margin-right: 1px; margin-left: 1px">
  <div class="col-6 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center mb-4">
          <h4 class="card-title">Pilih Barang</h4>
          <div class="ml-auto"></div>
        </div>
        <div class="form">
          <form action="" class="row g-3">
            <div class="col-9 mb-3">
              <input type="text" class="form-control" placeholder="Kode Barang" />
            </div>
            <div class="col-3 mb-3">
              <button class="btn btn-primary btn-block">
                Pilih Barang
              </button>
            </div>
            <div class="col-12 mb-3">
              <label for="" form="form-label">Nama Barang</label>
              <input type="text" class="form-control" />
            </div>
            <div class="col-12 mb-3">
              <label for="" form="form-label">Harga Barang</label>
              <input type="text" class="form-control" />
            </div>
            <div class="col-12 mb-3">
              <label for="" form="form-label">Jumlah</label>
              <input type="text" class="form-control" />
            </div>
            <div class="col-12 mb-3">
              <label for="" form="form-label">Total</label>
              <input type="text" class="form-control" />
            </div>
            <div class="col-6 mb-3">
              <button class="btn btn-primary">
                <i class="fas fa-cart-plus" style="margin-right: 5px"></i>
                Tambahkan Ke Antrian
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center mb-4">
          <h4 class="card-title">Antrian Barang</h4>
          <div class="ml-auto"></div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Kode Antrian</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>123</td>
                <td>Pasir</td>
                <td>20</td>
                <td>Rp. 20.000</td>
                <td>
                  <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>