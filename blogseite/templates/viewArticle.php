<?php include "templates/include/header.php" ?>

<!-- Hier wird der komplette Artikel angezeigt -->
<h2 class="pt-5"><?php echo htmlspecialchars($results['article']->titel) ?></h1>
<p><em>Geschrieben am <?php echo date('j F, Y ', strtotime($results['article']->publDatum)) ?></em></p>

<div class="pb-5"><?php echo $results['article']->inhalt ?></div>

<!-- Mit a-Tag wird weiter zu der erzeugten PDF-Datei geleitet -->
<a class="btn btn-info" target="_blank" href=".?action=pdfArticle&amp;articleId=<?php echo $results['article']->id ?>"><?php echo htmlspecialchars($article->titel) ?>Mach mich zu PDF</a>

<?php include "templates/include/footer.php" ?>