<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
header('Location: ./');
die();
} else{ if(isset($_REQUEST['submit'])){
$id_teknisi = $_REQUEST['id_teknisi'];
$id_user=$_SESSION['id_user'];
$sql = mysqli_query($koneksi, "UPDATE teknisi SET status_delete=1, user_delete= '$id_user'
					WHERE id_teknisi='$id_teknisi'");
if($sql == true){
header("Location: ./admin.php?hlm=teknisi");
die();
}
}
}
?>