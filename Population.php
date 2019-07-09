<?php


require_once ('Individu.php');




/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:31 PM
 */

class Population extends Individu
{
	
	function __construct(){
		$this->index = -1;
		$this->new_index = -1;
	}
	
	//tentukan jumlah populasi
	//individu dengan fitness terbaik 
	//objektifnya adalah rata-rata fitness populasi akhir < rata-rata fitness populasi keseluruhan(didapat dari perhitungan rata-rata awal)
	public $new_populasi;
	public $m_Individu;
	public $kode_inventori;
	public static $crossover_rate = 0.5;
	public static $mutate_rate = 0.2;
	public static $poolSize = 12;
	public $putaran = 0;
	public function setPopulasi($newPc = false){
		echo "<----------------------------------Awal Evolusi------------------------------------------->"."<br>";
		$individu = new Individu();
		if($newPc == false){
			echo "here nothing";
			$nothing = array();
			$nothing = '';
			$individu->setGenPc($nothing);
		}else{
			echo "here setGenPc";
			$individu->setGenPc($this->nilai_gen,$newPc = true);
		}
		
		
		//var_dump($individu->size());
		

		$rata = $individu->getMeanAllPc();
		echo "Rata-rata nilai_gen semua pc = ";
		print_r($rata);
		echo "</br>";
			//end of Inisialisasi populasi awal
			$this->fitnessCalc($individu);
			$this->getTotalFitness($individu);

		echo "<----------------------------------Crossover------------------------------------------->"."<br>";
		//===================CROSSOVER SECTION==============
		$indiv1 = $this->poolSelection($individu);
		echo "</br>";
		$indiv2 = $this->poolSelection($individu);
		echo "</br>";
		var_dump($individu->slot_waktu[$indiv1]);
		echo "</br>";
		var_dump($individu->slot_waktu[$indiv2]);
		echo "</br>";
		$this->crossover($individu,$indiv1,$indiv2);
		echo "</br>";
		var_dump($individu->slot_waktu[$indiv1]);
		echo "</br>";
		var_dump($individu->slot_waktu[$indiv2]);
		echo "</br>";
		//================END OF CROSSOVER SECTION==============

		//===================MUTATE SECTION======================
		echo "<----------------------------------Mutasi------------------------------------------->"."<br>";
		$this->mutate($individu);
		echo "</br>";
		
		//===================END OF MUTATE SECTION======================
		echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
		$this->seleksiE($individu);
		echo "</br>";
		
		
			
	}//END OF function setPopulasi
public function loop(){

	while (count($this->nilai_gen) <= 11) {
		$this->setPopulasi($this,true);
	}

	echo "Populasi Akhir ";
	echo "</br>";
	foreach ($this->nilai_gen as $key => $value) {
		echo $key.' dengan nilai gen '.$this->nilai_gen[$key].' dan slot waktu '.$this->slot_waktu[$key];
		echo "</br>";
	}
}

private static function random() {
  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
}


private static function poolSelection($pop) {
        // Create a pool population
	
	   for ($i=0; $i < Population::$poolSize; $i++) {
	     $randomId = rand(0, $pop->size()-1 ); //Get a random individual from anywhere in the population
			//$pool->saveIndividual($i, $pop->getIndividual( $randomId));
	     $random = array_rand($pop->slot_waktu);
	     $a = $pop->slot_waktu;
	     	
        }
        var_dump($random);
        return $random;
        // Get the fittest
        //$fittest = $pool->getFittest();
        //return $fittest;
    }

	// Crossover individuals (aka reproduction)
    private static function  crossover($pop,$indiv1, $indiv2) 
	 {
       $newSol = new Individu();  //create a offspring
        // Loop through genes
       
            // Crossover at which point 0..1 , .50 50% of time
            if (  Population::random() < Population::$crossover_rate)
			{

				//$waktu = array_keys($indiv1->slot_waktu);
				//var_dump($indiv1);
                
				echo "tidak ada crossover";
            } else {
            	$temp = $pop->slot_waktu[$indiv2];
            	$pop->setSlotWaktu($indiv2, $pop->slot_waktu[$indiv1] );

                $pop->setSlotWaktu($indiv1, $temp );
                
            	echo "ada crossover";
            }
        
      //  return $newSol;
    }

   	// Mutate an individual
    private static function mutate($individu) {
        // Loop through genes
       
        $index = $individu->slot_waktu;
        foreach ($index as $key => $value) {
        	if (  Population::random() <= Population::$mutate_rate) {

        		var_dump($key);
        		
        		echo "</br>";
        		//rand(0, 11) adalah range dari slot waktu
        		$randomId = rand(0, 11 );
        		var_dump($randomId);
        		echo "</br>";
        		$individu->setSlotWaktu($key, $randomId);
        	}
        }
        
    }

public function fitnessCalc($individu){
	//Pencarian data ganda dan memberi nilai gen waktu dan gen pc
		$find = new Individu();
		$nilai_waktu = $individu->findDuplicates($individu->slot_waktu,"waktu");
		//$nilai_pc = $individu->findDuplicates($individu->kode_inventori,"pc");
	
		$data_pc = $individu->nilai_gen;

		//Inisialisasi populasi awal
		$index_gen = 0;
		foreach ($data_pc as $key => $value) {
		$index2 = $index_gen++;
		
		//$nilai_pc = $individu->getNilaiPc($index2);
		$nilai_waktu = $individu->getNilaiWaktu($key);
		//$nilai_bobot = $nilai_pc+$nilai_waktu;
		$nilai_bobot = $nilai_waktu;
		$nilai_gen = $value;

		$fitness = 1/1+($nilai_gen-$nilai_bobot);//Rumus fitness : F(x) = 1/1+(nilai_gen+bobot)

		$fitness = $individu->setFitness($key,$fitness);

		echo $index2.". Nilai Fitness Individu ".$key. ' = ' . $individu->getFitness($key).' dengan nilai gen '.$individu->nilai_gen[$key].' dan slot waktu '.$individu->slot_waktu[$key];
		echo "</br>";

			}//end of foreach ($data_pc as $key)
			//var_dump($individu->fitness);
}
public function seleksiE($individu){

	//Seleksi Menggunakan Elitism
	//$individu = $individu;
//var_dump($this->kode_inventori);
	$data_pc = $individu->fitness;
	$maks_fitness = max($individu->fitness);
	foreach ($data_pc as $key => $value) {
	
	$presentasi = round(($individu->getFitness($key)/$maks_fitness)*100,2);
	echo " Presentasi Seleksi Individu ".$key .' dengan Fitness ' . $individu->getFitness($key). " = " . $presentasi.' % dengan nilai gen '.$individu->nilai_gen[$key].' dan slot waktu '.$individu->slot_waktu[$key];
	echo "</br>";



	}
	//end of Seleksi Menggunakan Elitism
	//========Penyimpanan Individu terpilih kedalam populasi baru =============
	$maks_keyfitness = array_keys($individu->fitness, max($individu->fitness));
	print_r($maks_keyfitness);

	$key = $maks_keyfitness[array_rand($maks_keyfitness, 1)];
	 echo "</br>";
	//cek apakah sudah ada slot waktu di populasi terpilih
	if(!in_array($individu->slot_waktu[$key], $this->slot_waktu)){
		echo "Individu yang terpilih untuk di ikutkan di pembuatan populasi selanjutnya : ";
	$this->saveIndividual($key,$individu->nilai_gen[$key],$individu->slot_waktu[$key]);
	echo $key.' dengan nilai gen '.$this->nilai_gen[$key].' dan slot waktu '.$this->slot_waktu[$key];
	echo "</br>";
	}
			

	$this->putaran++;
	echo "Putaran Evolusi ke ";
	var_dump($this->putaran);
	echo "</br>";
}
	

	public function getNewGen($index)
	{
		return $this->new_nilai_gen[$index];
	}
	
	public function saveIndividual($kode_inventori,$nilai_gen,$slot_waktu)
	{
		$this->nilai_gen[$kode_inventori] = $nilai_gen;
		$this->slot_waktu[$kode_inventori] = $slot_waktu;
	}

	


	
	public function getTotalFitness($individu){
	echo "</br>";
	//Ambil objek dari kelas Individu untuk mendapatkan total fitness yang tersimpan di objek individu
	$jumlah_fitness = array_sum($individu->fitness);
	$jumlah_nilai_gen = array_sum($individu->nilai_gen);
	$max_fitness = max($individu->fitness);
	echo "Fitness Maksimal = ". $max_fitness;
	echo "</br>";
	echo "Total fitness = ". $jumlah_fitness;
	echo "</br>";
	echo "Rata-rata fitness = ". $jumlah_fitness/count($individu->fitness);
	echo "</br>";
	//$nilai_gen = $individu->nilai_gen / 7;
	echo "Rata-rata nilai_gen = ". array_sum($individu->nilai_gen)/count($individu->nilai_gen);
	echo "</br>";

	return $max_fitness;
	}

	public function getMeanFitness($individu)
	{

		$jumlah_fitness = array_sum($individu->fitness);
		$mean = $jumlah_fitness/count($individu->fitness);
var_dump($mean);
		return $mean;
	}

	public function setNewPopulasi($index,$value)
	{
		$this->new_populasi[$index] = $value;
	}

	public function getNewPopulasi($index)
	{
		return $this->new_populasi[$index];
	}

}
?>