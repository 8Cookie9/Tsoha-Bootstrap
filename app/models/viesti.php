<?php
	class Viesti extends BaseModel{
		public $id, $keskustelu_id, $kayttaja_id, $viesti_id, $sisalto, $aika, $validators;
		
		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_sisalto');
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Viesti');
			$query->execute();
			$rows = $query->fetchAll();
			$viestit = array();

			foreach($rows as $row){
				$viestit[] = new Viesti(array(
					'id' => $row['id'],
					'keskustelu_id' => $row['keskustelu_id'],
					'kayttaja_id' => $row['kayttaja_id'],
					'sisalto' => $row['sisalto'],
					'aika' => $row['aika']
				));
			}

			return $viestit;
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
		
		public static function search($haku){
			$query = DB::connection()->prepare('SELECT * FROM Keskustelu WHERE (id IN  (SELECT keskustelu_id FROM Viesti WHERE sisalto LIKE :haku)) OR otsikko LIKE :haku');
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
			$query = DB::connection()->prepare('DELETE FROM Viesti WHERE id=:id RETURNING keskustelu_id');
			$query->execute(array('id' => $this->id));
			$row = $query->fetch();
			$this->keskustelu_id = $row['keskustelu_id'];
		}
		
		public function validate_sisalto(){
			$errors = array();
			if($this->sisalto == '' || $this->sisalto == null){
				$errors[] = 'Viesti ei saa olla tyhjä!';
			}else if(strlen($this->sisalto) < 5){
				$errors[] = 'Viesti on liian lyhyt!';
			}
			return $errors;
		}
	}