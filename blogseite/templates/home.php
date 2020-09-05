<?php include "templates/include/header.php" ?>

  <!-- Hier wird eine foreach-Schleife ausgefürt und der Inhalt(Titel und Datum) des Arrays($results) ausgegeben. -->
  <div class="row">
    <?php foreach ( $results['articles'] as $article ) { ?>
    <div class="col-sm-6">
      <div class="card my-4">
        <img src="../imgs/blog-img2.gif" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id ?>"><?php echo htmlspecialchars($article->titel) ?></a></h5>
          <!-- Hier wird der String nach Vorgabe formatiert zum Datum -->
          <p class="card-text"><?php echo date('j F, Y ', strtotime($article->publDatum)) ?></p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>


<?php include "templates/include/footer.php" ?>