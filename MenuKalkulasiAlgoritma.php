<?php
require_once ('Population.php');


/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:30 PM
 */
class MenuKalkulasiAlgoritma extends Individu
{

	



	public function tampilPc()
	{
		$data = new Individu();
		$data->setGenPc($array_individu);
	}

}
//$this = new Individu();
	
	$populasi = new Population();
	$populasi->setPopulasi(false);
	$populasi->loop();

?>