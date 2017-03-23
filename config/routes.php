<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/aihealueet', function() {
    HelloWorldController::aihealueet();
  });
  
  $routes->get('/keskustelut', function() {
    HelloWorldController::keskustelut();
  });
  
  
  $routes->get('/keskustelu', function() {
    HelloWorldController::keskustelu();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
