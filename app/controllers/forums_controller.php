<?php
	class ForumsController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
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
		  'kayttaja_id' => 1,
		  'sisalto' => $params['content']
		));
		
		$errors = $viesti->validate_sisalto();
		if(count($errors) > 0){
		  echo 'Viesti on liian lyhyt!';
		  return;
		}
		
		$viesti->save();
		Redirect::to('/keskustelu/' . $id, array('message' => 'Viesti lähetetty!'));
	}
	
	public static function storeKeskustelu($id){
		$params = $_POST;
		$keskustelu = new Keskustelu(array(
		  'aihealue_id' => $id,
		  'kayttaja_id' => 1,
		  'otsikko' => $params['otsikko']
		));
		
		$viesti = new Viesti(array(
		  'keskustelu_id' => $keskustelu->id,
		  'kayttaja_id' => 1,
		  'sisalto' => $params['content']
		));
		
		$errors = $keskustelu->validate_otsikko();
		if(count($errors) > 0){
		  echo 'Otsikko on liian lyhyt!';
		  return;
		}
		
		$errors = $viesti->validate_sisalto();
		if(count($errors) > 0){
		  echo 'Viesti on liian lyhyt!';
		  return;
		}
		
		$keskustelu->save();
		
		$viesti->save();
		
		Redirect::to('/keskustelu/' . $keskustelu->id);
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
		  echo 'Viesti on liian lyhyt!';
		  return;
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
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
  }
