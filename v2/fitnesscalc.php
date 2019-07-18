<?php
/************************************************************************
/ Class fitnesscalc : Genetic Algorithms 
/
/************************************************************************/

require_once('individual.php');  //supporting class file

 class fitnesscalc {


   

    // Calculate individuals fitness by comparing it to our candidate solution
	// low fitness values are better,0=goal fitness is really a cost function in this instance
    static function  getFitness($individual) {
       $fitness = 0;
        for ($i=0; $i < $individual->size(); $i++) {
        $nilai_pc = $individual->nilai_gen[$i]/7;
        if($nilai_pc < 2){
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