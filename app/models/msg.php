<?php
	class Msg extends BaseModel{
		public $id, $thread_id, $user_id, $ans_id, $content;
		
		public function __construct($attributes){
			parent::__construct($attributes);
		}
		
		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Viesti');
			$query->execute();
			$rows = $query->fetchAll();
			$messages = array();

			foreach($rows as $row){
				$messages[] = new Msg(array(
					'id' => $row['id'],
					'thread_id' => $row['thread_id'],
					'user_id' => $row['user_id'],
					'ans_id' => $row['ans_id'],
					'content' => $row['content']
				));
			}

			return $messages;
		}
		
		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Viesti WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();
			if($row){
				$msg = new Msg(array(
					'id' => $row['id'],
					'thread_id' => $row['thread_id'],
					'user_id' => $row['user_id'],
					'ans_id' => $row['ans_id'],
					'content' => $row['content']
				));
			return $msg;
		}
		return null;
	  }
	}