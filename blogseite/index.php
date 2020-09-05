<?php

require('config.php');

session_start();

// "Kontroller" welche Aktion ausgeführt werden soll.

// $_GET['action'] Parameter wird der Variable $action zugewiesen.
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'viewArticle':
    viewArticle();
    break;
  case 'about':
    about();
    break;
  case 'contact':
    contact();
    break; 
  case 'pdfArticle':
    pdfArticle();
    break;
  case 'home':
    homepage();
    break;
  default:
    homepage();
}

function homepage() {
  
  $results = array();

  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  
  $results['articles'] = $data['results'];

  $results['pageTitle'] = "Homepage | Ape Blog";
  require( TEMPLATE_PATH . "/home.php" );
}  


// Diese Funktion zeigt einzelne Artikel auf der Seite. Es wird die Artikel ID von der URL genommen und 
// ruft die Klassen Methode getById() um das passende Artikel-Objekt in die $results Array übergeben.
// Wenn es keine oder falsche ID übergeben wird, wird die Homepage angezeigt.
function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }

  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  
  $results['pageTitle'] = $results['article']->titel . " | Ape Blog";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}


function pdfArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }

  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  
  $results['pageTitle'] = $results['article']->titel . " | Ape Blog";
  require( TEMPLATE_PATH . "/pdfArticle.php");
}

function contact() {
  $results = array();
  $results['pageTitle'] = "Kontakt | Ape Blog";

  require( TEMPLATE_PATH . "/contact.php");
}



function about() {
  $results = array();
  $results['pageTitle'] = "Über Mich | Ape Blog";
  
  require( TEMPLATE_PATH . "/about.php");
}
?>