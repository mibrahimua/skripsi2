<?php
require_once('Individual.php');

/**
 * 
 */
class Population extends Individu
{
	public $individu=array();
	static $static_array = array();
  public static $popSize = 12;
	public static $elitism=true;
	public static $poolSize=1;
	public static $uniformRate=0.5;
	public static $mutationRate=0.5;
  public static $maxiteration = 200;

	function __construct($popSize,$initial = false)
	{
		if(!isset($popSize) || $popSize ==0)
		die("Harus memiliki populasi lebih dari 0");
	
	for($i=0;$i<$popSize;$i++)
		$this->individu[$i] = new Individu();

	if($initial){
    $dataPool = new individu();
    $pool = $dataPool->generateAllIndividual();

    for ($i=0; $i < count($dataPool->indivPool); $i++) { 
     $this->saveIndivPool($i,$dataPool->indivPool[$i]);
    }
		
    for($i=0;$i<count($this->individu);$i++){
			$randomDay = rand(1, 6);
			 $key = array_rand($dataPool->indivPool,1);
       $a = explode('|', $dataPool->indivPool[$key]);
        array_push($a, $randomDay);
        $data = implode('|', $a);
			$this->saveIndividual($i, $data);
			}
		}
	}

	public function saveIndividual($index, $indiv) {

        $this->individu[$index] = $indiv;
    }
    public function saveIndivPool($index, $indiv) {

        $this->indivPool[$index] = $indiv;
    }
    public static function random() {
	  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
	}
	public function size() {
        return count($this->individu);
    }
	 public function getIndividual($index) {
      return  $this->individu[$index];
    }

     public static function poolSelection($pop) {
        // Create a pool population
    
       // var_dump($getMaksIndiv);
     
        $pool = new population(Population::$poolSize, false);
	   for ($i=0; $i < Population::$poolSize; $i++) {
	     $randomId = rand(0, $pop->size()-1 );
		 $pool->saveIndividual($randomId, $pop->getIndividual($randomId));
        return $randomId;
        }
       
        //return $pool->individu;
        
       
    }
   
    public static function  crossover($keyIndiv1, $indiv1,$keyIndiv2, $indiv2){
	 
       $newSol = new individu();  //create a offspring
      
        // Loop through genes
        //var_dump($indiv1);
           $split1 = explode('|', $indiv1);
            $split2 = explode('|', $indiv2);
                   $end_split1 = $split1[0].'|'.$split1[1].'|'.$split1[2].'|'.$split2[3];
                   $end_split2 = $split2[0].'|'.$split2[1].'|'.$split2[2].'|'.$split1[3];;
                    $a = array();
                    $b = array();
                    array_push($a, $end_split1);
                    array_push($b, $end_split2);
            // Crossover at which point 0..1 , .50 50% of time
            if (Population::random() <= Population::$uniformRate){
			       //  $randomId = rand(0, $pop->size()-1 ); 
              // echo '</br>';
              // echo "crossover individu index ".$keyIndiv1;print_r($a);echo " dengan individu index ".$keyIndiv2;print_r($b);
               //echo '</br>';
                $newSol->setGen($keyIndiv1, $a );
            } else {
                $newSol->setGen($keyIndiv2, $b );
            }
        
        return $newSol->indiv;
    }
    public static function mutate($pop) {
        // Loop through genes
      $newSol = new individu();
        for ($i=0; $i < $pop->size(); $i++) {
          /*
            $r = Population::random();
            if ( $r  <= Population::$mutationRate) {
            	$randomIndiv = rand(0, count($pop->indivPool)-1); 
              $randomDay = rand(1, 6);
              $individu = $pop->indivPool[$randomIndiv];
               $a = explode('|', $individu);
                array_push($a, $randomDay);
                $data = implode('|', $a);
                echo '</br>';
               echo "individu mutasi index ".$i." menjadi ";print_r($data);
             echo '</br>';
              $newSol->setGen($i,$data);
              }
              */
              $exclude_key = array();
              $exclude_value = array();
             foreach ($pop->individu as $key => $value) {
                $split = explode('|', $value);
                array_push($exclude_key, $split[0]);
                array_push($exclude_value, $pop->individu[$key]);
             }
              do {   
                  $n = rand(1,30);

              } while(in_array($n, $exclude_key));

              $n;
              
              
            }
       // var_dump($n);
        return $n;
    }

    public function evolvePopulation($pop){
        $newPopulation = new Population($pop->size(),false);

if (Population::$elitism) {
$elitism_key =  array_search(min($pop->fitness),$pop->fitness);
$pop->saveIndividual(0,$pop->individu[$elitism_key]);
}
 // Crossover population
        $elitismOffset=0;
        if (Population::$elitism) {
            $elitismOffset = 1;
        } else {
            $elitismOffset = 0;
        }
for ($i = $elitismOffset; $i < $pop->size(); $i++){ 
  if (Population::random() <= Population::$uniformRate){
    $key1 = Population::poolSelection($pop);
    $indiv1 = $pop->getIndividual($key1);
    $key2 = Population::poolSelection($pop);
    $indiv2 = $pop->getIndividual($key2);

    $newIndiv =  Population::crossover($key1,$indiv1,$key2, $indiv2);

    foreach ($newIndiv as $key => $value) {
             $randomId = rand(0, 11-1 );

      foreach ($value as $key => $value2) {
        $pop->saveIndividual($i, $value2);
          }
                
      }
       
    
  }
    //
    //var_dump($newPopulation->getIndividual($i));



//for ($i=$elitismOffset; $i < $newPopulation->size(); $i++) {
            //var_dump($newPopulation->getIndividual($i));
           if ( Population::random()  <= Population::$mutationRate) {
         $newMutate = Population::mutate($pop);
        //echo '</br>';echo "Bro"; var_dump($newMutate);  echo '</br>';
         //echo '</br>';
            //var_dump($pop->fitness);
            // echo '</br>';
          $mutate_key =  array_search(array_keys($pop->individu, max($pop->fitness)),$pop->fitness);
          $mutate_value = array_search($newMutate,$pop->indivPool);
          $mutate_value = $pop->indivPool[$mutate_value];
          $randomDay = rand(1, 6);
          $randomId = rand(0, 11);
          $a = explode('|', $mutate_value);
          array_push($a, $randomDay);
          $data = implode('|', $a);
         // echo '</br>';
               //echo "individu mutasi index ".$randomId." menjadi ";print_r($data);
            // echo '</br>';
             //var_dump($mutate_value);
          //$array_mutate = array();
         // array_push($array_mutate, $data);
          //var_dump($array_mutate);
             $pop->saveIndividual($i, $data); 
          }
       }
        
        
      
  //      }


        return $pop;
        var_dump($pop);
    }//end of func evolve

}//end of class
/*
$coba = new Population(Population::$popSize,true);
$post = $coba->individu;
var_dump($post);echo '</br>';

$fit = new Fitnesscalc();
$get = $fit->getFitness($post);

foreach ($get as $key => $value) {
    $coba->setFitness($key,$value);
}

$maks_fitness = max($coba->fitness);
var_dump($maks_fitness);

$k = 0;
while ($maks_fitness >= 1.2) {

    $myPop = Population::evolvePopulation($coba);
    //$one = array();
    //array_push($one, $myPop->individu[0]);
    //$fit->getFitness($one);
 //   var_dump($myPop);
echo "</br>";echo "</br>";
$get = $fit->getFitness($myPop->individu) ;
foreach ($get as $key => $value) {
    $myPop->setFitness($key,$value);
}
$maks_fitness = max($myPop->fitness);
var_dump($maks_fitness);
$k++;
echo "putaran ke ".$k;
if ( $k > Population::$maxiteration)
      {
        echo "\n-- Ending TOO MANY (".Population::$maxiteration.") stagnant generations unchanged. Ending APPROX solution below \n..)";
          break;
      }
}
echo '</br>';
foreach ($myPop->individu as $key => $value) {

  echo "HASIL AKHIR individu ".$value. '=  punya nilai fitness '.$myPop->fitness[$key].'</br>';

}
echo "FiNISSSHH";
*/
?>