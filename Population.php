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

	public function setPopulasi(){
		echo "<----------------------------------Awal Evolusi------------------------------------------->"."<br>";
		$individu = new Individu();
		$individu->setGenPc();
		//var_dump($individu->size());
		

		$rata = $individu->getMeanAllPc();
		echo "Rata-rata nilai_gen semua pc = ";
		print_r($rata);
		echo "</br>";
		$index_evo = 0;
		//test
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
		echo "CROSSOVER BERES !!!";
		echo "</br>";
		//================END OF CROSSOVER SECTION==============

			echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
			$this->seleksiE($individu);
			echo "debug individu terpilih dari populasi sebelumnya new_kode function setPopulasi";
			var_dump($this->new_kode);
			/*
			$i = count($this->new_kode);
			for (count($this->new_kode); count($this->new_kode) <= 12 ;) { 
				
				$this->setGenPc($this->new_kode);
				
			}
			*/
			/*
			if(count($this->new_kode) <= 12){
				echo "<----------------------------------Evolusi Lanjutan------------------------------------------->"."<br>";
				$this->setGenPc($this->new_kode);
				$this->fitnessCalc($this);
				echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
				$this->seleksiE($this);
				echo "<-------------------------------1 Putaran--------------------------------------->"."<br>"."<br>";

			}
			*/
			//setelah melakukan seleksi dan memasukkan individu terbaik kedalam populasi baru, maka dilakukan pengecekan jumlah populasi. Jika jumlah populasi = 12 dilakukan crossover, jika jumlah populasi kurang dari 12 maka dilakukan pembuatan populasi ulang dengan mengecualikan individu yang sudah terpilih
	}
public function loop(){
	$this->fitnessCalc($this);
	echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
	$this->seleksiE($this);
	
}

private static function random() {
  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
}

public function evolve($pop){

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
    private static function mutate($indiv) {
        // Loop through genes
        for ($i=0; $i < $indiv->size(); $i++) {
            if (  Population::random() <= Population::$mutate_rate) {
                $indiv->setGene($i, $gene); //substitute the gene into the individual
                //$i merupakan index array
                $indiv->setSlotWaktu($indiv2, $pop->slot_waktu[$indiv1] );
            }
        }
    }

public function fitnessCalc($individu){
	//Pencarian data ganda dan memberi nilai gen waktu dan gen pc
		
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

	//Memasukkan individu terbaik dari hasil seleksi Elitism kedalam populasi baru
	$maks_keyfitness = array_keys($individu->fitness, max($individu->fitness));
	print_r($maks_keyfitness);

	echo "</br>";
	echo "</br>";
	$key = $maks_keyfitness[array_rand($maks_keyfitness, 1)];
	$this->setNewGen($key,$individu->nilai_gen[$key],$individu->slot_waktu[$key]);
	 echo "</br>";
	
	echo "Individu yang terpilih untuk di ikutkan di pembuatan populasi selanjutnya : ";
	var_dump($this->new_nilai_gen);
	echo "<br>";
	echo "<br>";
	echo "MEMBUAT RANDOM POPULASI BARU"."<br>";
	
	
	//unset($individu);
	//end of Memasukkan individu terbaik dari hasil seleksi Elitism kedalam populasi baru
	//var_dump($individu->fitness);
	if($this->getMeanFitness($individu) < $this->getTotalFitness($individu)){
		
		$this->setGenPc($this->new_kode);
		echo "KURANG CROSSOVER"."<br>";
		echo "KURANG MUTASI"."<br>";
		echo "GANBATTE ONI-CHAN !!!"."<br>";
		echo "<-------------------------------1 Putaran--------------------------------------->"."<br>"."<br>";
		//$this->loop();
		echo "<----------------------------------Evolusi Lanjutan------------------------------------------->"."<br>";
	}else{
		$mean = $this->getMeanFitness($individu);
		$maks = $this->getTotalFitness($individu);
		echo $mean." > ".$maks."<br>";
		echo "entah lah bro lelah hahhaa";
	}

	echo "</br>";
	echo "debug new_kode function seleksiE : ";
	var_dump($this->new_kode);
	echo "<br>";
	echo "debug new_index function seleksiE : ";
	var_dump($this->new_index);
	echo "<br>";
	/*
	if(count($this->kode_inventori) != 12){
		$array =  $this->kode_inventori;
		
		$this->setGenPc($this->kode_inventori);
	}
	*/
//unset($this->kode_inventori);

	echo "debug populasi baru individu kode_inventori function seleksiE : ";
	var_dump($this->kode_inventori);
		echo "</br>";
}
	

	public function getNewGen($index)
	{
		return $this->new_nilai_gen[$index];
	}
	
	public function setNewGen($kode_inventori,$nilai_gen,$slot_waktu)
	{
		$this->new_nilai_gen[$kode_inventori] = $nilai_gen;
		$this->new_slot_waktu[$kode_inventori] = $slot_waktu;
	}

	public function getNewWaktu($index)
	{
		return $this->new_waktu[$index];
	}

	public function setNewWaktu($index,$value)
	{
		$this->new_waktu[$index] = $value;
	}

	public function getNewFitness($index,$value)
	{
		return $this->new_fitness[$index];
	}

	public function setNewFitness($index,$value)
	{
		$this->new_fitness[$index] = $value;
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
	
	





	public function getPopulasi()
	{
	}

	

}
?>