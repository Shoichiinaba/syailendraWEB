<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$kode_jasa = $_REQUEST['kode_jasa'];
$id_user=$_SESSION['id_user'];
$sql = mysqli_query($koneksi, "UPDATE biaya_jasa SET status_delete=1, user_delete= '$id_user'
							WHERE kode_jasa='$kode_jasa'");

if($sql == true){
header("Location: ./admin.php?hlm=biayajasa");
die();
}
}
}
?>