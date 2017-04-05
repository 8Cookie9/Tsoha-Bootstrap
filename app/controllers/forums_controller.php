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
		View::make('suunnitelmat/muokkaus.html');
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
		
		$errors = $keskustelu->validate_otsikko();
		if(count($errors) > 0){
		  echo 'Otsikko on liian lyhyt!';
		}
		
		$keskustelu->save();
		
		$viesti = new Viesti(array(
		  'keskustelu_id' => $keskustelu->id,
		  'kayttaja_id' => 1,
		  'sisalto' => $params['content']
		));
		
		$errors = $viesti->validate_otsikko();
		if(count($errors) > 0){
		  echo 'Viesti on liian lyhyt!';
		}
		
		$viesti->save();
		
		Redirect::to('/keskustelu/' . $keskustelu->id);
	}
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
  }
