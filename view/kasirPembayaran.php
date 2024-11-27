<?php
ob_start();
include "koneksi/koneksi.php";
// Generate the transaction code
$sql = "SELECT kd_transaksi FROM table_transaksi ORDER BY kd_transaksi DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$transkode = ($row) ? 'TR' . str_pad(substr($row['kd_transaksi'], 2) + 1, 3, '0', STR_PAD_LEFT) : 'TR001';

// Get total and quantity from pre-transactions
$sql = "SELECT SUM(sub_total) as sub, SUM(jumlah) as jum FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$exec = mysqli_query($conn, $sql);
$assoc = mysqli_fetch_assoc($exec);

// Check the number of pre-transactions
$sql = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$transkode'";
$assoc2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
if ($assoc2['count'] <= 0) {
    // header("location:index.php?halaman=kasir");
    echo '<script>
            window.location.href="?halaman=kasir";
        </script>';
}

if (isset($_POST['selesaiGet'])) {
    $total  = $_POST['tot'];
    $bayar  = $_POST['bayar'];
    $kem    = $_POST['kem'];
    if ($bayar == "" || $kem == "") {
        // $response = ['response' => 'negative', 'alert' => 'Bayar dahulu'];
        echo '<script>
                        alert("Bayar Dulu.");
                       
                      </script>';
    } else {
        if ($bayar < $total) {
            // $response = ['response' => 'negative', 'alert' => 'Uang Kurang'];
            echo '<script>
                        alert("Uang Kurang.");
                      </script>';
        } else {
            
            $sql = "INSERT INTO table_transaksi (kd_transaksi, kd_user, jumlah_beli, total_harga) VALUES ('$transkode', '0', '{$assoc['jum']}', '{$assoc['sub']}')";
            if (mysqli_query($conn, $sql)) {
                // $response = ['response' => 'positive', 'alert' => 'Transaksi berhasil'];
                echo '<script>
                        alert("Transaksi berhasil");
                      </script>';
                unset($_SESSION['transaksi']);
                // echo '<script>
                //     window.location.href="?halaman=kasir";
                // </script>';
                echo '<script> window.location.href="?halaman=struk&id=' . $transkode . '"; </script>';
            } else {
                // $response = ['response' => 'negative', 'alert' => 'Terjadi kesalahan'];
                echo '<script>
                        alert("Terjadi kesalahan.");    
                      </script>';
            }
        }
    }
}
?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 offset-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Kode Transaksi</label>
                                        <input type="text" class="form-control" name="autokode" id="autokode" value="<?php echo $transkode ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Total harga</label>
                                        <input type="text" class="form-control" name="tot" id="tot" value="<?php echo $assoc['sub'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bayar</label>
                                        <input type="text" class="form-control" name="bayar" id="bayar">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kembalian</label>
                                        <input type="text" class="form-control" name="kem" id="kem" readonly="">
                                    </div>
                                    <button class="btn btn-primary" name="selesaiGet"><i class="fa fa-cart-plus"></i> Selesai</button>
                                    <a href="?halaman=kasir" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function() {
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
        });
    })
</script>