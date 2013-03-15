<?php
class Comments {
	public $idComment;
	public $idReport;
	public $name;
	public $comment_date;
	public $comment;

	private $fields = array('idComment','idReport','name','comment_date','comment');

	public static function addComment($post){
		global $db;
		if(empty($post)) return false;
		
		$field=$values='';
		foreach($post as $key=>$value):
			$values .= ':'.$key.', ';
			$field .= $key.', ';
			
			$ins[':'.$key] = $value;  
		endforeach;
		$field = substr($field,0,-2);
		$values = substr($values,0,-2);
		$sql = "INSERT INTO comments(".$field.") VALUES(".$values.")";
		return $db->query($sql,'INSERT',0,$ins);
	}

	public static function getAllComments($count=FALSE){
		global $db;
		if($count)
			return $db->query("SELECT COUNT(*) FROM comments",'COUNT');
		else
			return $db->query("SELECT * FROM comments");
	}

	public static function getComentsList($limit=5){
		global $db;
		return $db->query("SELECT * FROM comments LIMIT $limit");
	}

	public static function getCommentsForReport($idReport,$count=FALSE){
		global $db;
		if($count)
			return $db->query("SELECT COUNT(*) FROM comments WHERE idReport='$idReport'",'COUNT');
		else
			return $db->query("SELECT * FROM comments WHERE idReport='$idReport'");	
	}
}