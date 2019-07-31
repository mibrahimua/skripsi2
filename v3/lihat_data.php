<?php
require_once('header.php');
$data = new Database();

if(isset($_GET['aksi'])){
$aksi = $_GET['aksi'];

if($aksi == "update"){
   // var_dump($_POST['tgl_pemeliharaan']);
    $split = explode('/', $_POST['tgl_pemeliharaan']);
    $tgl_pemeliharaan = $split[2].'-'.$split[0].'-'.$split[1];
//var_dump($tgl_pemeliharaan);
  // var_dump($_POST);
   $data->updatePc($_POST['id_pc'],$_POST['id_dept'],$tgl_pemeliharaan);
 }
}//end of isset get update
?>
<form action="lihat_data.php?aksi=update" method="post">
	

<table class="table table-hover" >
	
	
	<?php
if(isset($_GET['cek'])){
	$id_pc = $_GET['cek'];

	
	$get = $data->getPc($id_pc);


		foreach ($get as $key => $value) {
			?>
			<tr>
			<th>Kode Inventori</th>
			<td >
			<input type="hidden" name="id_pc" value="<?php echo $value['id_pc']; ?>">
			<input type="text" name="kode_inventori" value="<?php echo $value['kode_inventori']; ?>" class="form-control" disabled>
			</td>
			</tr>
			<tr>
			<th>Nama Bagian</th>
			<td>
			<select name="id_dept" class="form-control">
			<option value = <?php echo $value['id_dept']; ?> ><?php echo $value['nm_dept']; ?></option>";
			<?php
			$dept = $data->getAllNmDept($value['id_dept']);
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
			<th>Pemeliharaan Terakhir</th>
			<td>
			<input type="text" name="tgl_terakhir" value="<?php  echo $data->tanggal_indo($value['tgl_terakhir'],true); ?>" class="form-control" disabled>
			</td>
			</tr>
			<tr>
			<th>Jadwal Pemeliharaan</th>
			<td>
				<input id="datepicker" name="tgl_pemeliharaan" class="form-control" required />
			</td>
			</tr>
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
			
	<?php
		}
}
	?>
</table>
</form>

<?php require_once 'footer.php' ?>