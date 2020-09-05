<?php include "templates/include/header.php" ?>

      
<div>
    <h2 class="text-center m-5">Admin Bereich</h2>
</div>

<form class="form-group" action="admin.php?action=<?php echo $results['formAction']?>" method="post">
    <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>

    <?php if ( isset( $results['errorMessage'] ) ) { ?>
    <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
    <?php } ?>


    <div class="form-row">
    
        <div class="form-group col-6">
    
            <label for="title">Artikel Titel:</label>
            <input class="form-control" type="text" name="titel" id="title" placeholder="Hier kommt der Titel" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->titel )?>" />
        </div>

        <div class="form-group col">    

            <label for="publicationDate">Datum(YYYY-MM-DD):</label>
            <input class="form-control" type="text" name="publdatum" id="publicationDate" placeholder="Datum" required maxlength="10" value="<?php echo htmlspecialchars( $results['article']->publDatum )?>" />
         
        </div>
    </div>

    <div class="form-group">
            <label for="content">Artikel Inhalt:</label>
            <textarea class="form-control" name="inhalt" id="content" placeholder="Hier kommt der Inhalt vom Artikel" required maxlength="100000"><?php echo htmlspecialchars( $results['article']->inhalt )?></textarea>    
    </div>

    <div class="buttons">
            <input class="btn btn-info" type="submit" name="saveChanges" value="Speichern" />
            <input class="btn btn-info" type="submit" formnovalidate name="cancel" value="Abbrechen" />
    </div>

</form>

    <?php if ( $results['article']->id ) { ?>
    <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" class="btn btn-danger" onclick="return confirm('Wirklich löschen?')">Diesen Artikel löschen</a></p>
    <?php } ?>

<?php include "templates/include/footer.php" ?>