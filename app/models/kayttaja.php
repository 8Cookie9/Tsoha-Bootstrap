<?php
	class Kayttaja extends BaseModel{
		public $id, $nimi, $salasana, $admin;
		
		public function __construct($attributes){
			parent::__construct($attributes);
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
	}