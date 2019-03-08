<html>
<body>


<form action="" method="POST" name="input">
nama anda: 
<select name="cobkodeprodu" class="form-control" onchange=""  required>
<option value='+'>-- Pilih Jenis Produk Sparepart --</option>";
<?php
$sql = mysqli_query($koneksi, "select*from jenis_produk");
while($data = mysqli_fetch_array($sql)){
echo "<option value='$data[kode_produk]'>$data[nama_produk]</option>";
}
?>
</select>
<input type="submit" name="Input" value="input" >
</form>

</body>
</html>

<?php
if(isset($_REQUEST['Input'])) {
	$nama=$_REQUEST['cobkodeprodu'];
	echo "nama anda : '$nama'.";
}
?>

<form action="" method="POST" name="cari">
<select name="cobkodeproduk" class="form-control" onchange=""  required>
<option value='+'>-- Pilih Jenis Produk Sparepart --</option>";
<?php
$sql = mysqli_query($koneksi, "select*from jenis_produk");
while($data = mysqli_fetch_array($sql)){
echo "<option value='$data[kode_produk]'>$data[nama_produk]</option>";
}
?>
</select>
<input type="submit" name="Cari" class="btn btn-info btn-s pull-right">Cari Sparepart</a>
</form>

<?php
if(isset($_REQUEST['Cari'])) {
	$nama=$_REQUEST['cobkodeproduk'];
	echo "nama anda : '$nama'.";
}
?>
