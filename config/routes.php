<?php
	
	function check_logged_in(){
		BaseController::check_logged_in();
	}

  $routes->post('/keskustelu/:id', 'check_logged_in', function($id){
    ForumsController::storeViesti($id);
  });

  $routes->post('/keskustelut/:id', 'check_logged_in', function($id){
    ForumsController::storeKeskustelu($id);
  });

  $routes->post('/', 'check_logged_in', function(){
    ForumsController::storeAihealue();
  });
  
  $routes->post('/aihealueet', 'check_logged_in', function(){
    ForumsController::storeAihealue();
  });

  $routes->get('/', 'check_logged_in', function() {
    ForumsController::aihealueet();
  });

  $routes->get('/hiekkalaatikko', function() {
    ForumsController::sandbox();
  });
  
  $routes->get('/aihealueet', 'check_logged_in', function() {
    ForumsController::aihealueet();
  });
  
  $routes->get('/keskustelut/:id', 'check_logged_in', function($id) {
    ForumsController::keskustelut($id);
  });
  
  $routes->get('/keskustelu/:id', 'check_logged_in', function($id) {
    ForumsController::keskustelu($id);
  });
  
  $routes->get('/editviesti/:id', 'check_logged_in', function($id) {
    ForumsController::muokkaus($id);
  });
  
  $routes->post('/editviesti/:id', 'check_logged_in', function($id) {
    ForumsController::update($id);
  });
  
  $routes->get('/deleteviesti/:id', 'check_logged_in', function($id) {
    ForumsController::destroy($id);
  });
  
  $routes->get('/deletekeskustelu/:id', 'check_logged_in', function($id) {
    ForumsController::destroyk($id);
  });
  
  $routes->get('/deleteaihealue/:id', 'check_logged_in', function($id) {
    ForumsController::destroya($id);
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
