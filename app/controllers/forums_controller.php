<?php
	class ForumsController extends BaseController{

    public static function index(){
		View::make('aihealueet.html');
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
		View::make('aihealueet.html', array('aihealueet' => $aihealueet));
    }
	
	public static function muokkaus($id){
		$viesti = Viesti::find($id);
		View::make('muokkaus.html', array('viesti' => $viesti));
    }
	
	public static function keskustelumuokkaus($id){
		$keskustelu = Keskustelu::find($id);
		View::make('kmuokkaus.html', array('keskustelu' => $keskustelu));
    }
	
	public static function keskustelut($id){
		$keskustelut = Keskustelu::allFrom($id);
		$aihealue = Aihealue::find($id);
		$luettu=array();
		if(BaseController::get_user_logged_in() != null){
			$user=BaseController::get_user_logged_in();
			$luettu=$user->luettu();
		}
		View::make('keskustelut.html', array('keskustelut' => $keskustelut, 'aihealue' => $aihealue, 'luettu' => $luettu));
    }
	
	public static function keskustelu($id){
		$keskustelu = Keskustelu::find($id);
		$aihealue = Keskustelu::findAihealue($id);
		$viestit = Viesti::allFrom($id);
		$kayttajat = Kayttaja::all();
		View::make('keskustelu.html', array('keskustelu' => $keskustelu,'viestit' => $viestit,'kayttajat' => $kayttajat, 'aihealue' => $aihealue));
    }
	
	public static function login(){
		View::make('login.html');
    }
	
	public static function search(){
		View::make('haku.html');
    }
	
	public static function searchresult(){
		$params = $_POST;
		if(!array_key_exists('hakualue', $params)){
			$keskustelut = Keskustelu::search($params['hakusana']);
		}else{
			$keskustelut = Viesti::search($params['hakusana']);
		}
		$luettu=array();
		if(BaseController::get_user_logged_in() != null){
			$user=BaseController::get_user_logged_in();
			$luettu=$user->luettu();
		}
		View::make('listaus.html', array('keskustelut' => $keskustelut, 'luettu' => $luettu));
    }
  }
