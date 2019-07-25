<?php
require_once('Individual.php');

/**
 * 
 */
class Population extends Individu
{
	public $individu=array();
	static $static_array = array();
	public static $elitism=true;
	public static $poolSize=1;
	public static $uniformRate=0.5;
	public static $mutationRate=0.20;
  public static $maxiteration = 100;
	function __construct($popSize,$initial = false)
	{
		if(!isset($popSize) || $popSize ==0)
		die("Harus memiliki populasi lebih dari 0");
	
	for($i=0;$i<$popSize;$i++)
		$this->individu[$i] = new Individu();

	if($initial){
		for($i=0;$i<count($this->individu);$i++){
			$new_indiv = new Individu();
			 $new_indiv->generateIndividual(1);
			 $new_sol = $new_indiv->indiv;
			$this->saveIndividual($i, $new_sol);
			}
		}
	}

	public function saveIndividual($index, $indiv) {

        $this->individu[$index] = $indiv;
    }
    public static function random() {
	  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
	}
	public function size() {
        return count($this->individu);
    }
	
     public static function poolSelection($pop) {
        // Create a pool population
     asort($pop->fitness);
      $t = $pop->fitness;
    
      $getMaksIndiv = array_keys($t, min($t));
      
     
        $pool = new population(Population::$poolSize, false);
	   for ($i=0; $i < Population::$poolSize; $i++) {
	     $randomId = rand(0, $pop->size()-1 ); //Get a random individual from anywhere in the population
	     //var_dump($randomId);
		 $pool->saveIndividual($i, $pop->getIndividual($randomId));
        }

        // Get the fittest
        //$fittest = $pool->getFittest();
        return $pool->individu;
    }
    public function getIndividual($index) {
      return  $this->individu[$index];
    }
    public static function  crossover($indiv1, $indiv2) 
	 {
       $newSol = new individu();  //create a offspring
      
        // Loop through genes
        for ($i=0; $i < count($indiv1); $i++) {
           $split1 = explode('|', $indiv1[$i][0]);
                   $split2 = explode('|', $indiv2[$i][0]);
                   $end_split1 = $split1[0].'|'.$split1[1].'|'.$split1[2].'|'.$split2[3];
                   $end_split2 = $split2[0].'|'.$split2[1].'|'.$split1[2].'|'.$split1[3];;
                    $a = array();
                    $b = array();
                    array_push($a, $end_split1);
                    array_push($b, $end_split2);
            // Crossover at which point 0..1 , .50 50% of time
            if (Population::random() <= Population::$uniformRate){
			       //  $randomId = rand(0, $pop->size()-1 ); 
                echo '</br>';
               echo "crossover individu ";print_r($a);echo " dengan individu ";print_r($b);
               echo '</br>';
                $newSol->setGen($i, $a );
            } else {
                $newSol->setGen($i, $b );
            }
        }
        return $newSol;
    }
    public static function mutate($pop) {
        // Loop through genes
      $newSol = new individu();
        for ($i=0; $i < $pop->size(); $i++) {

            if (  Population::random() <= Population::$mutationRate) {
            	$randomId = rand(1, 6); 
              $individu = $pop->getIndividual($i);
              foreach ($individu as $key => $value) {
              $split = explode('|', $value);
              $individu = $split[0].'|'.$split[1].'|'.$split[2].'|'.$randomId;
               $a = array();
               array_push($a, $individu);
                echo '</br>';
               echo "individu mutasi ";print_r($a);
               echo '</br>';
              $newSol->setGen($i,$a);
              }
              
            }
        }
        return $newSol;
    }

    public function evolvePopulation($pop){
        $newPopulation = new Population($pop->size(),true);

if (Population::$elitism) {
$elitism_key =  array_search(min($pop->fitness),$pop->fitness);
$newPopulation->saveIndividual(0,$pop->individu[$elitism_key]);
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
    $indiv1 = Population::poolSelection($pop);
    $indiv2 = Population::poolSelection($pop);
    $newIndiv =  Population::crossover($indiv1, $indiv2);
    foreach ($newIndiv->indiv as $key => $value) {
        $newPopulation->saveIndividual($i, $value); 
    }
  }
    //
    //var_dump($newPopulation->getIndividual($i));
}


//for ($i=$elitismOffset; $i < $newPopulation->size(); $i++) {
            //var_dump($newPopulation->getIndividual($i));
            
         $newMutate = Population::mutate($pop);
         foreach ($newMutate->indiv as $key => $value) {
          $randomId = rand(0, 11-1 );
        $newPopulation->saveIndividual($randomId, $value); 
        }
         
  //      }


        return $newPopulation;
    }//end of func evolve

}//end of class
$z = 0;

    $coba = new Population(12,true);
$post = $coba->individu;
$fit = new Fitnesscalc();
$get = $fit->getFitness($post);

foreach ($get as $key => $value) {
    $coba->setFitness($key,$value);
}
$maks_fitness = max($coba->fitness);
var_dump($maks_fitness);
$k = 0;
while ($maks_fitness >= 1.01) { 
    $myPop = Population::evolvePopulation($coba);
    //var_dump($myPop->individu);
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
/*
while($maks_fitness > 0){



  $array_newpop = array();
foreach ($newPopulation->individu as $key => $value) {
	
	array_push($array_newpop, $value);
}
$fit2 = new Fitnesscalc();
var_dump($newPopulation->individu);echo '</br>';
$get2 = $fit2->getFitness($newPopulation->individu);
echo $z++;

}
*/
?>