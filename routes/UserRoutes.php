<?php

use Steampixel\Route;

Route::add('/', function() {
  if(isset($_SESSION['access_token'])) {
    PredmetyController::view("Predmety", "eval", array());
  } else {
     require_once 'views/LandingPage.php';
  }
});

Route::add('/p/([a-zA-Z]*)', function($predmet) {
  new OtazkyController($predmet); 
});

Route::add('/unauthorized', function() {
  Controller::viewStatic('UnauthorizedUser', "Nepovoleno!");
});

Route::add('/auth/google', function() {
  $AuthController = new OAuthController();
  $AuthController->redirectUserToAuth();
});

Route::add('/auth/callback', function() {
  $AuthController = new OAuthController();
  $AuthController->authUserFromRedirect();
});

Route::add('/auth/google/logout', function() {
  $AuthController = new OAuthController();
  $AuthController->logout();
});