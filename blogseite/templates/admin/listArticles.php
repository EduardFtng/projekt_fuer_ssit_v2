<?php include "templates/include/header.php" ?>

  <div>
        <h2 class="text-center mt-5">Admin Bereich</h2>
  </div>

  <h3 class="mt-5">Artikel Liste:</h3>

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="alert alert-danger"><?php echo $results['errorMessage'] ?></div>
<?php } ?>


<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="alert alert-success"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
    
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Erscheinungsdatum</th>
          <th scope="col">Artikel</th>
        </tr>
      </thead>
      <tbody>
      
      <?php foreach ( $results['articles'] as $article ) { ?>
        <tr onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>'">
          <td><?php echo date('j F, Y ', strtotime($article->publDatum)) ?></td>
          <td>
            <?php echo $article->titel?>
          </td>
        </tr>
      <?php } ?>
      
      </tbody>
    </table>
  </div>
      
  <br>
  <p>Gesamtanzahl der Artikel: <?php echo $results['totalRows']?> </p>

  <p><a href="admin.php?action=newArticle" class="btn btn-info">Neuen Artikel Hinzufügen</a></p>

<?php include "templates/include/footer.php" ?>
