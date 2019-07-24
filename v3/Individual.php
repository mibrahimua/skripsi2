<?php


require_once('database.php');
require_once('fitnesscalc.php');


/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:30 PM
 */
class Individu extends Database
{
	
	
	public $id_pc;
	public $nilai_gen;
	public $fitness;

	public function generateIndividual($size) {
		//
		//now lets randomly load the genes (array of ascii characters)	 to the size of the array
		$data = new Database();
        for ($i=0; $i < $size; $i++ ){  
        	$indiv = $data->getPc();
        	foreach ($indiv as $key => $value) {
                $this->indiv[$i] = $value['id_pc'].'|'.$value['id_dept'].'|'.$value['tgl_terakhir'].'|'.$value['weekday'];
                /*
        	 	$this->id_pc[$i] = $value['id_pc'];
        	 	$this->tgl_terakhir[$i] = $value['tgl_terakhir'];
                $this->id_dept[$i] = $value['id_dept'];
                $this->id_dept2[$i] = $value['id_dept2'];
*/
        		 } 
			
            }
    }
    public function setGen($index,$value){
        $this->indiv[$index] = $value;
    }
	public function getIdPc($index) {
	        return $this->id_pc[$index];
	    }
	public function setIdPc($index,$value) {
			$this->id_pc[$index] = $value;
			$this->fitness = 0;
	    }
	public function getTglTerakhir($index){
    	return $this->tgl_terakhir[$index];
    }
    public function setTglTerakhir($index,$value){
	 	$this->tgl_terakhir[$index] = $value;
    }
    public function getIdDept($index){
        return $this->id_dept[$index];
    }
    public function setIdDept($index,$value){
        $this->id_dept[$index] = $value;
    }
	public function getIdDept2($index){
        return $this->id_dept2[$index];
    }
    public function setIdDept2($index,$value){
        $this->id_dept2[$index] = $value;
    }	
	public function size(){
	return count($this->indiv);
		}

	public function getFitness() {
        if ($this->fitness == 0) {
            $this->fitness = FitnessCalc::getFitness($this);  //call static method to calculate fitness
        echo "</br>";
        }


        return $this->fitness;
    }	
    public function setFitness($index,$value){
        $this->fitness[$index] = $value;
    }
    public function saveIndividual($index, $indiv) {
        $this->people[$index] = $indiv;
    }
	
public function __toString() {
        $geneString = null;
        for ($i = 0; $i <  count($this->id_pc); $i++) {
            $geneString .= $this->getIdPc($i);
        }
        
        return $geneString;
    }

}//end of class individual



?>