<?php
class algorithm{
public static $uniformRate=0.5;

private static function random() {
  return (float)rand()/(float)getrandmax();  /* return number from 0 .. 1 as a decimal */
}

function crossover($indiv1, $indiv2) 
	 {
       //$newSol = new individual();  //create a offspring
        // Loop through genes
       
            // Crossover at which point 0..1 , .50 50% of time
            if (  algorithm::random() <= algorithm::$uniformRate)
			{
                $newSol = $indiv1;
            } else {
            	array_push($indiv2, $indiv1[1]);
                $newSol = $indiv2;
            }
        
        return $newSol;
    }

}
$test = new algorithm();


$arrX = array("Kay", "Joe","Susan", "Frank");
$arrX2 = array("March", "June","August", "July");
 print_r($arrX);
 echo "</br>";
 print_r($arrX2);
 echo "</br>";
$cross = $test->crossover($arrX,$arrX2); 
// output the value for the random index
print_r($cross);




?>