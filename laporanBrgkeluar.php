<?php
if(empty($_SESSION['id_user'])){
$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login
terlebih dahulu.';
header('Location: ./');
die();
}
else{
$data=0;
if(isset($_REQUEST['submit'])){
$submit = $_REQUEST['submit'];
$tgl1 = $_REQUEST['tgl1'];
$tgl2 = $_REQUEST['tgl2'];
$perusahaan= $_REQUEST['cobPerusahaan'];
if ($perusahaan=='semua'){
$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg,
										b.statusbrg_update, b.tgl_keluar,
										c.grand_total, c.potongan, c.total_bayar,
										d.keterangan
									from barang_servis a, statusbrg_update b , barang_keluar c, status_garansi d
									where a.kode_brg_servis=b.kode_brg_servis and a.kode_statusgaransi=d.kode_statusgaransi and a.kode_brg_servis=c.kode_brg_servis and b.tgl_keluar BETWEEN '$tgl1' AND '$tgl2' order by a.id_perusahaan ");					
}
else{
$sql = mysqli_query($koneksi, "select a.kode_brg_servis, a.id_perusahaan, a.type_brg,
									b.statusbrg_update, b.tgl_keluar,
									c.grand_total, c.potongan, c.total_bayar,
									d.keterangan
									from barang_servis a, statusbrg_update b, barang_keluar c, status_garansi d
									where a.kode_brg_servis=b.kode_brg_servis and a.kode_statusgaransi=d.kode_statusgaransi and a.kode_brg_servis=c.kode_brg_servis and a.id_perusahaan='$perusahaan' and b.tgl_keluar BETWEEN '$tgl1' AND '$tgl2' order by a.id_perusahaan ");						
}
					if(mysqli_num_rows($sql) > 0){
					$data=1;
					$no = 0;
					echo '<h2>Laporan Barang Servis Keluar ID Perusahaan = '.$perusahaan.' <small>'.$tgl1.' sampai '.$tgl2.'</small></h2><hr>
					<div class="col-sm-1">
					<a href="?hlm=laporanBrgkeluar" id="tombol" class="btn btn-info pullleft"><span class="glyphicon glyphicon-chevron-left" ariahidden="true"></span> Kembali</a><br/><br/><br/>
					</div>
					<div class="col-sm-1">
					<button id="tombol" onclick="window.print()" class="btn btn-warning"><span class="glyphicon glyphicon-print" ariahidden="true"></span> Cetak</button>
					</div>
					<div class="col-sm-12">
					<table class="table table-bordered" style="font-size:18px">
					<thead>
					<tr class="info">
					<th width="5%">No</th>
					<th width="11%">No. TTSM</th>
					<th width="8%">Merek</th>
					<th width="12%">Type Barang</th>
					<th width="15%">Status Barang</th>
					<th width="12%">Potongan</th>
					<th width="12%">Total Bayar</th>
					<th width="15%">Grand Total</th>
					<th width="15%">Tgl Keluar</th>
					</tr>
					</thead>
					<tbody>';
				while($row = mysqli_fetch_array($sql)){
				$no++;
				$id_perusahaan=$row['id_perusahaan'];
				$sqlmerek=mysqli_query($koneksi, "select merek from rekanan_perusahaan where id_perusahaan ='$id_perusahaan' ");
				list($merek)=mysqli_fetch_array($sqlmerek);

					echo '
					<tr>
					<td>'.$no.'</td>
					<td>'.$row['kode_brg_servis'].'</td>
					<td>'.$merek.'</td>
					<td>'.$row['type_brg'].'</td>
					<td>'.$row['keterangan'].'</td>
					<td align=right>'.number_format($row['potongan'],0,".",".").'</td>
					<td align=right>'.number_format($row['total_bayar'],0,".",".").'</td>
					<td align=right>'.number_format($row['grand_total'],0,".",".").'</td>
					<td>'.date("d M Y", strtotime($row['tgl_keluar'])).'</td> </tr> ' ;
					}
					
					echo ' 
						</tbody>
					</table>

					<div class="col-sm-12">
					<table class="table table-bordered" style="font-size:18px">
					<tr class="info">
						<th  width=20%>Jumlah Data Keluar</th>
						<th width=25%>Potongan Garansi</th>
						<th width=25%>Total Bayar</th>
						<th width=30%>Grand Total Biaya</th>
					</tr>';
					$tanggal = date('Y-m-d');
					$sql = mysqli_query($koneksi, "SELECT count(a.tgl_keluar),
															sum(b.grand_total), sum(b.potongan), sum(b.total_bayar)
													FROM statusbrg_update a, barang_keluar b
													WHERE a.kode_brg_servis=b.kode_brg_servis and a.tgl_keluar BETWEEN '$tgl1' AND '$tgl2' ");
					list($tgl_keluar,$grandtotal, $potongan, $totalbayar) = mysqli_fetch_array($sql);
					{

						echo '<tr>
								<td><span class="pull-right">'.$tgl_keluar. ' data</span></td>
								<td><span class="pull-right">RP. '.number_format($potongan,0,".","."). ' </span></td>
								<td><span class="pull-right">Rp. '.number_format($totalbayar,0,".","."). '</span></td>
								<td><span class="pull-right">Rp. '.number_format($grandtotal,0,".","."). '</span></td>
						</tr>';
					}
						echo '
					</table>
					</div>
					</div>
					</div>
					</div>';
					}
					else {
					echo " 
					<div class='alert alert-danger alert-dismissable'>
					<h4>Data Tidak Ditemukan!!</h4>
					</div>
					";}
	}
	if ($data<1){
echo '<h2>Laporan Barang Servis Keluar</h2><hr>';
?>
<div class="well well-sm noprint">
	<form class="form-inline" role="form" method="post" action="">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="tgl1">Mulai</label>
		</div>
		<div class="form-group">	
			<div class="col-sm-2">
				<input type="date" class="form-control" id="tgl1" name="tgl1" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="tgl2">Hingga</label>
		</div>	
		<div class="form-group">	
			<div class="col-sm-2">
				<input type="date" class="form-control" id="tgl2" name="tgl2" required>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-1">
			<label class="col-sm-3 control-label" for="tgl2">Perusahaan</label>
			</div>
		</div>	
		<div class="form-group">
			<div class="col-sm-2">
				<select name="cobPerusahaan" size="" class="form-control" required>
				<option value='semua'>Semua Data</option>";
				<?php
					$sql = mysqli_query($koneksi, "select * from rekanan_perusahaan  ");
					while($data = mysqli_fetch_array($sql)){
					echo "<option value='$data[id_perusahaan]'>$data[merek]---$data[nama_perusahaan]</option>";
					}
				?>
				</select>
			</div>
		</div>
			<button type="submit" name="submit" class="btn btn-success btn-s pull-right">Proses</button>
	</form>
</div>
<?php
echo '<div class="col-sm-6"><table class="table table-bordered style="font-size:18px"">';
echo '<h2>Rekap Laporan Barang Servis Keluar Hari Ini (<small>'.date('d-m-Y').'</small>)</h2><hr>';
echo '<tr class="info"> <th><h4>Jumlah Data Keluar</h4></th></tr>';
$tanggal = date('Y-m-d');

$sql = mysqli_query($koneksi, "SELECT count(tgl_keluar) FROM statusbrg_update WHERE tgl_keluar='$tanggal' ");
list($tgl_keluar) = mysqli_fetch_array($sql);
{
echo '<tr>
			<td><span class="pull-right">'.$tgl_keluar. ' data</span></td>
	</tr>';
}
echo '
</table>
<div class="col-sm-13">
<button id="tombol" onclick="window.print()" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-print" ariahidden="true"></span> Cetak</button>
</div>
</div>
</div>
</div>';
}

}
?>

<html><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<body>
</body>
</html>