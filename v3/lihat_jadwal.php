<?php
require_once('header.php');
if(isset($_GET['hitung'])){
	

$coba = new Population(Population::$popSize,true);
$post = $coba->individu;
var_dump($post);echo '</br>';

$fit = new Fitnesscalc();
$get = $fit->getFitness($post);

foreach ($get as $key => $value) {
    $coba->setFitness($key,$value);
}

$maks_fitness = max($coba->fitness);
var_dump($maks_fitness);

$k = 0;
while ($maks_fitness >= 1.2) {

    $myPop = Population::evolvePopulation($coba);
    //$one = array();
    //array_push($one, $myPop->individu[0]);
    //$fit->getFitness($one);
 //   var_dump($myPop);
//echo "</br>";echo "</br>";
$get = $fit->getFitness($myPop->individu) ;
foreach ($get as $key => $value) {
    $myPop->setFitness($key,$value);
}
$maks_fitness = max($myPop->fitness);
//var_dump($maks_fitness);
$k++;
//echo "</br>";
//echo "putaran ke ".$k;
//echo "</br>";
if ( $k > Population::$maxiteration)
      {
        echo "\n-- Mencapai batas (".Population::$maxiteration.") iterasi \n..)";
          break;
      }
}
echo '</br>';
echo "Putaran generasi ke ".$k;
echo '</br>';
$saveData = new Database();
//Hapus terlebih dahulu solusi lama
$saveData->deleteHasilGenetik();
foreach ($myPop->individu as $key => $value) {

  //echo "HASIL AKHIR individu ".$value. '=  punya nilai fitness '.$myPop->fitness[$key].'</br>';
  $split = explode('|', $value);
  $save = $saveData->saveHasilGenetik($split[0],$key,$myPop->fitness[$key]);

	}
	?>php
	
<script type="text/javascript">alert('Data Telah Di Update'); window.location = 'lihat_jadwal.php';</script>
?>
<?php
}
$tampilData = new Database();
?>
<a href="lihat_jadwal.php?hitung" class="btn btn-primary">Hitung Jadwal</a>
<table class="table table-hover">
	<thead>
	<tr>
	<th>No</th>
	<th>Hari</th>
	<th>Kode Inventori</th>
	<th>Nama Bagian</th>
	<th>Pemeliharaan Terakhir</th>
	<th>Fitness</th>
	<th>Fungsi</th>
	</tr>
	</thead>
	<tbody id="myTable">
		<?php
		$get = $tampilData->getHasilGenetik();
		$i=1;
		foreach ($get as $key => $value) {
			//echo '<td>$i++</td>';
			?>
			<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $value['weekday']; ?></td>
			<td><?php echo $value['kode_inventori']; ?></td>
			<td><?php echo $value['nm_dept']; ?></td>
			<td><?php echo $tampilData->tanggal_indo($value['tgl_terakhir'],true);  ?></td>
			<td><?php echo $value['fitness']; ?></td>
			<td><a href="lihat_data.php?cek=<?php echo $value['id_pc'];?>" class="btn btn-success">Cek</a></td>
			</tr>
		<?php
		}

		?>
	</tbody>
</table>

<?php require_once 'footer.php' ?>