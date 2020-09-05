
</div>
<hr>

<footer>

<div class="text-center">

<!-- Hier wird überprüft ob die Session "aktiv" (nicht null) ist. Wenn aktiv, dann wird der Username mit Ausloggen funktion angezeigt -->
<!-- Ansonsten sieht man nur die weiterleitung zum "Adminbereich" wo man sich anmelden kann. -->
<?php if ( isset( $_SESSION['username'] ) ) { ?>
  <p>Ape Blog &copy; 2020 </p>
  <p>Eingeloggt als <a href="admin.php" class="text-dark"><b><?php echo htmlspecialchars( $_SESSION['username']) ?></b></a>. <a href="admin.php?action=logout"?>Ausloggen</a></p>
<?php } else { ?>
  <p>Ape Blog &copy; 2020 <a class="ml-5" href="./admin.php">Admin Bereich</a></p>
<?php } ?>

</div>

</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.js"></script>

</body>

</html>