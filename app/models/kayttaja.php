<?php
	class Kayttaja extends BaseModel{
		public $id, $nimi, $salasana, $admin, $validators;
		
		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_nimi');
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Kayttaja');
			$query->execute();
			$rows = $query->fetchAll();
			$messages = array();

			foreach($rows as $row){
				$messages[] = new Kayttaja(array(
					'id' => $row['id'],
					'nimi' => $row['nimi'],
					'salasana' => $row['salasana'],
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
				$Kayttaja = new Kayttaja(array(
					'id' => $row['id'],
					'nimi' => $row['nimi'],
					'salasana' => $row['salasana'],
					'admin' => $row['admin']
				));
			return $Kayttaja;
		}
		return null;
	  }
	  
	  public static function authenticate($username, $password){
			$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
			$query->execute(array('nimi' => $username, 'salasana' => $password));
			$row = $query->fetch();
			if($row){
				$Kayttaja = new Kayttaja(array(
					'id' => $row['id'],
					'nimi' => $row['nimi'],
					'salasana' => $row['salasana'],
					'admin' => $row['admin']
				));
			return $Kayttaja;
		}
		return null;
	  }
	  
  public function validate_nimi(){
		$errors = array();
		if($this->nimi == '' || $this->nimi == null){
			$errors[] = 'Nimi ei saa olla tyhjä!';
		}
		return $errors;
	}
	
	public function add_luettu($keskustelu_id){
		$query = DB::connection()->prepare('DELETE FROM Luettu WHERE kayttaja_id=:kayttaja_id AND keskustelu_id=:keskustelu_id');
		$query->execute(array('keskustelu_id' => $keskustelu_id, 'kayttaja_id' => $this->id));
		$query = DB::connection()->prepare('INSERT INTO Luettu (keskustelu_id, kayttaja_id) VALUES (:keskustelu_id, :kayttaja_id)');
		$query->execute(array('keskustelu_id' => $keskustelu_id, 'kayttaja_id' => $this->id));
	}
	
	public function luettu(){
		$query = DB::connection()->prepare('SELECT keskustelu_id FROM Luettu WHERE kayttaja_id = :kayttaja_id');
		$query->execute(array('kayttaja_id' => $this->id));
		$rows = $query->fetchAll();
		return $rows;
	}
}