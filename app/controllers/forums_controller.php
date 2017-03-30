<?php
	class ForumsController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/aihealueet.html');
    }

    public static function sandbox(){
		$Viesti = Viesti::find(1);
		$Viestis = Viesti::all();
		Kint::dump($Viestis);
		Kint::dump($Viesti);
    }
	
	public static function aihealueet(){
		$aihealueet = Aihealueet::all();
		View::make('suunnitelmat/aihealueet.html', array('aihealueet' => $aihealueet));
    }
	
	public static function keskustelut(){
		View::make('suunnitelmat/keskustelut.html');
    }
	
	public static function keskustelu(){
		View::make('suunnitelmat/keskustelu.html');
    }
	
	public static function login(){
		View::make('suunnitelmat/login.html');
    }
  }
