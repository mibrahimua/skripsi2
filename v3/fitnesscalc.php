<?php
/************************************************************************
/ Class fitnesscalc : Genetic Algorithms 
/
/************************************************************************/

require_once('individual.php');  //supporting class file

 class fitnesscalc {


   

    // Calculate individuals fitness by comparing it to our candidate solution
	// low fitness values are better,0=goal fitness is really a cost function in this instance
    function setFitness($index,$value){
        $this->fitness[$index] = $value;
    }
    static function  getFitness($individual) {

        $set_fitness = 0;
        $maks_fitness = 0;
        $array_beda = array();
        $array_fitness = array();
        $array_hari = array();
        $array_idhari = array('1','1','2','2','3','3','4','4','5','5','6','6');
        foreach ($individual as $key => $value) {
            $fit = new Fitnesscalc();
            $split = explode('|', $value[0]);
            array_push($array_beda, $split[1]);
            array_push($array_hari, $split[3]);
        }

        $counts = array_count_values($array_hari);
       // var_dump($counts);echo '</br>';
        $jml_beda = array_sum($array_beda);

        foreach ($individual as $key => $value) {
            $fit = new Fitnesscalc();
            $split = explode('|', $value[0]);
            $ds = $key;

            $hitung_fitness = 1/1+(($split[1]/$jml_beda) * ($split[3]-$array_idhari[$ds]));

            /*
            if($counts[$split[3]] > 2){
                //$hitung_fitness++;
                $lebih = $hitung_fitness +1;
               }else{
                $lebih = $hitung_fitness;
               }
              */ 
echo "1/1+(".$split[1]." / ".$jml_beda.") * (".$split[3]." - ".$array_idhari[$ds].")) ";
        echo "individu ".$value[0].' count weekday '.$split[3] .' = '.$counts[$split[3]].' punya nilai fitness '.$hitung_fitness.'</br>';
        array_push($array_fitness, $hitung_fitness);
        $maks_fitness += $set_fitness;

            $set_fitness = 0;

        }
        
        

       

       //echo $maks_fitness;
       return $array_fitness;
       /*

    //Setiap ruang hanya boleh berkesempatan maintenance 1 pc, jika benar beri nilai 0 (DONE)
    //Setiap pc mempunyai kode ruang, sehingga bisa memberi nilai bobot 0 jika kode ruang di pc dan di ruang sama (DONE)
    //Jika kode ruang di pc tidak sama dengan ruang maka nilai bobot 1 (DONE)
    //jika terdapat pc yang sama atau terdapat lebih dari 1 pc dari ruang yang sama maka nilai bobot 1

    $id_pc = $individual->id_pc;
    $id_dept = implode($individual->id_dept);
    $id_dept2 = implode($individual->id_dept2);
    //1.Setiap ruang hanya boleh berkesempatan maintenance 1 pc, jika benar lebih dari 1 beri nilai 1
    $s = array();
    foreach ($pop as $key => $value) {
        print_r($value->id_dept);
        //array_push($s, $value->id_dept);
    }
    var_dump($s);
    $cekDept = array_count_values($s);
        if($cekDept[$id_dept] > 1){
            $fitness++;
        }
        
    //2.Setiap pc mempunyai kode ruang, sehingga bisa memberi nilai bobot 0 jika kode ruang di pc dan di ruang sama
    if($id_dept != $id_dept2)
{        $fitness++;
    echo $id_dept.' dan ';
    echo $id_dept2.' berarti ';
    var_dump($id_dept != $id_dept2);echo ' mendapat nilai ';
    echo $fitness.'</br>';
    }
   //echo $fitness.'</br>';

    return $individual->fitness = $fitness;
		
    }
    
    // Get optimum fitness
    static function getMaxFitness() {
        $maxFitness = 12; //maximum matches assume each exact charaters yields fitness 1
        return $maxFitness;
    }
	
	*/
}
	
	
}  //end class



?>