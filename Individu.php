<?php


require_once ('Data_Pc.php');
//require_once ('Population.php');




/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:30 PM
 */
class Individu
{
 //tujuanmu membuat penjadwalan ini apa?
	
	//public $m_Data_Pc;
	public $m_Population;
	public $m_MenuKalkulasiAlgoritma;
	public $waktu;
	public $kode_inventori;
	public $fitness;
	

	public function setGenPc($array,$newPc = false)
	{
		$m_Data_Pc = new Data_Pc();
		if($newPc == false){
			$data_pc = $m_Data_Pc->getPc();
		}else{
 			$data_pc = $m_Data_Pc->getNewPc($array);
		}
		
		$index = 0;

		$slot_waktu = $m_Data_Pc->slot_waktu();

		  foreach ($slot_waktu as $key => $value) {
			$slot_waktu = $value['id_slot'];
			$this->setSlotWaktu($value['id_slot'],$value['id_slot']);
		  }
		  foreach ($data_pc as $key => $value) {
		  	$this->setGen($value['kode_inventori'],$value['nilai_gen']);
		  }

		 foreach ($this->kromosom as $key => $value) {
		 //	var_dump($value);
		 	
		 	 $this->setKromosom($key,$this->kode_inventori,$this->nilai_gen);
		 }
		var_dump($this->kromosom);

			
 			}//end of function setGenPc()

	
public function findDuplicates($array,$tipe)
{

    $unique = array_unique($array);

	// Duplicates
	$duplicates = array_diff_assoc($array, $unique);
	
	// Unique values
	$result = array_diff($unique, $duplicates);

	// Get the unique keys
	$unique_keys = array_keys($result);

	// Get duplicate keys
	$duplicate_keys = array_keys(array_intersect($array, $duplicates));
	if($tipe == "waktu"){
	//jika individu unik maka nilai bobot = 0.2
	foreach ($unique_keys as $key) {
	$this->setNilaiWaktu($key,0);
		}
	//jika individu terdapat kesamaan maka nilai bobot = 0.5
	foreach ($duplicate_keys as $key) {
		$this->setNilaiWaktu($key,1);
		}

	}elseif($tipe == 'pc'){
	//jika individu unik maka nilai bobot = 0.2
	foreach ($unique_keys as $key) {
	$this->setNilaiPc($key,1);
		}
	//jika individu terdapat kesamaan maka nilai bobot = 1
	foreach ($duplicate_keys as $key) {
		$this->setNilaiPc($key,0);
		}	

	}

}
	public function setKromosom($slot_waktu,$kode_inventori,$nilai_gen){
		$this->kromosom = $slot_waktu;
	}
	public function setGen($kode_inventori,$nilai_gen) {
		$this->kode_inventori = $kode_inventori;
        $this->nilai_gen = $nilai_gen;
    }

    public function getGen($index) {
        return $this->nilai_gen[$index];
    }

	

    public function getBobot($index) {
        return $this->nilai_bobot[$index];
    }

    public function setBobot($index,$value) {
        $this->nilai_bobot[$index] = $value;
        //$this->fitness = 0;
    }

   public function size(){
	return count($this->nilai_gen);
}
	public function getSlotWaktu($index){
		return $this->kromosom[$index];
	}

	public function setSlotWaktu($index,$value)
	{
		$this->kromosom[$index] = $value;
	}

	public function getNilaiPc($index)
	{
		return $this->nilai_pc[$index];
	}

	public function setNilaiPc($index,$value)
	{
		$this->nilai_pc[$index] = $value;
	}

	public function getNilaiWaktu($index)
	{
		return $this->nilai_waktu[$index];	
	}

	public function setNilaiWaktu($index,$value){
		$this->nilai_waktu[$index] = $value;
	}
	public function getFitness($index){
		return $this->fitness[$index];
			
	}

	public function setFitness($index,$value){
		$this->fitness[$index] = $value;
	}

	public function hapusIndividu($pop,$index)
	{
		unset($pop->fitness[$index]);
		unset($pop->nilai_gen[$index]);
		unset($pop->slot_waktu[$index]);
	}


	

	public function getRow()
	{
		$getrow = new Data_Pc();
		$jumlah_row = $getrow->getRow();
		return $jumlah_row;
	}

	public function getMeanAllPc()
	{
		$getMeanAllPc = new Data_Pc();
		$jumlah_pc = $getMeanAllPc->getMeanAllPc();
		return $jumlah_pc;
	}


}
?>