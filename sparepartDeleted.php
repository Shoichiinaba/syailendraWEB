<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$kode_part = $_REQUEST['kode_part'];
$id_user=$_SESSION['id_user'];
$sql = mysqli_query($koneksi, "UPDATE sparepart SET status_delete=1, user_delete= '$id_user'
						WHERE kode_part='$kode_part'");
if($sql == true){
header("Location: ./admin.php?hlm=sparepart");
die();
}
}
}
?>