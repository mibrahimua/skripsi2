<?php
/************************************************************************
/ GA : Genetic Algorithms  main page
/
/************************************************************************/

//require_once('individual.php');  //supporting individual 
require_once('population.php');  //supporting population 
require_once('fitnesscalc.php');  //supporting fitnesscalc 
require_once('algorithm.php');  //supporting fitnesscalc 

$solution_phrase="A genetic algorithm found!";
algorithm::$uniformRate=0.50;
algorithm::$mutationRate=0.05;
algorithm::$poolSize=12; /* crossover how many to select in each pool to breed from */
$initial_population_size=12;		//how many random individuals are in initial population (generation 0)
algorithm::$max_generation_stagnant=400;  //maximum number of unchanged generations terminate loop
algorithm::$elitism=true;  //keep fittest individual  for next gen

$lowest_time_s=100.00; //keeps track of lowest time in seconds

$generationCount = 0;
$generation_stagnant=0; 
$most_fit=0;
$most_fit_last=400;


  
  
        // Set a candidate solution static class
		
echo "\nMax Fitness is :".fitnesscalc::getMaxFitness();
echo "\n-----------------------------------------------";
		
		
        // Create an initial population
		$time1 = microtime(true);
       $myPop = new population($initial_population_size, true);
       echo $myPop;
        // Evolve our population until we reach an optimum solution
        //while ($myPop->getFittest()->getFitness() > fitnesscalc::getMaxFitness())
 			for ($i=0; $i < 2; $i++)  
 			{
            $generationCount++;
			$most_fit=$myPop->getFittest()->getFitness();
			//var_dump($most_fit);
          
		   $myPop = algorithm::evolvePopulation($myPop); //create a new generation
		   
		   if ($most_fit < $most_fit_last)
		   {
			// echo " *** MOST FIT ".$most_fit." Most fit last".$most_fit_last;
			 echo "\n Generation: " .$generationCount." (Stagnant:".$generation_stagnant.") Fittest: ". $most_fit."/".fitnesscalc::getMaxFitness() ;
			 echo "  Best: ". $myPop->getFittest();
			   $most_fit_last=$most_fit;
			   $generation_stagnant=0; //reset stagnant generation counter
		   }
		   else
		     $generation_stagnant++; //no improvement increment may want to end early
		 
		  if ( $generation_stagnant > algorithm::$max_generation_stagnant)
		  {
			  echo "\n-- Ending TOO MANY (".algorithm::$max_generation_stagnant.") stagnant generations unchanged. Ending APPROX solution below \n..)";
		      break;
		  }
			
        }  //end of while loop
		
		//we're done
		$time2 = microtime(true);
		
		
        echo "\nSolution at generation: ".$generationCount. " time: ".round($time2-$time1,2)."s";
		echo "\n---------------------------------------------------------\n";
		echo "\nGenes   : ".$myPop->getFittest() ;
		//echo "\nSolution: ".implode("",fitnesscalc::$solution);  //convert array to string
		echo "\n---------------------------------------------------------\n";
		
		

?>
