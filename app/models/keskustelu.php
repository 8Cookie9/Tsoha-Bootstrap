<?php
	class Keskustelu extends BaseModel{
		public $id, $kayttaja_id, $aihealue_id, $otsikko, $validators;
		
		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_otsikko');
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Keskustelu');
			$query->execute();
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
		
		public static function search($haku){
			$query = DB::connection()->prepare('SELECT * FROM Keskustelu WHERE otsikko LIKE :haku');
			$query->execute(array('haku' => '%' . $haku . '%'));
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
		
		public static function allFrom($id){
			$query = DB::connection()->prepare('SELECT * FROM Viesti v, Keskustelu k WHERE v.keskustelu_id = k.id AND k.aihealue_id = :id AND v.aika IN (SELECT aika FROM Viesti WHERE keskustelu_id = k.id ORDER BY aika DESC LIMIT 1) ORDER BY v.aika DESC');
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
			$query = DB::connection()->prepare('INSERT INTO Keskustelu (aihealue_id, kayttaja_id, otsikko) VALUES (:aihealue_id, :kayttaja_id, :otsikko) RETURNING id');
			$query->execute(array('aihealue_id' => $this->aihealue_id, 'kayttaja_id' => $this->kayttaja_id, 'otsikko' => $this->otsikko));
			$row = $query->fetch();
			$this->id = $row['id'];
		}
		
		public function update(){
			$query = DB::connection()->prepare('UPDATE Keskustelu SET otsikko=:otsikko WHERE id=:id RETURNING aihealue_id');
			$query->execute(array('id' => $this->id, 'otsikko' => $this->otsikko));
			$row = $query->fetch();
			$this->aihealue_id = $row['aihealue_id'];
		}
		
		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Luettu WHERE keskustelu_id=:id');
			$query->execute(array('id' => $this->id));
			$query = DB::connection()->prepare('DELETE FROM Viesti WHERE keskustelu_id=:id');
			$query->execute(array('id' => $this->id));
			$query = DB::connection()->prepare('DELETE FROM Keskustelu WHERE id=:id RETURNING aihealue_id');
			$query->execute(array('id' => $this->id));
			$row = $query->fetch();
			$this->aihealue_id = $row['aihealue_id'];
		}
		
		public function validate_otsikko(){
			$errors = array();
			if($this->otsikko == '' || $this->otsikko == null){
				$errors[] = 'Otsikko ei saa olla tyhjä!';
			}else if(strlen($this->otsikko) < 4){
				$errors[] = 'Otsikko on liian lyhyt (alle 4 merkkiä)!';
			}
			return $errors;
		}
	}