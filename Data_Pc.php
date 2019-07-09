<?php




/**
 * @author M Ibrahim U Albab
 * @version 1.0
 * @created 03-Jun-2019 11:19:30 PM
 */
class Data_Pc
{    

	public function __construct()
    {
    	  $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "skripsi";
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;

        $connect = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if($connect->error){
            die('Could not connect with the database!');
        }

        $this->connect = $connect;
    }

	
	
	public function connect()
    {
        $this->__construct($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
    }


	public function getPc()
	{
		$order_rand = "ORDER BY RAND() ";
		$limit = "LIMIT 12";
		$query = "SELECT kode_inventori, (monitor_pc + mouse_pc + keyboard_pc + kipasproces_pc + hdd_pc + ram_pc + process_pc) AS nilai_gen FROM data_pc ".$order_rand.$limit;

		
		$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		    $hasil[] = $d;
	}
	return $hasil;
	}

	public function getRow()
	{
		$limit = "ORDER BY RAND() LIMIT 12";
		$query = "SELECT * FROM data_pc ";

		
		$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

		
	return $row;
	}

	public function getMeanAllPc()
	{
		//$limit = "ORDER BY RAND() LIMIT 12";
		$query = "SELECT (monitor_pc + mouse_pc + keyboard_pc + kipasproces_pc + hdd_pc + ram_pc + process_pc) / 7 AS nilai_gen FROM data_pc";

		
		$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);

	for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		     $hasil[] = $d['nilai_gen'];
	}
	$nilai_gen = sqrt(pow(($hasil),2)/$row);
	$hasil = array_sum($hasil);
	
	return $nilai_gen;
	}

	public function getNewPc($array)
	{
		$para3 = array();

		$size_limit = 12 - count($array);
		//$size_limit = 12;
		$order_rand = " ORDER BY RAND() ";	
		//$limit = $order_rand."LIMIT ".$size_limit;
		$limit = $order_rand."LIMIT ".$size_limit;
		$not_like = "kode_inventori != ";
		foreach ($array as $key => $value) {
			$a = $not_like."'$key'";
			//var_dump($a);
			$para2 = array_push($para3,$a) ;

			
		}
		$this->setPara($para3);
		//var_dump($this->para);
		$para = implode(" AND ", $this->para);
		$query = "SELECT kode_inventori, (monitor_pc + mouse_pc + keyboard_pc + kipasproces_pc + hdd_pc + ram_pc + process_pc) AS nilai_gen FROM data_pc WHERE ".$para.$limit;
		//var_dump($size_limit);
		echo "debug query : ";
		var_dump($query);

		$data = $this->connect -> query($query);
		$row = mysqli_num_rows($data);
		if($row > 0){
		for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		    $hasil[] = $d;
			}
			return $hasil;
			}
	
	
	}

	public function slot_waktu(){
	$query = "SELECT id_slot FROM slot_waktu ORDER BY RAND() LIMIT 1";
	$data = $this->connect -> query($query);

	$row = mysqli_num_rows($data);

	for ($i=0; $i < $row; $i++) { 
			$d = mysqli_fetch_array($data);
		    $hasil[] = $d;
	}
	return $hasil;
	}

	public function getPara(){
		return $this->para;
	}

	public function setPara($value){
		$this->para = $value;
	}

}
?>