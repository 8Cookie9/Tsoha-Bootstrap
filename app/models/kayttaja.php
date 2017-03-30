<?php
	class Kayttaja extends BaseModel{
		public $id, $nimi, $admin;
		
		public function __construct($attributes){
			parent::__construct($attributes);
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Kayttaja');
			$query->execute();
			$rows = $query->fetchAll();
			$messages = array();

			foreach($rows as $row){
				$messages[] = new Aihealue(array(
					'id' => $row['id'],
					'nimi' => $row['nimi'],
					'admin' => $row['admin']
				));
			}

			return $messages;
		}
		
		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
				$Aihealue = new Aihealue(array(
					'id' => $row['id'],
					'nimi' => $row['nimi'],
					'admin' => $row['admin']
				));
			return $Aihealue;
		}
		return null;
	  }
	}