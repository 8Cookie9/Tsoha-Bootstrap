<?php
	class Keskustelu extends BaseModel{
		public $id, $kayttaja_id, $aihealue_id, $otsikko;
		
		public function __construct($attributes){
			parent::__construct($attributes);
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Keskustelu');
			$query->execute();
			$rows = $query->fetchAll();
			$messages = array();

			foreach($rows as $row){
				$messages[] = new Keskustelu(array(
					'id' => $row['id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'aihealue_id' => $row['aihealue_id'],
					'otsikko' => $row['otsikko']
				));
			}

			return $messages;
		}
		
		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Keskustelu WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
				$Keskustelu = new Keskustelu(array(
					'id' => $row['id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'aihealue_id' => $row['aihealue_id'],
					'otsikko' => $row['otsikko']
				));
			return $Keskustelu;
		}
		return null;
	  }
	}