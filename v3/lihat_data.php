<?php
require_once('header.php');

if(isset($_GET['cek'])){
	$id_pc = $_GET['cek'];

	$data = new Database();
	$get = $data->getPc($id_pc);

}

?>
<table class="table table-hover" >
	
	
	<?php

		foreach ($get as $key => $value) {
			?>
			<tr>
			<th>Kode Inventori</th>
			<td><?php echo $value['kode_inventori']; ?></td>
			</tr>
			<tr>
			<th>Nama Bagian</th>
			<td><?php echo $value['nm_dept']; ?></td>
			</tr>
			<tr>
			<th>Pemeliharaan Terakhir</th>
			<td><?php echo $data->tanggal_indo($value['tgl_terakhir'],true);  ?></td>
			</tr>
			<tr>
			<th>Jadwal Pemeliharaan</th>
			<td>ini datepicker</td>
			</tr>
			<tr>
            	<td>
            		
            	</td>
                <td>
                <input type="submit" name="edit" value="Simpan" class="tombol">
                </td>
                 <td>
                <input type="button" value="Kembali" onClick="history.go(-1);" class="tombol">
                </td>
            </tr>
			
	<?php
		}

	?>
</table>