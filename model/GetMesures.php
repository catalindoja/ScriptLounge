<?php
	include_once('SqlConnector.php')
	class GetMesures() {
		private $sqlconnector;
		public function __construct()
		{
			$this->sqlconnector = new SqlConnector();
		}
		
		public function insertMesure($idDevice, $idTemperature, $date)
		{
			$sql = "INSERT INTO mesura(idDevice, Temps) VALUE($idDevice, $idTeamperature, '$date');";
			return $this->sqlconnector->executeQuery($sql);
		}
		
		public function insertTemperature($idDevice, $idTemperature, $value) 
        {
			$sql = "INSERT INTO humitat(idDevice, idHumitat, valor) VALUE($idDevice, $idTemperature, $value);";
			return $this->sqlconnector->executeQuery($sql);
		}
		
		public function insertHumidity($idDevice, $idTemperature, $value)
		{
			$sql = "INSERT INTO humitat(idDevice, idTemperatura, valor) VALUE($idDevice, $idTemperature, $value);";
			return $this->sqlconnector->executeQuery($sql);
		}
	}
?>