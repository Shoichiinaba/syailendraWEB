<?php
session_start();
if( empty( $_SESSION['id_user'] ) ){
//session_destroy();
$_SESSION['err'] = '<strong>ERROR!</strong> Silahkan Login Terlebih Dahulu.';
header('Location: ./');
die();
} 
else {
include "koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="description" content="FTIK USM">
<meta name="author" content="Joko Suntoro">
<title>CV. Syailendra Elektronik</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/jquery-ui.min.css" rel="stylesheet">
<style type="text/css">
body {
min-height: 200px;
padding-top: 70px;
}
@media print {
.container {
margin-top: -30px;
}
#tombol,
.noprint {
display: none;
}
}
</style>
</head>
<body>
<?php include "menu.php"; ?>
<div class="container">
<?php
if( isset($_REQUEST['hlm'] )){
$hlm = $_REQUEST['hlm'];
switch( $hlm ){
case 'user':
include "user.php";
break;

case 'teknisi':
include "teknisi.php";
break;

case 'sparepart':
include "sparepart.php";
break;

case 'carisparepart':
include "carisparepart.php";
break;

case 'sparepartAdd':
include "sparepartAdd.php";
break;

case 'sparepartEdit':
include "sparepartEdit.php";
break;

case 'sparepartDeleted':
include "sparepartDeleted.php";
break;

case 'laporanBrgmasuk':
include "laporanBrgmasuk.php";
break;

case 'laporanBrgkeluar':
include "laporanBrgkeluar.php";
break;

case 'laporanPengerjaan':
include "laporanPengerjaan.php";
break;

case 'rekanan':
include "rekanan.php";
break;

case 'biayajasa':
include "biayajasa.php";
break;

case 'barangmasukprint':
include 'barangMasukprint.php';
break;

case 'barangmasukcari':
include 'barangMasukcari.php';
break;

case 'barangpengerjaancari':
include 'barangPengerjaancari.php';
break;

case 'barangpengerjaanadd':
include 'barangPengerjaanadd.php';
break;

case 'barangpengerjaanEdit':
include 'barangPengerjaanedit.php';
break;

case 'pengerjaanData':
include 'pengerjaanData.php';
break;

case 'pengerjaanPrint':
include 'pengerjaanPrint.php';
break;

case 'penggunaanpartAdd':
include "penggunaanpartAdd.php";
break;

case 'penggunaanpartDeleted':
include "penggunaanpartDeleted.php";
break;

case 'barangKeluarcari':
include 'barangKeluarcari.php';
break;

case 'barangKeluardata':
include 'barangKeluardata.php';
break;

case 'barangKeluarprint':
include 'barangKeluarprint.php';
break;

case 'barangmasukdata':
include 'barangMasukdata.php';
break;

case 'barangmasukedit':
include 'barangMasukedit.php';
break;

case 'barangmasuk':
include "barangMasuk.php";
break;

}
} else {
?>
</span>
<div class="jumbotron">
<h2>Selamat Datang.</h2>
<p>Halo <strong><?php echo $_SESSION['nama']; ?></strong>,
Anda login sebagai
<strong>
<?php
if($_SESSION['level'] == 1){
echo 'Supervisor Admin.';
}
else{
echo 'Admin.';
}
?>
</strong></p>
</div>
<?php
}
?>
</div>
<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
</body>
</html>
<?php
}
?>