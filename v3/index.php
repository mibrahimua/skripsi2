<?php

require_once('header.php');

$data = new Database();
$list_pc = $data->getAllPc();
if(isset($_GET['hapus'])){
	$id_pc = $_GET['hapus'];
		$data->hapusDataPc($id_pc);
}
?>
<table class="table table-hover">
	<thead>
	<tr>
	<th>No</th>
	<th>Kode Inventori</th>
	<th>Nama Bagian</th>
	<th>Pemeliharaan Terakhir</th>
	<th>Selisih Hari</th>
	<th>Fungsi</th>
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
			<td>
				<a href="edit_data.php?cek=<?php echo $value['id_pc']; ?>" class="btn btn-primary a-btn-slide-text">
		        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		        <span><strong>Edit</strong></span>            
		    	</a>

		    	<a href="index.php?hapus=<?php echo $value['id_pc']; ?>" class="btn btn-danger">
		      	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		        <span><strong>Delete</strong></span>            
		   		</a>
				
			</td>
		</tr>
		<?php
		}

		?>
	
	</tbody>
</table>
<?php

require_once 'footer.php'
?>