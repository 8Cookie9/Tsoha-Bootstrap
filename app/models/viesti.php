<?php
	class Viesti extends BaseModel{
		public $id, $keskustelu_id, $kayttaja_id, $viesti_id, $sisalto;
		
		public function __construct($attributes){
			parent::__construct($attributes);
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Viesti');
			$query->execute();
			$rows = $query->fetchAll();
			$messages = array();

			foreach($rows as $row){
				$messages[] = new Viesti(array(
					'id' => $row['id'],
					'keskustelu_id' => $row['keskustelu_id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'viesti_id' => $row['viesti_id'],
					'sisalto' => $row['sisalto']
				));
			}

			return $messages;
		}
		
		public static function allFrom($id){
			$query = DB::connection()->prepare('SELECT * FROM Viesti WHERE keskustelu_id = :id');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$viestit = array();

			foreach($rows as $row){
				$viestit[] = new viesti(array(
					'id' => $row['id'],
					'keskustelu_id' => $row['keskustelu_id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'viesti_id' => $row['viesti_id'],
					'sisalto' => $row['sisalto']
				));
			}

			return $viestit;
		}
		
		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Viesti WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
				$Viesti = new Viesti(array(
					'id' => $row['id'],
					'keskustelu_id' => $row['keskustelu_id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'viesti_id' => $row['viesti_id'],
					'sisalto' => $row['sisalto']
				));
			return $Viesti;
		}
		return null;
	  }
	}