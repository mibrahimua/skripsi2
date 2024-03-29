<?php


require_once ('Individu.php');




/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:31 PM
 */

class Population extends Individu
{
	
	
	//tentukan jumlah populasi
	//individu dengan fitness terbaik 
	//objektifnya adalah rata-rata fitness populasi akhir < rata-rata fitness populasi keseluruhan(didapat dari perhitungan rata-rata awal)
	public $new_populasi;
	public $m_Individu;
	public $kode_inventori;
	public static $crossover_rate = 0.9;
	public static $mutate_rate = 0.1;
	public static $poolSize = 12;
	public $putaran = 0;
	public function setPopulasi($newPc = false){
		echo "<----------------------------------Awal Evolusi------------------------------------------->"."<br>";
		$individu = new Individu();
		if($newPc == false){
			echo "here nothing";
			$nothing = array();
			$nothing = '';
			$sol = $individu->setGenPc($nothing);
		}else{
			echo "here setGenPc";
			var_dump(count($this->nilai_gen));
			$sol = $individu->setGenPc($this->nilai_gen,$newPc = true);
		}

		
		
			//end of Inisialisasi populasi awal

		
/*
		echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
		$this->seleksiE($individu);
		echo "</br>";
*/		
		
			/*
			SOOOOO KETIKA SUDAH TERPILIH INDIVIDUNYA DIMASUKKAN KEDALAM GENERASI BARU BROO JANGAN DIPISAHKAN SENDIRI
			*/
	}//END OF function setPopulasi
public function loop(){
//FUCKING THIS SHI**t

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

public static function random() {
  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
}


public static function poolSelection($pop) {
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
    public static function  crossover($pop,$indiv1, $indiv2) 
	 {
       $newSol = new Individu();  //create a offspring
        // Loop through genes
       
            // Crossover at which point 0..1 , .50 50% of time
            if (  Population::random() > Population::$crossover_rate)
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
    public static function mutate($individu) {
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
		//$nilai_waktu = $individu->findDuplicates($individu->slot_waktu,"waktu");
		$nilai_pc = $individu->findDuplicates($individu->kode_inventori,"pc");
		
		$data_pc = $individu->nilai_gen;

		//Inisialisasi populasi awal
		$index_gen = 0;
		foreach ($data_pc as $key => $value) {
		$index2 = $index_gen++;

		$nilai_pc = $individu->getNilaiPc($key);
		//$nilai_waktu = $individu->getNilaiWaktu($key);
		//$nilai_bobot = $nilai_pc+$nilai_waktu;

		$nilai_bobot = $nilai_pc;
		$nilai_gen = $value;

		$fitness = 1/1+($nilai_bobot*$nilai_gen);//Rumus fitness : F(x) = 1/1+(nilai_gen+bobot)
var_dump($nilai_bobot);
		$fitness = $individu->setFitness($key,$nilai_gen);

		echo $index2.". Nilai Fitness Individu ".$key. ' = ' . $individu->getFitness($key).' dengan nilai gen '.$individu->nilai_gen[$key].' dan slot waktu '.$individu->slot_waktu[$key];
		echo "</br>";

			}//end of foreach ($data_pc as $key)
			//var_dump($individu->fitness);
}
public function seleksiE($individu){

	
	//========Penyimpanan Individu terpilih kedalam populasi baru =============
	//salin populasi kromosom lama ke populasi baru
	$this->newFitness = $individu->fitness;
	$this->newNilai_gen = $individu->nilai_gen;
	$this->newSlot_waktu = $individu->slot_waktu;
	//hapus 2 kromosom dari populasi lama untuk menyediakan slot populasi
	$max_keyfitness = array_keys($this->fitness, max($this->fitness));
	$key = $max_keyfitness[array_rand($max_keyfitness, 1)];
	echo "hapus individu ".$key;echo '</br>';
	$individu->hapusIndividu($individu,$key);

	$max_keyfitness = array_keys($this->fitness, max($this->fitness));
	$key = $max_keyfitness[array_rand($max_keyfitness, 1)];
	echo "hapus individu ".$key;echo '</br>';
	$individu->hapusIndividu($individu,$key);

	$maks_keyfitness = array_keys($this->newFitness, min($this->newFitness));
	$key = $maks_keyfitness[array_rand($maks_keyfitness, 1)];
	$parent1 = $key;
	echo "parent 1 = ".$parent1;echo '</br>';
	$individu->saveIndividual($parent1,$this->newNilai_gen[$parent1],$this->newSlot_waktu[$parent1]);

	unset($this->newFitness[$parent1]);
	unset($this->newNilai_gen[$parent1]);
	unset($this->newSlot_waktu[$parent1]);
	$maks_keyfitness = array_keys($this->newFitness, min($this->newFitness));
	$key = $maks_keyfitness[array_rand($maks_keyfitness, 1)];
	$parent2 = $key;
	echo "parent 2 = ".$parent2;echo '</br>';
	$individu->saveIndividual($parent2,$this->newNilai_gen[$parent2],$this->newSlot_waktu[$parent2]);

	var_dump($this->nilai_gen);echo '</br>';
//gagal menambahkan object dengan key yang sama didalam array, karena sudah ada key tersebut
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