<?php
	class AihealueController extends BaseController{
	
	public static function store(){
		$params = $_POST;
		$aihealue = new Aihealue(array(
			'nimi' => $params['nimi'],
		));
		
		$errors = $aihealue->errors();
		if(count($errors) > 0){
			Redirect::to('/', array('errors' => $errors, 'nimi' => $params['nimi']));
		}
		
		$aihealue->save();
		Redirect::to('/keskustelut/' . $aihealue->id, array('message' => 'Aihealue lisätty!'));
	}
	
	public static function destroy($id){
		$attributes = array(
			'id' => $id
		);

		$aihealue = new Aihealue($attributes);
		$aihealue->destroy();
		Redirect::to('/' , array('message' => 'Aihealue poistettu!'));
    }
  }
