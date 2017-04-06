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
	  
	  public function save(){
		$query = DB::connection()->prepare('INSERT INTO Aihealue (nimi) VALUES (:nimi) RETURNING id');
		$query->execute(array('nimi' => $this->nimi));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
	
	public function destroy(){
		$query = DB::connection()->prepare('DELETE FROM Aihealue WHERE id=:id RETURNING id');
		$query->execute(array('id' => $this->id));
		$row = $query->fetch();
		$aaid = $row['aihealue_id'];
		$query = DB::connection()->prepare('DELETE FROM Keskustelu WHERE aihealue_id=:id RETURNING id');
		$query->execute(array('id' => $aaid));
		$row = $query->fetch();
		$kid = $row['aihealue_id'];
		$query = DB::connection()->prepare('DELETE FROM Viesti WHERE keskustelu_id=:id');
		$query->execute(array('id' => $kid));
	}
	
	public function validate_nimi(){
		$errors = array();
		if($this->nimi == '' || $this->nimi == null){
			$errors[] = 'Nimi ei saa olla tyhjä!';
		}
		return $errors;
	}
}