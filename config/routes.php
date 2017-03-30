<?php

  $routes->get('/', function() {
    ForumsController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    ForumsController::sandbox();
  });
  
  $routes->get('/aihealueet', function() {
    ForumsController::aihealueet();
  });
  
  $routes->get('/keskustelut', function() {
    ForumsController::keskustelut();
  });
  
  
  $routes->get('/keskustelu', function() {
    ForumsController::keskustelu();
  });
  
  $routes->get('/login', function() {
    ForumsController::login();
  });
