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
	
	public static function keskustelu(){
		View::make('suunnitelmat/keskustelu.html');
    }
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
  }
