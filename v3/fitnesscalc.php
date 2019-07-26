<?php
/************************************************************************
/ Class fitnesscalc : Genetic Algorithms 
/
/************************************************************************/

require_once('individual.php');  //supporting class file

 class fitnesscalc {


    function setFitness($index,$value){
        $this->fitness[$index] = $value;
    }
    static function  getFitness($individual) {

        $set_fitness = 0;
        $maks_fitness = 0;
        $array_jmlbeda = array();
        $array_fitness = array();
        $array_hari = array();
        $array_idhari = array('1','1','2','2','3','3','4','4','5','5','6','6');
        foreach ($individual as $key => $value) {
            $fit = new Fitnesscalc();
            $split = explode('|', $value);
            array_push($array_jmlbeda, $split[1]);
        }

        //$counts = array_count_values($array_hari);
       // var_dump($counts);echo '</br>';
        $jml_beda = array_sum($array_jmlbeda);

        foreach ($individual as $key => $value) {
            $fit = new Fitnesscalc();
            $split = explode('|', $value);
            $ds = $key;

            $hitung_fitness = 1/1+(($split[1]/$jml_beda) * (2-$array_idhari[$ds]));

            /*
            if($counts[$split[3]] > 2){
                //$hitung_fitness++;
                $lebih = $hitung_fitness +1;
               }else{
                $lebih = $hitung_fitness;
               }
              */ 

//echo "1/1+(".$split[1]." / ".$jml_beda.") * (".$split[3]." - ".$array_idhari[$ds].")) ";
        echo "individu ".$value. '=  punya nilai fitness '.$hitung_fitness.'</br>';
        array_push($array_fitness, $hitung_fitness);
        $maks_fitness += $set_fitness;

            $set_fitness = 0;

        }
        
        

       

       //echo $maks_fitness;
       return $array_fitness;
      
}
	
	
}  //end class



?>