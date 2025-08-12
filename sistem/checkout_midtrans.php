<?php
session_start();
if (!isset($_SESSION['snap_token']) || !isset($_SESSION['id_transaksi'])) {
    echo "<div class='alert alert-danger'>Transaksi tidak ditemukan.</div>";
    exit;
}

$snapToken = $_SESSION['snap_token'];
$idTransaksi = $_SESSION['id_transaksi'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-YO4KXZoPmXnlRajb"></script>
</head>
<body>
    <h3>Memproses Pembayaran untuk Transaksi #<?= $idTransaksi ?></h3>
    <p>Mohon tunggu, halaman pembayaran akan muncul...</p>

    <script type="text/javascript">
        snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result){
                console.log("Success:", result);
                window.location.href = "berhasil.php?id=<?= $idTransaksi ?>";
            },
            onPending: function(result){
                console.log("Pending:", result);
                window.location.href = "pending.php?id=<?= $idTransaksi ?>";
            },
            onError: function(result){
                console.log("Error:", result);
                alert("Terjadi kesalahan saat pembayaran.");
                window.location.href = "gagal.php?id=<?= $idTransaksi ?>";
            }
        });
    </script>
</body>
</html>
