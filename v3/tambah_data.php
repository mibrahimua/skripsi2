<?php
require_once('header.php');
$data = new Database();

if(isset($_GET['aksi'])){
$aksi = $_GET['aksi'];

if($aksi == "tambah_pc"){
   // var_dump($_POST['tgl_pemeliharaan']);
    $split = explode('-', $_POST['tgl_pemeliharaan']);
    $tgl_pemeliharaan = $split[2].'-'.$split[1].'-'.$split[0];
//var_dump($tgl_pemeliharaan);
  //var_dump($_POST);
  $data->tambahPc($_POST['kode_inventori'],$_POST['id_dept'],$tgl_pemeliharaan);
 }elseif($aksi == "tambah_dept"){
	//var_dump($_POST);
	$data->tambahDept($_POST['nm_dept']);

 }//end of elseif $aksi == "tambah_dept"
}//end of isset get update
?>

	<?php
if(isset($_GET['tipe'])){
	$tipe = $_GET['tipe'];
if($tipe == "pc"){


			?>
			<form action="tambah_data.php?aksi=tambah_pc" method="post">
			<table class="table table-hover" >
			<tr>
			<th>Kode Inventori</th>
			<td >
			<input type="text" name="kode_inventori" placeholder="Kode Inventori" class="form-control" required>
			</td>
			</tr>
			<tr>
			<th>Nama Bagian</th>
			<td>
			<select name="id_dept" class="form-control">
			<?php
			$dept = $data->getAllNmDept(0);
			foreach ($dept as $key => $value2) {
			?>
			<option value = <?php echo $value2['id_dept']; ?> ><?php echo $value2['nm_dept']; ?></option>";
			<?php
			}
			?>
			</select>
			</td>
			</tr>
			<tr>
			<th>Jadwal Pemeliharaan</th>
			<td>
				<input id="datepicker" name="tgl_pemeliharaan" class="form-control" required readonly="readonly"/>
			</td>
			</tr>
			
			
	<?php
	}elseif ($tipe == "dept") {
		?>
			<form action="tambah_data.php?aksi=tambah_dept" method="post">
			<table class="table table-hover" >
			<tr>
			<th>Nama Bagian</th>
			<td >
			<input type="text" name="nm_dept" placeholder="Nama Bagian" class="form-control" required>
			</td>
			</tr>

		<?php
	}	

	?>
	<tr>
    	<td>
       	</td>
        <td>
        <input type="submit" class="btn btn-primary" name="edit" value="Simpan" class="tombol">
        </td>
        <td>
        <input type="button" class="btn btn-warning" value="Kembali" onClick="history.go(-1);" class="tombol">
        </td>
    </tr>
</table>
</form>

<?php 
}
require_once 'footer.php' 
?>