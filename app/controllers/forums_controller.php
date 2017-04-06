<?php
	class ForumsController extends BaseController{

    public static function index(){
   	  View::make('suunnitelmat/aihealueet.html');
    }

    public static function sandbox(){
		$msg = Viesti::find(1);
		$msgs = Viesti::all();
		$aihealueet = Aihealue::all();
		Kint::dump($msgs);
		Kint::dump($msg);
		Kint::dump($aihealueet);
    }
	
	public static function aihealueet(){
		$aihealueet = Aihealue::all();
		View::make('suunnitelmat/aihealueet.html', array('aihealueet' => $aihealueet));
    }
	
	public static function muokkaus($id){
		$viesti = Viesti::find($id);
		View::make('suunnitelmat/muokkaus.html', array('viesti' => $viesti));
    }
	
	public static function keskustelut($id){
		$keskustelut = Keskustelu::allFrom($id);
		$aihealue = Aihealue::find($id);
		View::make('suunnitelmat/keskustelut.html', array('keskustelut' => $keskustelut, 'aihealue' => $aihealue));
    }
	
	public static function keskustelu($id){
		$keskustelu = Keskustelu::find($id);
		$viestit = Viesti::allFrom($id);
		$kayttajat = Kayttaja::all();
		View::make('suunnitelmat/keskustelu.html', array('keskustelu' => $keskustelu,'viestit' => $viestit,'kayttajat' => $kayttajat));
    }
	
	public static function storeViesti($id){
		$params = $_POST;
		$viesti = new Viesti(array(
		  'keskustelu_id' => $id,
		  'kayttaja_id' => self::get_user_logged_in()->id,
		  'sisalto' => $params['content']
		));
		
		$errors = $viesti->validate_sisalto();
		if(count($errors) > 0){
		  Redirect::to('/keskustelu/' . $id, array('error' => 'Viesti on liian lyhyt!'));
		}
		
		$viesti->save();
		Redirect::to('/keskustelu/' . $id, array('message' => 'Viesti lähetetty!'));
	}
	
	public static function storeKeskustelu($id){
		$params = $_POST;
		$keskustelu = new Keskustelu(array(
		  'aihealue_id' => $id,
		  'kayttaja_id' => self::get_user_logged_in()->id,
		  'otsikko' => $params['otsikko']
		));
		
		$errors = $keskustelu->validate_otsikko();
		if(count($errors) > 0){
		  Redirect::to('/keskustelut/' . $id, array('error' => $errors[0]));
		}
		
		$keskustelu->save();
		
		$viesti = new Viesti(array(
		  'keskustelu_id' => $keskustelu->id,
		  'kayttaja_id' => self::get_user_logged_in()->id,
		  'sisalto' => $params['content']
		));
		
		$errors = $viesti->validate_sisalto();
		if(count($errors) > 0){
		  self::destroyk($keskustelu->id);
		  Redirect::to('/keskustelut/' . $id, array('error' => $errors[0]));
		}
		
		$viesti->save();
		
		Redirect::to('/keskustelu/' . $keskustelu->id);
	}
	
	public static function storeAihealue(){
		$params = $_POST;
		$aihealue = new Aihealue(array(
		  'nimi' => $params['nimi'],
		));
		
		$errors = $aihealue->validate_nimi();
		if(count($errors) > 0){
		  Redirect::to('/', array('error' => 'Nimi on liian lyhyt!'));
		}
		
		$aihealue->save();
		Redirect::to('/keskustelut/' . $aihealue->id, array('message' => 'Aihealue lisätty!'));
	}
	
	public static function update($id){
		$params = $_POST;

		$attributes = array(
		  'id' => $id,
		  'sisalto' => $params['content']
		);

		$viesti = new Viesti($attributes);
		
		$errors = $viesti->validate_sisalto();
		if(count($errors) > 0){
		  Redirect::to('/editviesti/' . $viesti->id, array('error' => $errors[0]));
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
	
	public static function destroyk($id){
		$params = $_POST;

		 $attributes = array(
		  'id' => $id
		);

		$keskustelu = new Keskustelu($attributes);
		$keskustelu->destroy();
		Redirect::to('/keskustelut/' . $keskustelu->aihealue_id, array('message' => 'Keskustelu poistettu!'));
    }
	
	public static function destroya($id){
		$params = $_POST;

		 $attributes = array(
		  'id' => $id
		);

		$aihealue = new Keskustelu($attributes);
		$aihealue->destroy();
		Redirect::to('/' , array('message' => 'Aihealue poistettu!'));
    }
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
  }
