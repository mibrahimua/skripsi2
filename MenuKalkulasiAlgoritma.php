<?php
require_once ('Population.php');


/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:30 PM
 */
class MenuKalkulasiAlgoritma extends Population
{

	public function tampilPc()
	{
		$data = new Individu();
		$data->setGenPc($array_individu);
	}

}


	$nothing = array();
	$nothing = '';
	$populasi = new Population();
	$populasi->setGenPc($nothing);
	//$populasi->setPopulasi(false);

	//var_dump($populasi); echo "</br>";
echo "<----------------------------------Fitness Calculation------------------------------------------->"."<br>";

		$populasi->fitnessCalc($populasi);
		//$key_index = array_keys($populasi->nilai_gen);
		echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
		$populasi->seleksiE($populasi);
		echo "</br>";
		$cari = array_search(0, $populasi->fitness);
		
		/*
		var_dump($cari);echo '</br>';
		unset($populasi->fitness[$cari]);
		*/
		//var_dump($populasi->fitness);
		//var_dump($cari);
		//cari cara bagaimana supaya melakukan perulangan jika ada kromosom dalam populasi yang mendapat nilai fitness 0
		//PROGRAM INI BELUM MEMBANDINGKAN FITNESS LAMA DENGAN FITNESS YANG BARU
		$cekFitness = in_array(0, $populasi->fitness);
		$sd = count(array_keys($populasi->fitness, 0));
		var_dump($sd);
		while ($sd <= 0) {
			/*
			$unindex = array();
			$cari = array_search(0, $populasi->fitness);
			array_push($unindex, $cari);
			*/
			foreach ($populasi->fitness as $key => $value) {
			if($value == 0){
				//sampai disini harusnya  belum menghilangkan kromosom krn belum dibandingkan dengan kromosom baru
				unset($populasi->fitness[$key]);
				unset($populasi->nilai_gen[$key]);
				unset($populasi->slot_waktu[$key]);
				}else{
				$populasi->saveIndividual($key,$populasi->nilai_gen[$key],$populasi->slot_waktu[$key]);	
				}
				
			}
			echo "</br>";echo "</br>";
			//var_dump($populasi);
			echo "</br>";
			$populasi_baru = new Population();
			$populasi_baru->setGenPc($populasi->fitness,true);
			echo "</br>";echo "</br>";
			echo "</br>";echo "</br>";
			echo "<----------------------------------Fitness Calculation------------------------------------------->"."<br>";
			$populasi_baru->fitnessCalc($populasi_baru);
			/*
			DAANNNN BAGAIMANA HASILNYAAAAA
			*/


			echo "<----------------------------------Crossover------------------------------------------->"."<br>";
			//===================CROSSOVER SECTION==============
			$indiv1 = $populasi_baru->poolSelection($populasi_baru);
			echo "</br>";
			$indiv2 = $populasi_baru->poolSelection($populasi_baru);
			echo "</br>";
			var_dump($populasi_baru->slot_waktu[$indiv1]);
			echo "</br>";
			var_dump($populasi_baru->slot_waktu[$indiv2]);
			echo "</br>";
			$populasi_baru->crossover($populasi_baru,$indiv1,$indiv2);
			echo "</br>";
			var_dump($populasi_baru->slot_waktu[$indiv1]);
			echo "</br>";
			var_dump($populasi_baru->slot_waktu[$indiv2]);
			echo "</br>";

			//================END OF CROSSOVER SECTION==============

			//===================MUTATE SECTION======================
			echo "<----------------------------------Mutasi------------------------------------------->"."<br>";
			$populasi_baru->mutate($populasi_baru);
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "isi dari populasi lama ";
			echo "</br>";
			var_dump($populasi->fitness);
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "isi dari populasi_baru ";
			echo "</br>";
			var_dump($populasi_baru->fitness);
			echo "</br>";
			echo "</br>";
			echo "</br>";
			echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
			$populasi->seleksiE($populasi);
			echo "</br>";
		}

		$a= '1';
		if($a == '0'){

	echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
		$populasi->seleksiE($populasi);
		echo "</br>";

	echo "<----------------------------------Crossover------------------------------------------->"."<br>";
		//===================CROSSOVER SECTION==============
		$indiv1 = $populasi->poolSelection($populasi);
		echo "</br>";
		$indiv2 = $populasi->poolSelection($populasi);
		echo "</br>";
		var_dump($populasi->slot_waktu[$indiv1]);
		echo "</br>";
		var_dump($populasi->slot_waktu[$indiv2]);
		echo "</br>";
		$populasi->crossover($populasi,$indiv1,$indiv2);
		echo "</br>";
		var_dump($populasi->slot_waktu[$indiv1]);
		echo "</br>";
		var_dump($populasi->slot_waktu[$indiv2]);
		echo "</br>";

		//================END OF CROSSOVER SECTION==============

		//===================MUTATE SECTION======================
		echo "<----------------------------------Mutasi------------------------------------------->"."<br>";
		$populasi->mutate($populasi);
		echo "</br>";

		}
	//$populasi->loop();

?>