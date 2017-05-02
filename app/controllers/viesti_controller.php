<?php
	class ViestiController extends BaseController{

	public static function store($id){
		$params = $_POST;
		$viesti = new Viesti(array(
			'keskustelu_id' => $id,
			'kayttaja_id' => self::get_user_logged_in()->id,
			'sisalto' => $params['content']
		));
		
		$errors = $viesti->errors();
		if(count($errors) > 0){
			Redirect::to('/keskustelu/' . $id, array('errors' => $errors, 'content' => $params['content']));
		}
		
		$viesti->save();
		$query = DB::connection()->prepare('DELETE FROM Luettu WHERE keskustelu_id=:id');
		$query->execute(array('id' => $id));
		Redirect::to('/keskustelu/' . $id, array('message' => 'Viesti lähetetty!', 'content' => $params['content']));
	}
	
	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'sisalto' => $params['content']
		);

		$viesti = new Viesti($attributes);
		
		$errors = $viesti->errors();
		if(count($errors) > 0){
			Redirect::to('/editviesti/' . $viesti->id, array('errors' => $errors, 'content' => $params['content']));
		}
		$viesti->update();
		Redirect::to('/keskustelu/' . $viesti->keskustelu_id, array('message' => 'Viestiä muokattu!'));
    }
	
	public static function destroy($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id
		);

		$viesti = new Viesti($attributes);
		$viesti->destroy();
		Redirect::to('/keskustelu/' . $viesti->keskustelu_id, array('message' => 'Viesti poistettu!'));
    }
  }
