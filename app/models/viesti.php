<?php
	class Viesti extends BaseModel{
		public $id, $keskustelu_id, $kayttaja_id, $viesti_id, $sisalto, $aika;
		
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
					'sisalto' => $row['sisalto'],
					'aika' => $row['aika']
				));
			}

			return $messages;
		}
		
		public static function allFrom($id){
			$query = DB::connection()->prepare('SELECT * FROM Viesti WHERE keskustelu_id = :id ORDER BY aika ASC');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$viestit = array();

			foreach($rows as $row){
				$viestit[] = new viesti(array(
					'id' => $row['id'],
					'keskustelu_id' => $row['keskustelu_id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'sisalto' => $row['sisalto'],
					'aika' => $row['aika']
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
					'sisalto' => $row['sisalto'],
					'aika' => $row['aika']
				));
			return $Viesti;
		}
		return null;
	  }
	  
		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Viesti (keskustelu_id, kayttaja_id, sisalto) VALUES (:keskustelu_id, :kayttaja_id, :sisalto)');
			$query->execute(array('keskustelu_id' => $this->keskustelu_id, 'kayttaja_id' => $this->kayttaja_id, 'sisalto' => $this->sisalto));
		}
		
		public function update(){
			$query = DB::connection()->prepare('UPDATE Viesti SET sisalto=:sisalto WHERE id=:id RETURNING keskustelu_id');
			$query->execute(array('id' => $this->id, 'sisalto' => $this->sisalto));
			$row = $query->fetch();
			$this->keskustelu_id = $row['keskustelu_id'];
		}
		
		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Viesti WHERE id=:id');
			$query->execute(array('id' => $this->id);
			$row = $query->fetch();
			$this->keskustelu_id = $row['keskustelu_id'];
		}
		
		public function validate_sisalto(){
		  $errors = array();
		  if($this->sisalto == '' || $this->sisalto == null){
			$errors[] = 'Viesti ei saa olla tyhjä!';
		  }
		  return $errors;
		}
	}