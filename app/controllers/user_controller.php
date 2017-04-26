<?php
	class UserController extends BaseController{

    public static function login(){
		View::make('suunnitelmat/login.html');
	}
	
	public static function handle_login(){
		$params = $_POST;

		$user = Kayttaja::authenticate($params['username'], $params['password']);

		if(!$user){
		  View::make('suunnitelmat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
		}else{
		  $_SESSION['user'] = $user->id;

		  Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
		}
	}
	
	public static function logout(){
		$_SESSION['user'] = null;
		Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
	}
  }
