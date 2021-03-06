<?php

	function check_logged_in(){
		BaseController::check_logged_in();
	}

	$routes->get('/', function() {
		ForumsController::aihealueet();
	});

	$routes->get('/hiekkalaatikko', function() {
		ForumsController::sandbox();
	});

	$routes->get('/aihealueet', function() {
		ForumsController::aihealueet();
	});
	
	$routes->post('/hae', function(){
		ForumsController::searchresult();
	});
	
	$routes->get('/hae', function(){
		ForumsController::search();
	});

	$routes->get('/keskustelut/:id', function($id) {
		ForumsController::keskustelut($id);
	});

	$routes->get('/keskustelu/:id', function($id) {
		if(BaseController::get_user_logged_in() != null){
			$user=BaseController::get_user_logged_in();
			$user->add_luettu($id);
		}
		ForumsController::keskustelu($id);
	});

	$routes->get('/editviesti/:id', 'check_logged_in', function($id) {
		ForumsController::muokkaus($id);
	});
	
	$routes->get('/editkeskustelu/:id', 'check_logged_in', function($id) {
		ForumsController::keskustelumuokkaus($id);
	});
	
	$routes->post('/editkeskustelu/:id', 'check_logged_in', function($id) {
		KeskusteluController::update($id);
	});

	$routes->post('/editviesti/:id', 'check_logged_in', function($id) {
		ViestiController::update($id);
	});

	$routes->get('/deleteviesti/:id', 'check_logged_in', function($id) {
		ViestiController::destroy($id);
	});

	$routes->get('/deletekeskustelu/:id', 'check_logged_in', function($id) {
		KeskusteluController::destroy($id);
	});

	$routes->get('/deleteaihealue/:id', 'check_logged_in', function($id) {
		AihealueController::destroy($id);
	});
	
	$routes->post('/logout', function(){
		UserController::logout();
	});

	$routes->post('/keskustelu/:id', 'check_logged_in', function($id){
		ViestiController::store($id);
	});

	$routes->post('/keskustelut/:id', 'check_logged_in', function($id){
		KeskusteluController::store($id);
	});

	$routes->post('/', 'check_logged_in', function(){
		AihealueController::store();
	});

	$routes->post('/aihealueet', 'check_logged_in', function(){
		AihealueController::store();
	});

	
	$routes->get('/login', function() {
		ForumsController::login();
	});

	$routes->get('/login', function(){
		UserController::login();
	});

	$routes->post('/login', function(){
		UserController::handle_login();
	});
