<?php
/************************************************************************
/ Class geneticAlgorithm : Genetic Algorithms 
/
/************************************************************************/


require_once('individual.php');  //supporting class file
require_once('population.php');  //supporting class file

class algorithm {

    /* GA parameters */
  public static $uniformRate=0.5;  /* crosssover determine what where to break gene string */
  public static $mutationRate=0.20; /* When choosing which genes to mutate what rate of random values are mutated */
  public static $poolSize=10;  /* When selecting for crossover how large each pool should be */
  public static $max_generation_stagnant=200;  /*how many unchanged generations before we end */
  public static $elitism=true;

    /* Public methods */
    
    // Convenience random function
 private static function random() {
  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
}
	
    public static function evolvePopulation($pop) {
       $newPopulation = new population($pop->size(), false);

	  
        // Keep our best individual
        if (algorithm::$elitism) {
            $newPopulation->saveIndividual(0, $pop->getFittest($pop));
	    }

        // Crossover population
        $elitismOffset=0;
        if (algorithm::$elitism) {
            $elitismOffset = 1;
        } else {
            $elitismOffset = 0;
        }
		
        // Loop over the population size and create new individuals with
        // crossover
	
        for ($i = $elitismOffset; $i < $pop->size(); $i++) 
		{	 
            $indiv1 = algorithm::poolSelection($pop);
            $indiv2 = algorithm::poolSelection($pop);
            $newIndiv =  algorithm::crossover($indiv1, $indiv2);
            $newPopulation->saveIndividual($i, $newIndiv);
        }

        // Mutate population
	
        for ($i=$elitismOffset; $i < $newPopulation->size(); $i++) {
            algorithm::mutate($newPopulation->getIndividual($i));
        }

	
        return $newPopulation;
    }

    // Crossover individuals (aka reproduction)
    private static function  crossover($indiv1, $indiv2) 
	 {
       $newSol = new individu();  //create a offspring
        // Loop through genes
        for ($i=0; $i < $indiv1->size(); $i++) {
            // Crossover at which point 0..1 , .50 50% of time
            if (  algorithm::random() <= algorithm::$uniformRate)
			{
                $newSol->setIdPc($i, $indiv1->getIdPc($i) );
                $newSol->setTglTerakhir($i, $indiv1->getTglTerakhir($i));
                $newSol->setIdDept($i, $indiv1->getIdDept($i) );
                $newSol->setIdDept2($i, $indiv1->getIdDept2($i) );
            } else {
                $newSol->setIdPc($i, $indiv1->getIdPc($i) );
                $newSol->setTglTerakhir($i, $indiv1->getTglTerakhir($i));
                $newSol->setIdDept($i, $indiv1->getIdDept($i) );
                $newSol->setIdDept2($i, $indiv1->getIdDept2($i) );
            }
        }
        return $newSol;
    }

    // Mutate an individual
    private static function mutate( $indiv) {
        // Loop through genes
        for ($i=0; $i < $indiv->size(); $i++) {

            if (  algorithm::random() <= algorithm::$mutationRate) {

              $a = $indiv->getMutatePc(); 
               foreach ($a as $key => $value) {
                  $indiv->setIdPc($i,$value['id_pc']);
                  $indiv->setTglTerakhir($i,$value['tgl_terakhir']);
                  $indiv->setIdDept($i,$value['id_dept']);
                  $indiv->setIdDept2($i,$value['id_dept2']);
               }
            
            }
        }
    }

    // Select a pool of individuals for crossover
    private static function poolSelection($pop) {
        // Create a pool population
        $pool = new population(algorithm::$poolSize, false);
	
	   for ($i=0; $i < algorithm::$poolSize; $i++) {
	     $randomId = rand(0, $pop->size()-1 ); //Get a random individual from anywhere in the population
			$pool->saveIndividual($i, $pop->getIndividual( $randomId));

        }
        // Get the fittest
        $fittest = $pool->getFittest();
        return $fittest;
    }


	}  //class

    $awalPop = new population(12,true);

     $most_fit=$awalPop->getFittest()->getFitness();
     //var_dump($most_fit);
    // var_dump($awalPop->people[$most_fit]->id_pc);
    $evolusi = algorithm::evolvePopulation($awalPop);
foreach ($evolusi->people as $key) {
         echo 'id pc :';print_r($key->id_pc);echo '</br>';
         echo 'id dept :';print_r($key->id_dept);echo '</br>';
         echo 'id dept2 :';print_r($key->id_dept2);echo '</br>';
         echo 'fitness :';print_r($key->fitness);echo '</br>'.'</br>';
     }

?>