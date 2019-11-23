<?php
	include_once('SqlConnector.php');
	class InsertMesures
	{
		private $sqlconnector;
		public function __construct()
		{
			$this->sqlconnector = new SqlConnector();
		}
		
		public function insertMesure($idDevice, $date)
		{
			$resultat = "";
			$date = $date/1000;
			if(!$this->existsMesure($idDevice, $date)){
				$sql = "INSERT INTO mesura(idDevice, Temps) VALUES($idDevice, FROM_UNIXTIME(CAST($date AS INT)));";
				$resultat = $this->sqlconnector->executeQuery($sql);
			}
			return $resultat;
		}
		
		public function insertTemperature($idDevice, $date, $value)
		{
			$sql = "INSERT INTO temperatura(idDevice, Temps, idTemperatura, valor) VALUES($idDevice, FROM_UNIXTIME(CAST($date AS INT)), (SELECT IFNULL(MAX(idTemperatura),0) + 1 FROM temperatura f WHERE idDevice = $idDevice), $value);";
			return $this->sqlconnector->executeQuery($sql);
		}
		
		public function insertHumidity($idDevice, $date, $value)
		{
			$sql = "INSERT INTO humitat(idDevice, Temps, idHumitat, valor) VALUES($idDevice, FROM_UNIXTIME(CAST($date AS INT)), (SELECT IFNULL(MAX(idHumitat),0) + 1 FROM humitat h WHERE idDevice = $idDevice ), $value);";
			return $this->sqlconnector->executeQuery($sql);
		}
		
		private function existsMesure($idDevice, $date){
			$sql = "SELECT COUNT(*) tot FROM mesura WHERE idDevice = $idDevice AND Temps = FROM_UNIXTIME(CAST($date AS INT));";
			$resultat = $this->sqlconnector->fetchQuery($sql);
			return $resultat[0]["tot"] > 0;
		}
	}
?>