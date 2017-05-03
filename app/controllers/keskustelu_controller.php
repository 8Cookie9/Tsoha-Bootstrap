<?php
	class KeskusteluController extends BaseController{
	
	public static function store($id){
		$params = $_POST;
		$keskustelu = new Keskustelu(array(
			'aihealue_id' => $id,
			'kayttaja_id' => self::get_user_logged_in()->id,
			'otsikko' => $params['otsikko']
		));
		
		$errors = $keskustelu->errors();
		if(count($errors) > 0){
			Redirect::to('/keskustelut/' . $id, array('errors' => $errors, 'otsikko' => $params['otsikko']));
		}
		
		$keskustelu->save();
		
		$viesti = new Viesti(array(
			'keskustelu_id' => $keskustelu->id,
			'kayttaja_id' => self::get_user_logged_in()->id,
			'sisalto' => $params['content']
		));
		
		$errors = array_merge($errors, $viesti->errors());
		if(count($errors) > 0){
			$keskustelu->destroy();
			Redirect::to('/keskustelut/' . $id, array('errors' => $errors, 'content' => $params['content'], 'otsikko' => $params['otsikko']));
		}
		
		$viesti->save();
		
		Redirect::to('/keskustelu/' . $keskustelu->id);
	}
	
	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'otsikko' => $params['otsikko'],
		);

		$keskustelu = new Keskustelu($attributes);
		
		$errors = $keskustelu->errors();
		if(count($errors) > 0){
			Redirect::to('/editkeskustelu/' . $keskustelu->id, array('errors' => $errors, 'otsikko' => $params['otsikko']));
		}
		$keskustelu->update();
		Redirect::to('/', array('message' => 'Keskustelua muokattu!'));
    }

	public static function destroy($id){
		$attributes = array(
			'id' => $id
		);

		$keskustelu = new Keskustelu($attributes);
		$keskustelu->destroy();
		Redirect::to('/keskustelut/' . $keskustelu->aihealue_id, array('message' => 'Keskustelu poistettu!'));
    }
  }
