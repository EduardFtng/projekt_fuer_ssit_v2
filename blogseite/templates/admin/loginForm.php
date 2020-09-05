<?php include "templates/include/header.php" ?>

    <form class="form-signin" action="admin.php?action=login" method="post"> 
        <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="alert alert-danger"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>

        <h1 class="h3 mb-3 font-weight-normal">Hier einloggen:</h1>
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Admin Username" required autofocus/>
        
        <label for="password" class="sr-only">Passwort</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Admin Passwort" required/>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
    </form>

<?php include "templates/include/footer.php" ?>