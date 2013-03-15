<?php
class DB {
	private $connection = FALSE;

	function __construct(){
		global $db_host,$db_user,$db_name,$db_pass;
		try{
			$this->connection = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user,$db_pass);
			//$this->connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		}catch(PDOException $e){
			die($e->getMessage()."\n");
		}
	}

	function query($sql,$type='ALL',$columnNo = 0,$ins=array()){
		$query = $this->connection->query($sql);
		if($query || $type=='INSERT')
			switch($type):
				case 'ALL': return $query->fetchAll(PDO::FETCH_ASSOC);break;
				case 'COLUMN': return $query->fetchColumn($columnNo);break;
				case 'COUNT': return $query->fetchColumn(0);break;
				case 'INSERT': 
							$res = $this->connection->prepare($sql);
							return $res->execute($ins);
							break;
			endswitch;
		return false;
	}
}