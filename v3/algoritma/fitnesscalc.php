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
      // echo "ini fitnesscalc";
        //var_dump($individual);echo '</br>';
        $set_fitness = 0;
        $maks_fitness = 0;
        $array_jmlbeda = array();
        $array_fitness = array();
        $array_hari = array();
        $array_id = array();
        $array_idhari = array('1','1','2','2','3','3','4','4','5','5','6','6');
        foreach ($individual as $key => $value) {
            $fit = new Fitnesscalc();
            $split = explode('|', $value);
            array_push($array_id, $split[0]);
            array_push($array_jmlbeda, $split[1]);
            array_push($array_hari, $split[3]);
        }
        $counts_id = array_count_values($array_id);
        $counts_hari = array_count_values($array_hari);
       // var_dump($counts);echo '</br>';
        $jml_beda = array_sum($array_jmlbeda);
        $i = 0;
        foreach ($individual as $key => $value) {
            $fit = new Fitnesscalc();
            $split = explode('|', $value);
            $ds = $key;
            //$split[1] = selisih dari
            //$jml_beda = jumlah selisih hari dalam populasi
            $hitung_fitness = 1/1+(($split[1]/$jml_beda) * ($split[3]-$array_idhari[$ds]));

            
            if($counts_id[$split[0]] > 1){
                //$hitung_fitness++;
                $lebih = $hitung_fitness +1;
               }else{
                $lebih = $hitung_fitness;
               }
              
        //debug fitnesscalc
// /*
      //  echo $i++." 1/1+(".$split[1]." / ".$jml_beda.") * (".$split[3]." - ".$array_idhari[$ds].")) ";
       // echo "individu ".$value. '=  punya nilai fitness '.$lebih.'</br>';
// */
        //end debug
        array_push($array_fitness, $lebih);
        $maks_fitness += $set_fitness;

            $set_fitness = 0;

        }
        
        

       

       //echo $maks_fitness;
       return $array_fitness;
      
}
	
	
}  //end class



?>