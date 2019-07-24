<?php
/************************************************************************
/ Class fitnesscalc : Genetic Algorithms 
/
/************************************************************************/

require_once('individual.php');  //supporting class file

 class fitnesscalc {


   

    // Calculate individuals fitness by comparing it to our candidate solution
	// low fitness values are better,0=goal fitness is really a cost function in this instance
    static function  getFitness($individual,$pop) {
       $fitness = 0;
    //Setiap ruang hanya boleh berkesempatan maintenance 1 pc, jika benar beri nilai 0
    //Setiap pc mempunyai kode ruang, sehingga bisa memberi nilai bobot 0 jika kode ruang di pc dan di ruang sama
    //Jika kode ruang di pc tidak sama dengan ruang maka nilai bobot 1
    //jika terdapat pc yang sama atau terdapat lebih dari 1 pc dari ruang yang sama maka nilai bobot 1
    $id_pc = $individual->id_pc;
    $id_dept = $individual->id_dept;
    $id_dept2 = $individual->id_dept2;
    //1.Setiap ruang hanya boleh berkesempatan maintenance 1 pc, jika benar lebih dari 1 beri nilai 1
    $cekDept = array_count_values($pop->id_dept);
        if($cekDept[$id_dept] > 1){
            $fitness++;
        }
    //2.Setiap pc mempunyai kode ruang, sehingga bisa memberi nilai bobot 0 jika kode ruang di pc dan di ruang sama
    if($id_dept != $id_dept2){
        $fitness++;
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