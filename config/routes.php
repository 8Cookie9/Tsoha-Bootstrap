<?php

  $routes->post('/keskustelu/:id/', function($id) {
    ForumsController::aihealueet();
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
  
  $routes->get('/login', function() {
    ForumsController::login();
  });
