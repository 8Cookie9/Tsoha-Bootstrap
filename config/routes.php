<?php

  $routes->post('/keskustelu/:id', function($id){
    ForumsController::storeViesti($id);
  });

$routes->post('/keskustelut/:id', function($id){
    ForumsController::storeKeskustelu($id);
  });  

  $routes->get('/', function() {
    ForumsController::aihealueet();
  });

  $routes->get('/hiekkalaatikko', function() {
    ForumsController::sandbox();
  });
  
  $routes->get('/aihealueet', function() {
    ForumsController::aihealueet();
  });
  
  $routes->get('/keskustelut/:id', function($id) {
    ForumsController::keskustelut($id);
  });
  
  $routes->get('/keskustelu/:id', function($id) {
    ForumsController::keskustelu($id);
  });
  
  $routes->get('/editviesti/:id', function($id) {
    ForumsController::muokkaus($id);
  });
  
  $routes->post('/editviesti/:id', function($id) {
    ForumsController::update($id);
  });
  
  $routes->get('/deleteviesti/:id', function($id) {
    ForumsController::destroy($id);
  });
  
  $routes->get('/deletekeskustelu/:id', function($id) {
    ForumsController::destroyk($id);
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
