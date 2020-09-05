<?php
      require_once('TCPDF/tcpdf.php');
      // Hier wurde TCPDF-lib statt fpdf-lib benutzt

      // Hier wird der neue PDF-Objekt erzeugt
      $pdf = new TCPDF();

      // Der Inhalt aus dem aktuell ausgewählten Artikel-Objekt wird in die Variable $html schrieben.
      $html = "<h2>".htmlspecialchars($results['article']->titel)."</h1>";
      $html .= "<p><em>Geschrieben am ".date('j F, Y ', strtotime($results['article']->publDatum))."</em></p>";
      $html .= "<p>".$results['article']->inhalt."</p>";
        
      // Der Dateiname wird vom Artikeltitel übernommen
      $datei = $results['article']->titel;
        
      // Titel wird aus dem ausgewählten Artikel-Objekt übernommen
      $pdf->SetTitle($results['pageTitle']);

      $pdf->AddPage();
      $pdf->writeHTML($html);
      $pdf->Output($datei, 'I');
          
?> 