<?php
require_once('individual.php');

$popSize = 12;

for ($i=0; $i < $popSize ; $i++) { 
	$data[$i] = new Individu ();
	 $data[$i]->generateIndividual(1);
}
var_dump($data->id_pc[1]);
echo '</br';


?>