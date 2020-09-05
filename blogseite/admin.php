<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

// Hier wird abgefragt ob der User eingeloggt ist, wenn der die Variable $username leer ist oder der User sich ausloggt,
// wird man zur Login Seite weitergeleitet
if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}

// "Kontroller" welche Aktion ausgeführt werden soll.
switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  default:
    listArticles();
}


// Diese Funktion wird aufgerufen, wenn der User versucht sich einzuloggen.
function login() {

  $results = array();
  $results['pageTitle'] = "Admin Login | Ape Blog";

  if ( isset( $_POST['login'] ) ) {

    // User hat was in die Login Form eingegeben, und die Eingabe wird überprüft
    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

      // Wenn der Login erfolgreich ist, wird eine Session erstellt und man wird zum Adminbereich weitergeleitet
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );

    } else {

      // Wenn der Login fehlgeschlagen ist, wird eine Fehlermeldung angezeigt.
      $results['errorMessage'] = "Falscher Username oder Passwort. Versuch noch mal.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

  } else {

    // Ansonten wird die Loginform angezeigt.
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }

}


// Diese Funktion wird aufgerufen, wenn der User auf "Ausloggen" klickt.
// Der Username Wert wird aus der Session entfernt.
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}


// Diese Funktion erlaubt dem User einen neuen Artikel zu erstellen.
function newArticle() {

  $results = array();
  $results['pageTitle'] = "Neuer Artikel | Ape Blog";
  $results['formAction'] = "newArticle";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User hat die Form ausgefüllt und auf Speicher gedrückt, so werden die Eingaben abgespeichert, 
    // und mit der Funktion insert() auf die Datenbank geschrieben.
    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert();
    header( "Location: admin.php?status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Wenn der User auf "Abbrechen" clickt, wird zurück zur Liste geleitet.
    header( "Location: admin.php" );
  } else {

    // User bekommt eine leere Form angezeigt.
    $results['article'] = new Article;
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }

}


function editArticle() {

  $results = array();
  $results['pageTitle'] = "Artikel Bearbteiten | Ape Blog";
  $results['formAction'] = "editArticle";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User hat etwas am Artikel verändert und auf "Speicher" geklickt, 
    // werden die neuen Werte in die Datenbank geschrieben.
    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }

    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User hat auf "Abbrechen" geklickt, dann wird er zurück zur Liste geleitet.
    header( "Location: admin.php" );
  } else {

    // Dem User wird die HTML-Form mit den Artikel Inhalt angezeigt
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }

} 


// Diese Funktion wird aufgerufen, wenn der User beim Ausgewähltem Artikel auf "Diesen Artikel löschen" klickt.
function deleteArticle() {

  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }

  $article->delete();
  header( "Location: admin.php?status=articleDeleted" );
}


// Diese Funktion, gibt alle Artikel aus der Datenbank aus, außerdem werden Status- und Fehlermeldungen hinterlegt 
// um sie bei gebrauch, auszugeben.
function listArticles() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  
  $results['pageTitle'] = "Alle Artikel | Ape Blog";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Aritkel wurde nicht gefunden.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Die Änderungen wurden abgespeichert.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Artikel wurde gelöscht.";
  }

  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

?>