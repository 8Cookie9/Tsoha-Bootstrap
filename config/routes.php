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
  
  $routes->get('/login', function() {
    ForumsController::login();
  });
