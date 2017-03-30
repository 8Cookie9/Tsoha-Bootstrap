<?php
	class Aihealue extends BaseModel{
		public $id, $nimi;
		
		public function __construct($attributes){
			parent::__construct($attributes);
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Aihealue');
			$query->execute();
			$rows = $query->fetchAll();
			$messages = array();

			foreach($rows as $row){
				$messages[] = new Aihealue(array(
					'id' => $row['id'],
					'nimi' => $row['nimi']
				));
			}

			return $messages;
		}
		
		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Aihealue WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
				$Aihealue = new Aihealue(array(
					'id' => $row['id'],
					'nimi' => $row['nimi']
				));
			return $Aihealue;
		}
		return null;
	  }
	}