<?php
	require 'app/models/msg.php';
	class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/aihealueet.html');
    }

    public static function sandbox(){
		$msg = Msg::find(1);
		$msgs = Msg::all();
		Kint::dump($msgs);
		Kint::dump($msg);
    }
	
	public static function aihealueet(){
   	  View::make('suunnitelmat/aihealueet.html');
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
