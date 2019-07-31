<?php

require_once('header.php');

$data = new Database();
$list_pc = $data->getAllPc();

?>
<table class="table table-hover">
	<thead>
	<tr>
	<th>No</th>
	<th>Kode Inventori</th>
	<th>Nama Bagian</th>
	<th>Pemeliharaan Terakhir</th>
	<th>Selisih Hari</th>
	</tr>
	</thead>
	<tbody id="myTable">
	
		<?php
		$i=1;
		foreach ($list_pc as $key => $value) {
		?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $value['kode_inventori']; ?></td>
			<td><?php echo $value['nm_dept']; ?></td>
			<td><?php echo $data->tanggal_indo($value['tgl_terakhir'],true);  ?></td>
			<td><?php echo $value['perbedaan_hari'].' hari'; ?></td>
		</tr>
		<?php
		}

		?>
	
	</tbody>
</table>
<?php

require_once 'footer.php'
?>