<?php

class Reports {
	public $idReport;
	public $incident_date;
	public $resolution_date;
	public $total_time;
	public $explanation;
	public $measures;

	private $fields = array('idReport','incident_date','resolution_date','total_time','explanation','measures');

	public function addReport($post){
		global $db;
		if(empty($post)) return false;
		
		$ToSQL = $this->createFieldsToSQL($post);
		$sql = "INSERT INTO reports(".$ToSQL['field'].") VALUES(".$ToSQL['values'].")";
		return $db->query($sql,'INSERT',0,$ToSQL['ins']);

	}
	public function updateReport($post){
		global $db;

		$idReport = $post['idReport'];
		unset($post['idReport']);
		$ToSQL = $this->createFieldsToSQL($post,TRUE);
		
		$field = explode(',',$ToSQL['field']);
		$values = explode(',',$ToSQL['values']);
		$values = array_map('trim',$values);
		$field = array_map('trim',$field);

		$sql = "UPDATE reports SET ";
		foreach($field as $key=>$f)
			$sql .= "`$f`=".$values[$key].", ";
		$sql = substr($sql,0,-2);
		$sql .= " WHERE idReport='$idReport'" ;
		return $db->query($sql,'INSERT',0,$ToSQL['ins']);

	}
	public static function getReport($idReport){
		global $db;
		return $db->query("SELECT * FROM reports WHERE idReport='$idReport'");
	}
	public static function getIncidentsList($limit=5){
		global $db;
		return $db->query("SELECT * FROM reports ORDER BY incident_date DESC LIMIT $limit");
	}

	public static function getListWithPagination($page,$limit){
		global $db;
		return $db->query("SELECT * FROM reports ORDER BY incident_date DESC LIMIT $page,$limit");
	}
	public static function getAllReports($count=FALSE){
		global $db;
		if($count)
			return $db->query("SELECT COUNT(*) FROM reports",'COUNT');
		else
			return $db->query("SELECT * FROM reports");
	}

	private function createFieldsToSQL($post,$update=FALSE){
		$field=$values='';
		foreach($post as $key=>$value):
			$values .= ':'.$key.', ';
			$field .= $key.', ';
			
			if($key=='incident_date' || $key == 'resolution_date') $value = strtotime($value);
			if($key=='total_time') $value = str_replace(',','.',$value);

			$ins[':'.$key] = $value;  
		endforeach;
		$field = substr($field,0,-2);
		$values = substr($values,0,-2);
		return array('field'=>$field,'values'=>$values,'ins'=>$ins);
	}
}