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
		$luettu=array();
		if(BaseController::check_logged_in()){
			$user=BaseController::get_user_logged_in();
			$luettu=$user->luettu();
		}
		View::make('suunnitelmat/keskustelut.html', array('keskustelut' => $keskustelut, 'aihealue' => $aihealue, 'luettu' => $luettu));
    }
	
	public static function keskustelu($id){
		$keskustelu = Keskustelu::find($id);
		$viestit = Viesti::allFrom($id);
		$kayttajat = Kayttaja::all();
		View::make('suunnitelmat/keskustelu.html', array('keskustelu' => $keskustelu,'viestit' => $viestit,'kayttajat' => $kayttajat));
    }
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
	
	public static function search(){
		View::make('suunnitelmat/haku.html');
    }
	
	public static function searchresult(){
		$params = $_POST;
		$keskustelut = Keskustelu::search($params['hakusana']);
		$luettu=array();
		if(BaseController::check_logged_in()){
			$user=BaseController::get_user_logged_in();
			$luettu=$user->luettu();
		}
		View::make('suunnitelmat/listaus.html', array('keskustelut' => $keskustelut, 'luettu' => $luettu));
    }
  }
