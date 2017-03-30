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
	
	public static function store(){
		$params = $_POST;
		$viesti = new Viesti(array(
		  'keskustelu_id' => 1,
		  'kayttaja_id' => 1,
		  'sisalto' => $params['content']
		));
		
		Kint::dump($params);
		
		$viesti->save();
		//Redirect::to('/keskustelu/1', array('message' => 'Viesti lähetetty!'));
	}
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
  }
