<?php
/************************************************************************
/ Class fitnesscalc : Genetic Algorithms 
/
/************************************************************************/

require_once('individu.php');  //supporting class file

 class fitnesscalc {


   

    // Calculate individuals fitness by comparing it to our candidate solution
	// low fitness values are better,0=goal fitness is really a cost function in this instance
    static function  getFitness($individual) {
       $fitness = 0;
	       
        for ($i=0; $i < $individual->size(); $i++) {
        $nilai_fitness = $individual->nilai_gen[$i]/7;
        if($nilai_fitness < 2.5){
            //beri nilai 0
            $fitness++;
        }
    }
    return $fitness;
		
    }
    
    // Get optimum fitness
    static function getMaxFitness() {
        $maxFitness = 12; //maximum matches assume each exact charaters yields fitness 1
        return $maxFitness;
    }
	
	
	
	
}  //end class



?>