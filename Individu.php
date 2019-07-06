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
	/*
	apa solusi yang ingin kamu buat?
	didalam ini terdapat berbagai data kondisi komputer
	yang menjadi masalah ialah aku belum menemukan solusi yang ingin digunakan dalam penerapan algoritma ini
	solusi yang ingin dicapai ialah nilai rata-rata nilai_gen dari populasi yang dihasilkan lebih besar dari rata-rata nilai_gen dari semua individu
	lakukan query getallmean lalu lakukan perhitungan rata-rata nilai gen, kemudian ambil rata-rata nilai gen dari populasi yang dibuat
	jika nilai rata-rata populasi yang dibuat lebih kecil maka lakukan pembuatan populasi ulang
	*/
	//public $m_Data_Pc;
	public $m_Population;
	public $m_MenuKalkulasiAlgoritma;
	public $waktu;
	public $kode_inventori;
	public $fitness;
	

	public function setGenPc()
	{
		$m_Data_Pc = new Data_Pc();
		$data_pc = $m_Data_Pc->getPc();
		$index = 0;

		foreach ($data_pc as $key => $value) {
		
		 $nilai_gen = $value['nilai_gen'];
		 $nilai_gen = sqrt(pow(($nilai_gen),2)/count($m_Data_Pc->getPc()));

		 $kode_inventori = $value['kode_inventori'];
		 $index2 = $index++;
		  $slot_waktu = $m_Data_Pc->slot_waktu();

		  foreach ($slot_waktu as $key => $value) {
			$value['id_slot'];
		  }
		  $slot_waktu = $value['id_slot'];

		 $this->setGen($kode_inventori,$nilai_gen,$slot_waktu);

}

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
	$this->setNilaiWaktu($key,0.2);
		}
	//jika individu terdapat kesamaan maka nilai bobot = 0.5
	foreach ($duplicate_keys as $key) {
		$this->setNilaiWaktu($key,0.5);
		}

	}elseif($tipe == 'pc'){
	//jika individu unik maka nilai bobot = 0.2
	foreach ($unique_keys as $key) {
	$this->setNilaiPc($key,0.2);
		}
	//jika individu terdapat kesamaan maka nilai bobot = 1
	foreach ($duplicate_keys as $key) {
		$this->setNilaiPc($key,1);
		}	

	}

}

	public function setGen($kode_inventori,$nilai_gen,$slot_waktu) {
        $this->nilai_gen[$kode_inventori] = $nilai_gen;
        $this->slot_waktu[$kode_inventori] = $slot_waktu;
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
		return $this->slot_waktu[$index];
	}

	public function setSlotWaktu($index,$value)
	{
		$this->slot_waktu[$index] = $value;
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
			/*
		//Batasan masalah 
		//Tidak boleh ada komputer yang sama didalam jadwal dengan nilai bobot = 0.2
		//Tidak boleh ada slot_waktu yang sama didalam jadwal dengan nilai bobot = 0.2
		//Jika tidak sesuai mempunyai nilai bobot = 1
		//Rumus fitness : F(x) = 1/1+(nilai_gen+bobot)
		//permasalahan utama ialah cara mencari nilai bobot dari suatu kromosom / individu
		//dikatakan bahwa tidak boleh ada komputer yang sama dalam
		jadwal yang sama berarti didalam jadwal harus dibatasi
		dan tidak boleh ada slot_waktu yang sama didalam 1 jadwal pemeliharaan, berarti dalam 1 jadwal dibatasi sebanyak 12 slot_waktu dengan durasi pemeliharaan 2 kali dalam sehari (senin s/d sabtu).
		
		Sekarang tinggal mencari pseudo codenya
		- buat populasi sebanyak 12 kromosom dengan slot_waktu masing2
		- hitung bobot dari masing-masing individu dengan membandingkan jumlah slot_waktu, jika tidak ada slot_waktu yang sama didalam populasi beri nilai = 0.2 , jika terdapat persamaan dalam slot_waktu didalam populasi beri nilai = 1.
		setelah masing-masing individu mendapatkan nilai bobotnya, hitung menggunakan rumus fitness di masing-masing individu
		*/ 
	}

	public function setFitness($index,$value){
		$this->fitness[$index] = $value;
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