<?php
class database{
	public static $crossover_rate = 0.8;
	public static $mutate_rate = 0.1;
	public static $poolSize = 12;
	public $putaran = 0;
	public static $maxGeneration = 5000;
 function __construct()
    {
    	  $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "skripsi2";
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;

        $connect = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if($connect->error){
            die('Could not connect with the database!');
        }

        $this->connect = $connect;
    }
public function connect()
    {
        $this->__construct($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
    }
public static function random() {
  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
}    

public function getAllPc(){
	$query = "SELECT p.id_pc,p.kode_inventori,d.nm_dept,tgl_terakhir,DATEDIFF(NOW(),p.tgl_terakhir) AS perbedaan_hari FROM data_pc p JOIN department d ON p.id_dept = d.id_dept;";

	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function getPc($id_pc){
	$query = "SELECT p.id_pc,p.kode_inventori,d.id_dept,d.nm_dept,tgl_terakhir,DATEDIFF(NOW(),p.tgl_terakhir) AS perbedaan_hari FROM data_pc p JOIN department d ON p.id_dept = d.id_dept WHERE p.id_pc = $id_pc";

	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function getNmDept($id_dept){
	$query = "SELECT id_dept,nm_dept FROM department WHERE id_dept = '$id_dept'";

	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function getAllNmDept($id_dept){
	$query = "SELECT id_dept,nm_dept FROM department WHERE id_dept != '$id_dept' ";

	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function updatePc($id_pc,$id_dept,$tgl_pemeliharaan){
	
	$query = "UPDATE data_pc SET id_dept = '$id_dept', tgl_terakhir = '$tgl_pemeliharaan' WHERE id_pc ='$id_pc'";

	$data = $this->connect -> query($query);
		if($data){
	$query = "DELETE FROM hasil_genetik WHERE id_pc = '$id_pc'";
	$data = $this->connect->query($query);
  ?>
   <script type="text/javascript">alert('Data Tersimpan'); window.location = 'lihat_jadwal.php';</script>
     <?php }else{?>
   <script type="text/javascript">alert('Ops, Ada Kesalahan'); window.location = 'index.php';</script>
  <?php 
		}
  }

public function getPoolPc(){
	$query = "SELECT id_pc,DATEDIFF(NOW(),tgl_terakhir) AS perbedaan_hari,DAYOFWEEK(tgl_terakhir) AS hari_terakhir FROM data_pc WHERE DATEDIFF(NOW(),tgl_terakhir) > 30 ORDER BY RAND();";
	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function deleteHasilGenetik(){
	$query_trunc = "TRUNCATE hasil_genetik";
	$data = $this->connect -> query($query_trunc);

	if($data){
		return true;
	}else{
		return false;
	}

}

public function saveHasilGenetik($id_pc,$weekday,$fitness){
	$query = "INSERT INTO hasil_genetik (id_pc,weekday,kode_inventori,id_dept,tgl_terakhir,fitness)
			SELECT id_pc,$weekday,kode_inventori,id_dept,tgl_terakhir,$fitness FROM data_pc WHERE id_pc = $id_pc;";
	$data = $this->connect -> query($query);
	if($data){
		return true;
	}else{
		return false;
	}

}

public function getHasilGenetik(){
	//UPDATE data_pc SET tgl_terakhir = (SELECT timestamp('2019-05-30') - INTERVAL FLOOR( RAND( ) * 60) DAY);
	$query = "SELECT h.id_pc,s.nama_hari as weekday,h.kode_inventori,d.nm_dept,h.tgl_terakhir,h.fitness FROM hasil_genetik h JOIN department d ON h.id_dept = d.id_dept JOIN slot_waktu s ON h.weekday = s.id_slot";
	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function getMutatePc(){
	$randomId = rand(1, 30);
	$query = "SELECT id_pc,DATEDIFF(NOW(),tgl_terakhir) AS perbedaan_hari,DAYOFWEEK(tgl_terakhir) AS hari_terakhir,
			(SELECT s.weekday FROM slot_waktu s ORDER BY RAND() LIMIT 1 ) AS weekday
			FROM data_pc ORDER BY RAND() limit 1";
	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function getDept(){
	$randomId = rand(1, 30);
	$query = "SELECT * FROM department ORDER BY RAND() LIMIT 1";
	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
			$hasil[]=$d;
	}
	return $hasil;
}

public function getWaktu(){
	$query = "SELECT id_slot FROM slot_waktu ORDER BY id_slot ASC";
	$data = $this->connect -> query($query);

	$row = mysqli_num_rows($data);

	for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		    $this->setSlotWaktu($d['id_slot'],$d['id_slot']);
		}
	}
public function getMeanAll(){
	$query = "SELECT id_pc, (monitor_pc + mouse_pc + keyboard_pc + kipasproces_pc + hdd_pc + ram_pc + process_pc) AS nilai_gen FROM data_pc";
	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		   $this->setMean($d['id_pc'],$d['nilai_gen']);
	}
}


public function fitnessCalc($pop){
	foreach ($pop->NilaiGenPc as $key => $value) {
		$nilai_fitness = $value/7;
		if($nilai_fitness < 2.5){
			//beri nilai 0
			$pop->setFitness($key,1);
		}else{
			$pop->setFitness($key,0);
		}
	}

}

public function findDuplicates($pop)
{
	$array = $pop->NilaiGenPc;

    $unique = array_unique($array);

	// Duplicates
	$duplicates = array_diff_assoc($array, $unique);
	
	// Unique values
	$result = array_diff($unique, $duplicates);

	// Get the unique keys
	$unique_keys = array_keys($result);

	// Get duplicate keys
	$duplicate_keys = array_keys(array_intersect($array, $duplicates));
	
	//jika individu unik maka nilai bobot = 1
	foreach ($unique_keys as $key) {
	$pop->setFitness($key,1);
		}
	//jika individu terdapat kesamaan maka nilai bobot = 0
	foreach ($duplicate_keys as $key) {
		$pop->setFitness($key,0);
		}	
}

public function selection($pop){
	$sort = array();
	foreach ($pop->fitness as $key => $value) {
		if($value == 1){
			array_push($sort, $key);
			array_push($sort, $key);
		}else{
			array_push($sort, $key);
		}

	}
	$rand = rand(0, count($sort)-1);
	
	return $sort[$rand];
}

public static function  crossover($pop,$indiv1, $indiv2) 
{
       
            // Crossover at which point 0..1 , .50 50% of time
            if (  database::random() > database::$crossover_rate)
			{

			//	echo "tidak ada crossover";
            } else {
            	$temp_kode = $pop->kode_inventori[$indiv2];
            	$temp_nilai = $pop->NilaiGenPc[$indiv2];
            	$pop->saveIndividu($indiv2, $pop->kode_inventori[$indiv1],$pop->NilaiGenPc[$indiv1] );

                $pop->saveIndividu($indiv1, $temp_kode,$temp_nilai );
            	echo "ada crossover ".$indiv1.' dan '.$indiv2;echo '</br>';
            }
        
      //  return $newSol;
}

public static function mutasi($pop) {
        // Loop through genes
       
        $index = $pop->kromosom;
        foreach ($index as $key => $value) {
        	if (  database::random() <= database::$mutate_rate) {

        		
        		//rand(0, 11) adalah range dari slot waktu
        		$randomId = rand(1, 30);
        		//echo "</br>".'mutasi id '.$key.' dengan id pc '.$randomId;
        		$query = "SELECT id_pc, (monitor_pc + mouse_pc + keyboard_pc + kipasproces_pc + hdd_pc + ram_pc + process_pc) AS nilai_gen FROM data_pc WHERE id_pc = $randomId ";
				$data = $pop->connect->query($query);
					$row = mysqli_num_rows($data);

					for ($i=0; $i < $row; $i++) { 
						$d = mysqli_fetch_array($data);
						$pop->setKromosom($key, $d['id_pc'], $d['nilai_gen']);
				}
        		
        	}
        }
        
    }

 public function size(){
	return count($this->slot_waktu);
}
	public function tanggal_indo($tanggal, $cetak_hari = false)
	{
	   $hari = array ( 0 =>  'Minggu',  
		'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		'Jumat',
		'Sabtu'
		
		);
	            
	    $bulan = array (1 =>   'Januari',
	                'Februari',
	                'Maret',
	                'April',
	                'Mei',
	                'Juni',
	                'Juli',
	                'Agustus',
	                'September',
	                'Oktober',
	                'November',
	                'Desember'
	            );
	    $split    = explode('-', $tanggal);
	    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	    
	    if ($cetak_hari) {
	        $num = date('N', strtotime($tanggal));
	        if($num == 7){
	        	$num =0;
	        }
	        return $hari[$num] . ', ' . $tgl_indo;
	    }
	    return $tgl_indo;
	}
}//end of clas database
/*
$data = new database();

$data->getWaktu();

for ($i=1; $i < $data->size()+1 ; $i++) { 
$data->getPc($i);

}

foreach ($data->kromosom as $key => $value) {
$split = explode('|', $value);
$data->setNilaiGenPc($key,$split[1]);
}
$data->fitnessCalc($data);

$data->findDuplicates($data);
for ($i=1; $i  < $data->size() ; $i++) { 
	echo $i.'. '.$data->kromosom[$i] .' = '. $data->fitness[$i].' nilai_gen = '.$data->NilaiGenPc[$i];echo '</br>';
}
echo '--------------';echo '</br>';

while((in_array(0, $data->fitness)) && ($data->putaran < database::$maxGeneration)){
	//melakukan seleksi roulette wheel
$indiv1 = $data->selection($data);
$indiv2 = $data->selection($data);
//melakukan crossover
$data->crossover($data,$indiv1,$indiv2);
//melakukan mutasi
$data->mutasi($data);
for ($i=1; $i  < $data->size() ; $i++) { 

$data->fitnessCalc($data);
for ($i=1; $i  < $data->size() ; $i++) { 
	echo $i.'. '.$data->kromosom[$i] .' = '. $data->fitness[$i].' nilai_gen = '.$data->NilaiGenPc[$i];echo '</br>';
}
echo '--------------';echo '</br>';
//$data->findDuplicates($data);
$data->putaran++;
	//echo "Putaran Evolusi ke ";
	//var_dump($data->putaran);
	//echo "</br>";
//sampai sini dlu, belum ada fungsi regenerasi
}

for ($i=1; $i  < $data->size() ; $i++) { 
	echo $i.'. '.$data->kromosom[$i] .' = '. $data->fitness[$i].' nilai_gen = '.$data->NilaiGenPc[$i];echo '</br>';
}
*/
?>