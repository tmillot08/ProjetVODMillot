<?php
  session_start();
  require("php/GestionnaireChemin.php");
  GC::load();
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <header>
      <?php include 'php/nav.html'; ?>
    </header>
    <main class="inscription">
      <div class="cadre">
        <form class="formu" action="traitementInscription.php" method="post">
          <h1>S'inscrire</h1>
          <input type="mail" name="email" value="" placeholder="Votre adresse Mail">
          <input type="text" name="pseudo" value="" placeholder="Votre Pseudo">
          <input type="password" name="password" value="" placeholder="Votre Mot de passe">
          <input type="password" name="Cpassword" value="" placeholder="Confirmez Mot de passe">
          <div class="checkbox">
          <input type="checkbox" id="check" name="check" value="">
          <label for="check"> J'accepte les conditions d'utilisation </label>
          </div>
          <a href="connexion.php">Déja membre ? connectez-vous</a>
          <div class="center">
          <input type="submit" name="submit" value="je m'inscris">
          </div>
          <p> <?php echo $_SESSION["msgins"];?></p>


        </form>
      </div>

    </main>
      <?php  include 'php/footer.html'; ?>
  </body>
</html>
