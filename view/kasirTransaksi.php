<?php
ob_start();
include "koneksi/koneksi.php";

// Generate autocode for transactions and pre-transactions
$transkodeQuery = "SELECT MAX(RIGHT(kd_transaksi, 3)) AS max_id FROM table_transaksi";
$transkodeResult = mysqli_query($conn, $transkodeQuery);
$transkodeData = mysqli_fetch_assoc($transkodeResult);
$transkode = "TR" . sprintf("%03s", ((int)$transkodeData['max_id'] + 1));

$antrianQuery = "SELECT MAX(RIGHT(kd_pretransaksi, 3)) AS max_id FROM table_pretransaksi";
$antrianResult = mysqli_query($conn, $antrianQuery);
$antrianData = mysqli_fetch_assoc($antrianResult);
$antrian = "AN" . sprintf("%03s", ((int)$antrianData['max_id'] + 1));

// Select all items from the table
$barangsQuery = "SELECT * FROM view_data_produk";
$barangsResult = mysqli_query($conn, $barangsQuery);
$barangs = [];
while ($row = mysqli_fetch_assoc($barangsResult)) {
    $barangs[] = $row;
}

if (isset($_GET['getItem'])) {
    $id = $_GET['id'];
    $dataRQuery = "SELECT * FROM view_data_produk WHERE id_produk = '$id'";
    $dataRResult = mysqli_query($conn, $dataRQuery);
    $dataR = mysqli_fetch_assoc($dataRResult);
}

// Calculate the sum of sub_totals
$sumQuery = "SELECT SUM(sub_total) AS total_sum FROM table_pretransaksi";
$sumResult = mysqli_query($conn, $sumQuery);
$sum = mysqli_fetch_assoc($sumResult)['total_sum'];

// Count the number of pre-transactions
$sql2 = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec2 = mysqli_query($conn, $sql2);
$assoc2 = mysqli_fetch_assoc($exec2);

if (isset($_POST['btnAdd'])) {
    if (!isset($_SESSION['transaksi'])) {
        $_SESSION['transaksi'] = true;
    }
    $kd_transaksi = $_POST['kd_transaksi'];
    $kd_pretransaksi = $_POST['kd_pretransaksi'];
    $barang = $_POST['kd_barang'];
    $jumlah = $_POST['jumlah'];

    // Ambil harga satuan dari barang
    $hargaQuery = "SELECT harga FROM view_data_produk WHERE id_produk = '$barang'";
    $hargaResult = mysqli_query($conn, $hargaQuery);
    $hargaData = mysqli_fetch_assoc($hargaResult);
    $harga = $hargaData['harga'];

    // Hitung total
    $total = $harga * $jumlah;

    if ($kd_transaksi == "" || $kd_pretransaksi == "" || $barang == "" || $jumlah == "" || $total == "") {
        // $response = ['response' => 'negative', 'alert' => 'Lengkapi field'];
        echo '<script>
            alert("Lengkapi Field.");
            </script>';
    } else {
        if ($jumlah < 1) {
            // $response = ['response' => 'negative', 'alert' => 'Pembelian minimal 1'];
            echo '<script>
            alert("Pembelian minimal 1");
            </script>';
        } else {
            $sisaQuery = "SELECT * FROM view_data_produk WHERE id_produk = '$barang'";
            $sisaResult = mysqli_query($conn, $sisaQuery);
            $sisa = mysqli_fetch_assoc($sisaResult);

            if ($sisa['stock'] < $jumlah) {
                // $response = ['response' => 'negative', 'alert' => 'Stok tersisa ' . $sisa['stock']];
                echo '<script>
            alert("stok kurang .");
            </script>';
            } else {
                $sql = "SELECT * FROM table_pretransaksi WHERE kd_transaksi = '$kd_transaksi' AND kd_barang = '$barang'";
                $exe = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($exe);
                $dta = mysqli_fetch_assoc($exe);

                if ($num > 0) {
                    $jumlah = $dta['jumlah'] + $jumlah;
                    $total = $harga * $jumlah;
                    $value = "jumlah='$jumlah', sub_total='$total'";
                    $updateQuery = "UPDATE table_pretransaksi SET $value WHERE kd_transaksi = '$kd_transaksi' AND kd_barang = '$barang'";
                    mysqli_query($conn, $updateQuery);
                    // header("location:index.php?halaman=kasir");
                    echo '<script>
                        window.location.href="?halaman=kasir";
                      </script>';
                } else {
                    // stok_barang
                    $insertQuery = "INSERT INTO table_pretransaksi (kd_pretransaksi, kd_transaksi, kd_barang, jumlah, sub_total) VALUES ('$kd_pretransaksi', '$kd_transaksi', '$barang', '$jumlah', '$total')";
                    mysqli_query($conn, $insertQuery);
                    echo '<script>
                        window.location.href="?halaman=kasir";
                      </script>';
                }
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM table_pretransaksi WHERE kd_pretransaksi = '$id'";
    mysqli_query($conn, $deleteQuery);
    // header("location:index.php?halaman=kasir");
    echo '<script>
        window.location.href="?halaman=kasir";
            </script>';
}
?>


<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Pilih Barang</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Kode Transaksi</label>
                                        <input style="font-weight: bold; color: red;" type="text" class="form-control" value="<?= $transkode; ?>" readonly name="kd_transaksi">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kode Antrian</label>
                                        <input style="font-weight: bold; color: red;" type="text" class="form-control" value="<?= $antrian; ?>" readonly name="kd_pretransaksi" id="antrian">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="kd_barang" readonly placeholder="Kode barang" value="<?php echo @$dataR['id_produk'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <a class="btn btn-primary btn-block" href="#fajarmodal" data-toggle="modal">Pilih Barang</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-4"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_barang" value="<?php echo @$dataR['nama_produk']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Harga Barang</label>
                                            <input type="text" class="form-control" max="100" name="harba" value="<?php echo @$dataR['harga']; ?>" id="harba" readonly="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input type="number" class="form-control" name="jumlah" value="" id="jumjum" min="0" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total</label>
                                            <input type="text" class="form-control" max="100" name="total" readonly id="totals">
                                        </div>
                                        <button class="btn btn-primary" name="btnAdd"><i class="fa fa-cart-plus"></i> Tambahkan ke Antrian</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Antrian Barang</h3>
                        </div>
                        <div class="card-body">
                            <?php if ($assoc2['count'] > 0 || isset($_POST['btnAdd'])) : ?>
                                <a class="btn btn-success" id="pembayaran" href="?halaman=kasirPembayaran">Lanjutkan ke pembayaran <i class="fa fa-cart-arrow-down"></i></a>
                            <?php endif ?>
                            <br><br>
                            <?php
                            $transkodeQuery = "SELECT MAX(RIGHT(kd_transaksi, 3)) AS max_id FROM table_transaksi";
                            $transkodeResult = mysqli_query($conn, $transkodeQuery);
                            $transkodeData = mysqli_fetch_assoc($transkodeResult);
                            $transkode = "TR" . sprintf("%03s", ((int)$transkodeData['max_id'] + 1));

                            // Modified query to join with view_data_produk to get nama_barang
                            $datasQuery = "
                                SELECT p.kd_pretransaksi, p.jumlah, p.sub_total, v.nama_produk
                                FROM table_pretransaksi p
                                JOIN view_data_produk v ON p.kd_barang = v.id_produk
                                WHERE p.kd_transaksi = '$transkode'
                            ";
                            $datasResult = mysqli_query($conn, $datasQuery);
                            $datas = [];
                            while ($row = mysqli_fetch_assoc($datasResult)) {
                                $datas[] = $row;
                            }

                            $totalSumQuery = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
                            $totalSumResult = mysqli_query($conn, $totalSumQuery);
                            $assoc = mysqli_fetch_assoc($totalSumResult);
                            ?>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Kode Antrian</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                    <td>Batal beli</td>
                                </tr>
                                <?php
                                if (count($datas) > 0) {
                                    $no = 1;
                                    foreach ($datas as $dd) { ?>
                                        <tr>
                                            <td><?= $dd['kd_pretransaksi']; ?></td>
                                            <td><?= $dd['nama_produk']; ?></td>
                                            <td><?= $dd['jumlah']; ?></td>
                                            <td><?= "Rp. " . number_format($dd['sub_total'], 0, ',', '.') . ",-"; ?></td>
                                            <td class="text-center">
                                                <a href="#" id="btdelete<?php echo $no; ?>" class="btn btn-danger">Batal</a>
                                            </td>
                                        </tr>
                                        <script src="vendor/jquery-3.2.1.min.js"></script>
                                        <script>
                                            $("#btdelete<?php echo $no; ?>").click(function() {
                                                swal({
                                                    title: "Hapus",
                                                    text: "Yakin Hapus?",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    confirmButtonText: "Yes",
                                                    cancelButtonText: "Cancel",
                                                    closeOnConfirm: false,
                                                    closeOnCancel: true
                                                }, function(isConfirm) {
                                                    if (isConfirm) {
                                                        window.location.href = "?halaman=kasir&delete&id=<?= $dd['kd_pretransaksi']; ?>";
                                                    }
                                                })
                                            })
                                        </script>
                                    <?php $no++;
                                    } ?>
                                    <?php if ($assoc['sub'] != "") : ?>
                                        <tr>
                                            <td colspan="4">Total Harga</td>
                                            <td><?php echo "Rp. " . number_format($assoc['sub'], 0, ',', '.') . ",-"; ?></td>
                                        </tr>
                                    <?php endif ?>
                                <?php } else { ?>
                                    <td colspan="5" class="text-center">Tidak ada antrian</td>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fajarmodal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Barang</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                        <tr>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Harga</td>
                            <td>Stok</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangs as $brs) { ?>
                            <tr>
                                <td><a href="index.php?halaman=kasir&getItem&id=<?php echo $brs['id_produk'] ?>"><?php echo $brs['id_produk'] ?></a></td>
                                <td><?php echo $brs['nama_produk'] ?></td>
                                <td><?php echo $brs['harga'] ?></td>
                                <td><?php echo $brs['stock'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#barang_nama').change(function() {
            var barang = $(this).val();
            $.ajax({
                type: "POST",
                url: 'ajaxTransaksi.php',
                data: {
                    'selectData': barang
                },
                success: function(data) {
                    $("#harba").val(data);
                    $("#jumjum").val();
                    var jum = $("#jumjum").val();
                    var kali = data * jum;
                    $("#totals").val(kali);
                }
            })
        });

        $('#jumjum').keyup(function() {
            var jumlah = $(this).val();
            var harba = $('#harba').val();
            var kali = harba * jumlah;
            $("#totals").val(kali);
        });

        $('#bayar').keyup(function() {
            var bayar = $(this).val();
            var total = $('#tot').val();
            var kembalian = bayar - total;
            $('#kem').val(kembalian);
        })
    })
</script>