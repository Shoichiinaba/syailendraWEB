<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
if(isset($_REQUEST['submit'])){
$id_perusahaan = $_REQUEST['id_perusahaan'];
$id_user=$_SESSION['id_user'];
$sql = mysqli_query($koneksi, "UPDATE rekanan_perusahaan SET status_delete=1, user_delete= '$id_user'

						WHERE id_perusahaan='$id_perusahaan'");
if($sql == true){
header("Location: ./admin.php?hlm=rekanan");
die();
}
}
}
?>