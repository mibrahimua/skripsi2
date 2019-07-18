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
	
	public $id_pc;
	public $nilai_gen;
	public $fitness;
	

	public function generateIndividual($size) {
		
		//now lets randomly load the genes (array of ascii characters)	 to the size of the array
		$data = new Database();
        for ($i=0; $i < $size; $i++ ){  
        	$indiv = $data->getPc();
        	foreach ($indiv as $key => $value) {
        	 	$this->id_pc[$i] = $value['id_pc'];
        	 	$this->nilai_gen[$i] = $value['nilai_gen'];
        		 } 
			
            }
    }
	public function getIdPc($index) {
	        return $this->id_pc[$index];
	    }
	public function setIdPc($index,$value) {
			$this->id_pc[$index] = $value;
			$this->fitness = 0;
	    }
	public function getNilaiGen($index){
    	return $this->nilai_gen[$index];
    }
    public function setNilaiGen($index,$value){
	 	$this->nilai_gen[$index] = $value;
    }
		
	public function size(){
	return count($this->id_pc);
		}

	public function getFitness() {
        if ($this->fitness == 0) {
            $this->fitness = FitnessCalc::getFitness($this);  //call static method to calculate fitness
        }
        return $this->fitness;
    }	
	


}
?>