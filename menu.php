<?php
if(!empty( $_SESSION['id_user'])){
include "koneksi.php";
?>
<!-- Fixed navbar -->
<style type="text/css">
<!--
.style2 {
	font-size: 22px;
	font-weight: bold;
	color: #CCFFFF;
}
-->
</style>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse"
data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-image" href=""><span class="style2">CV. Syailendra Elektronik</span> </a></div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="./admin.php">Beranda</a></li>
<li> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi <b class="caret"></b></a>
  <ul class="dropdown-menu">
   	<li><a href="./admin.php?hlm=barangmasukcari">Barang Servis Masuk</a></li>
   	<li><a href="./admin.php?hlm=barangpengerjaancari">Pengerjaan Barang Servis </a></li>
    <li><a href="./admin.php?hlm=barangKeluarcari">Barang Servis Keluar </a></li>
  </ul>	
</li>

  <?php
if( $_SESSION['level'] == 2 ){
?>
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Cari Data <b class="caret"></b></a>
  <ul class="dropdown-menu">
	<li><a href="./admin.php?hlm=carisparepart">Sparepart </a></li>
  </ul>
</li>
<?php
}
?>

<li> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="caret"></b></a>
  <ul class="dropdown-menu">
   	 <li><a href="./admin.php?hlm=laporanBrgmasuk">Laporan Barang Masuk</a></li>
   	 <li><a href="./admin.php?hlm=laporanPengerjaan">Laporan Pengerjaan </a></li>
     <li><a href="./admin.php?hlm=laporanBrgkeluar">Laporan Barang Keluar</a></li>
  </ul>	
</li>
</ul>
<ul class="nav navbar-nav">
  <!-- Jika level user admin, maka tampil Laporan dan Data Master -->
  <?php
if( $_SESSION['level'] == 1 ){
?>
  <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Master <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="./admin.php?hlm=user">Data User </a></li>
        <li><a href="./admin.php?hlm=teknisi">Data Teknisi</a></li>
        <li><a href="./admin.php?hlm=rekanan">Data Rekanan Perusahaan </a></li>
        <li><a href="./admin.php?hlm=sparepart">Data Sparepart</a></li>
        <li><a href="./admin.php?hlm=biayajasa">Data Biaya Jasa </a></li>
       </ul>
  </li>
  <?php
}
?>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php echo $_SESSION['nama']; ?> <b class="caret"></b>
</a>
<ul class="dropdown-menu">
<li><a href="logout.php">Logout</a></li>
</ul>
</li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
<?php
}
else{
header("Location: ./");
die();
}
?>