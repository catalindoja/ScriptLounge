<?php
	class SqlConnector {
		private $connection;
		public __construct()
		{
			$this->connection = new myqli("sql313.epizy.com", "epiz_24837380", "HackEPS2019", "epiz_24837380_scriptlounge");
		}
		
		public function checkConnection(){
			return $this->connection->connect_errno;
		}
		
		public function executeQuery($sql)
		{
			return $this->connection->query($sql);
		}
		
		public function fetchQuery($sql)
		{
			$result = $this->connection->query($sql);
			return $result->fetch_assoc();
		}
		
		public function closeConnection()
		{
			$this->connection->close();
		}
		
	}
?>