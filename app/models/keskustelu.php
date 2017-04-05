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
		
		public static function allFrom($id){
			$query = DB::connection()->prepare('SELECT * FROM Keskustelu WHERE aihealue_id = :id');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$keskustelut = array();

			foreach($rows as $row){
				$keskustelut[] = new Keskustelu(array(
					'id' => $row['id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'aihealue_id' => $row['aihealue_id'],
					'otsikko' => $row['otsikko']
				));
			}

			return $keskustelut;
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
	  
	  public function save(){
			$query = DB::connection()->prepare('INSERT INTO Keskustelu (aihealue_id, kayttaja_id, otsikko) VALUES (:aihealue_id, :kayttaja_id, :otsikko)');
			$query->execute(array('aihealue_id' => $this->aihealue_id, 'kayttaja_id' => $this->kayttaja_id, 'otsikko' => $this->otsikko));
			$row = $query->fetch();
			$this->id = $row['id'];
		}
	}