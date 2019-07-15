<?php
class database{
	public static $crossover_rate = 0.9;
	public static $mutate_rate = 0.1;
	public static $poolSize = 12;

public function __construct()
    {
    	  $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "skripsi";
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

public function getPc(){
	$query = "SELECT id_pc, (monitor_pc + mouse_pc + keyboard_pc + kipasproces_pc + hdd_pc + ram_pc + process_pc) AS nilai_gen FROM data_pc ORDER BY RAND() LIMIT 1";
	$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		   $this->setGenPc($d['id_pc'],$d['nilai_gen']);
	}
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

public function getGenPc($kode_inventori){
	return $this->gen_pc[$kode_inventori];
}
public function setGenPc($kode_inventori,$nilai_gen){
	$this->gen_pc = $kode_inventori.'|'.$nilai_gen;
}

public function getNilaiGenPc($kode_inventori){
	return $this->NilaiGenPc[$kode_inventori];
}
public function setNilaiGenPc($kode_inventori,$nilai_gen){
	$this->NilaiGenPc[$kode_inventori] = $nilai_gen;
}

public function getMean($kode_inventori){
	return $this->mean_all[$kode_inventori];
}
public function setMean($kode_inventori,$nilai_gen){
	$this->mean_all[$kode_inventori] = $nilai_gen;
}

public function getSlotWaktu($slot_waktu){
	return $this->slot_waktu[$slot_waktu];
}
public function setSlotWaktu($slot_waktu,$slot_waktu){
	$this->slot_waktu[$slot_waktu] = $slot_waktu;
}

public function getKromosom($slot_waktu){
	return $this->kromosom[$slot_waktu];
}
public function setKromosom($slot_waktu,$gen_pc){
	$this->kromosom[$slot_waktu] = $this->gen_pc;
}
public function fitnessCalc($pop,$maks_nilai){

}
public static function  crossover($pop,$indiv1, $indiv2) 
	 {
       
            // Crossover at which point 0..1 , .50 50% of time
            if (  database::random() > database::$crossover_rate)
			{

				echo "tidak ada crossover";
            } else {
            	echo "ada crossover";
            }
        
      //  return $newSol;
    }

 public function size(){
	return count($this->slot_waktu);
}

}//end of clas database

$data = new database();

$data->getWaktu();

for ($i=1; $i < $data->size()+1 ; $i++) { 
$data->getPc();
$data->setKromosom($i,$data->gen_pc);
unset($data->gen_pc);
}
foreach ($data->kromosom as $key => $value) {
$split = explode('|', $value);
$data->setNilaiGenPc($split[0],$split[1]);
}
$NilaiGenPc =  array_sum($data->NilaiGenPc);
$NilaiGenPc =  $NilaiGenPc / 12;

$data->getMeanAll();
$MeanAll = array_sum($data->mean_all);
$MeanAll = ($MeanAll / count($data->mean_all)) - 1;

var_dump($data->kromosom);
echo '</br>';
echo $NilaiGenPc;
echo '</br>';
echo $MeanAll;
echo '</br>';
?>