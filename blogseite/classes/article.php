<?php

/* Class für BlogArtikel */
class Article
{
    // Eigenschaften:
    // BlogArtikel Id(int)
    public $id = null;

    // Wann der Artikel geschrieben wurde
    public $publDatum = null;

    // Titel vom Artikel(string)
    public $titel = null;

    // Inhalt vom Artikel
    public $inhalt = null;


    // Konstrunktor zum Erzeugen von Artikel Objekt
    // Die Array Felder werden dann als Werte den Attributen(Eigenschaften) zugewiesen 
    public function __construct($data = array())
    {
        if (isset($data['id'])) $this->id = (int) $data['id'];
        if (isset($data['publdatum'])) $this->publDatum = (string) $data['publdatum'];
        if (isset($data['titel'])) $this->titel = (string) $data['titel'];
        if (isset($data['inhalt'])) $this->inhalt = (string) $data['inhalt'];
    }

    

    // Diese Funktion übernimmt die übergebene Form-Werte und ruft den Konstruktor auf. 

    public function storeFormValues ( $params ) {

        // Alle Werte werden "gespeichert".
        $this->__construct( $params );

    }


    
    // Diese Funktion bekommt eine int-Zahl, die dann mit den Artikeln in der Datenbank verglichen wird
    // und wenn es ein passender Artikel gefunden wurde, wird ein Artikel Objekt erzeugt mit den Werten aus der Datenbank

    public static function getById( $id ) {

        $conn = new PDO( DB_DSN );
        $sql = "SELECT * FROM artikel WHERE id = '{$id}' ";
        $st = $conn->query( $sql );

        $row = $st->fetch();
        $conn = null;

        if ( $row ) return new Article( $row );        
    }


    
    // Git alle bzw. nur die angegebene Anzahl an Artikel Objekten aus der Datenbank zurück

    public static function getList( $numRows=1000000 ) {
        $conn = new PDO( DB_DSN );
        $sql = "SELECT * FROM artikel
                ORDER BY publdatum DESC LIMIT '{$numRows}'";

        $st = $conn->query( $sql );
        
        $list = array();

        while ( $row = $st->fetch() ) {
        $article = new Article( $row );
        $list[] = $article;
        }

        
        // Hier werden die komplette Anzahl an gespeicherten Artikel in der Datebank berechnet

        $sql = "SELECT COUNT(*) AS totalRows FROM artikel";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }



    // Ein Artikel Objekt wird auf der Datenbank gespeichert.
    
    public function insert() {   

        $conn = new PDO( DB_DSN );
        $sql = "INSERT INTO artikel ( publdatum, titel, inhalt ) VALUES ( :publdatum, :titel, :inhalt )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":publdatum", $this->publDatum, PDO::PARAM_STR );
        $st->bindValue( ":titel", $this->titel, PDO::PARAM_STR );
        $st->bindValue( ":inhalt", $this->inhalt, PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }


    
    // Ein bestehender Artikel wird in der Datenbank aktualisiert

    public function update() {

        $conn = new PDO( DB_DSN );
        $sql = "UPDATE artikel SET publdatum=:publdatum, titel=:titel, inhalt=:inhalt WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":publdatum", $this->publDatum, PDO::PARAM_STR );
        $st->bindValue( ":titel", $this->titel, PDO::PARAM_STR );
        $st->bindValue( ":inhalt", $this->inhalt, PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }


    
    // Aktueller Artikel Objekt wird von der Datenbank gelöscht

    public function delete() {

        $conn = new PDO( DB_DSN );
        $st = $conn->prepare ( "DELETE FROM artikel WHERE id = :id" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }
}
?>