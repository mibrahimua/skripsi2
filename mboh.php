<?php
require_once ('Population.php');


/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:30 PM
 */
class MenuKalkulasiAlgoritma extends Population
{

	//aplikasi ini tidak berjalan karena perumusan fitness yang salah yakni dihitung bersama dengan nilai slot waktu, seharusnya yang dimasukkan ke rumus fitness adalah nilai gen pc. dan saat initial populasi gen slot waktu jangan di acak, jadi tetapkan semua slot waktu dalam slot populasi yang tersedia. sehingga yang diacak hanya gen pc. jadi nilai fitnessnya akan terus naik tiap kali evolusi krn yang dicari nilai fitness terbaik (nilai gen pc terbaik).

}

	$maks_iterasi = 1000;
	$nothing = array();
	$nothing = '';
	$populasi = new Population();
	$populasi->setGenPc($nothing);
	$populasi->fitnessCalc($populasi);
	$data_satu = count(array_keys($populasi->fitness,1));
	if($data_satu != 12)
	{
			$populasi->seleksiE($populasi);
			
			var_dump($populasi->nilai_gen);
	}
/*
		echo "<----------------------------------fitness Calculation------------------------------------------->"."<br>";
		$populasi->fitnessCalc($populasi);
		$sd = count(array_keys($populasi->fitness, 0));
		$i=0;
		while ($sd <= 0 || $i < $maks_iterasi) {
			echo "<----------------------------------Seleksi Elitism------------------------------------------->"."<br>";
			$populasi->seleksiE($populasi);
			echo "</br>";			
			
				
			
			echo "</br>";echo "</br>";
			//var_dump($populasi);
			echo "</br>";
			//$populasi_baru = new Population();
			//$populasi_baru->setGenPc($populasi->fitness,true);
			echo "</br>";echo "</br>";
			echo "</br>";echo "</br>";
			echo "<----------------------------------fitness Calculation------------------------------------------->"."<br>";
			$populasi->fitnessCalc($populasi);
			


			echo "<----------------------------------Crossover------------------------------------------->"."<br>";
			//===================CROSSOVER SECTION==============
			$indiv1 = $populasi->poolSelection($populasi);
			echo "</br>";
			$indiv2 = $populasi->poolSelection($populasi);
			echo "</br>";
			var_dump($populasi->slot_waktu[$indiv1]);
			echo "</br>";
			var_dump($populasi_baru->slot_waktu[$indiv2]);
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

			$i++;
			echo "iterasi ke ";
			var_dump($i);
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
*/
?>