<?php
include "koneksi/koneksi.php"; // Sertakan file koneksi database (misalnya koneksi.php)

$id = $_GET['id'];

// Fungsi untuk mengambil data dari tabel 'transaksi'
function edit_transaksi($id)
{
	global $conn;
	$query = "SELECT * FROM table_transaksi WHERE kd_transaksi = '$id'";
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_assoc($result);
}

// Fungsi untuk mengambil total sub total dari tabel 'transaksi'
function select_sum_transaksi($id)
{
	global $conn;
	$query = "SELECT SUM(total_harga) AS total FROM table_transaksi WHERE kd_transaksi = '$id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	return $row['total'] ?? 0;
}

// Fungsi untuk mengambil detail transaksi dari tabel 'detailTransaksi'
function edit_detail_transaksi($id)
{
	global $conn;
	$query = "SELECT * FROM detailTransaksi WHERE kd_transaksi = '$id'";
	$result = mysqli_query($conn, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
	return $data;
}

// Fungsi untuk mengambil jumlah total barang dari tabel 'transaksi'
function select_sum_jumlah_barang($id)
{
	global $conn;
	$query = "SELECT SUM(jumlah_beli) AS total FROM table_transaksi WHERE kd_transaksi = '$id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	return $row['total'];
}

$data = edit_transaksi($id);
// $total = select_sum_transaksi($id);
$dataDetail = edit_detail_transaksi($id);
$jumlah_barang = select_sum_jumlah_barang($id);
$total = select_sum_transaksi($id);
$formatted_total = number_format($total, 2, ',', '.');


?>

<style>
	.col-sm-8 {
		background: white;
		padding: 20px;
	}

	@media print {
		table {
			align-content: center;
		}

		.ds {
			display: none;
		}

		.card {
			box-shadow: none;
			border: none;
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
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h4>Struk</h4>
							<p>Toko Baju D'ta collection</p>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">Kode Transaksi : <?php echo $id ?></div>
								<div class="col-sm-6">
									<p class="text-right"><span><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></span></p>
								</div>
							</div>
							<br>
							<table class="table table-striped table-bordered" width="80%">
								<tr>
									<td>Kode Antrian</td>
									<td>Nama Barang</td>
									<td>Harga Satuan</td>
									<td>Jumlah</td>
									<td>Sub Total</td>
								</tr>
								<?php foreach ($dataDetail as $dd) : ?>
									<tr>
										<td><?= $dd['kd_pretransaksi'] ?></td>
										<td><?= $dd['nama_barang'] ?></td>
										<td><?= $dd['harga_barang'] ?></td>
										<td><?= $dd['jumlah'] ?></td>
										<td><?php echo "Rp." . $formatted_total . ",-"; ?></td>
									</tr>
								<?php endforeach ?>
								<tr>
									<td colspan="2"></td>
									<td>Jumlah Pembelian Barang</td>
									<td><?php echo $jumlah_barang ?></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td colspan="2">Total</td>
									<td><?php echo "Rp." . number_format($total) . ",-" ?></td>
								</tr>
							</table>
							<br>
							<p>Tanggal Beli : <?php echo $data['tanggal_beli']; ?></p>
							<br>
							<a href="#" class="btn btn-info ds" onclick="window.print()"><i class="fa fa-print"></i> Cetak Struk</a>
							<a href="?halaman=kasir" class="btn btn-danger ds">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>