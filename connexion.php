<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <header>
      <?php include 'nav.html'; ?>
    </header>
    <main class="connexion">
      <div class="cadre">
        <form class="formu" action="" method="post">
          <h1>Connexion</h1>
          <input type="mail" name="email" value="" placeholder="Adresse Mail">
          <input type="password" name="password" value="" placeholder="Mot de passe">
          <div class="checkbox">
          <input type="checkbox" id="check" name="check" value="">
          <label for="check"> Se souvenir de moi </label>
          </div>
          <a href="inscription.php">Pas de compte ? S'inscrire</a>
          <div class="center">
          <input type="submit" name="submit" value="Se connecter">
          </div>


        </form>
      </div>

    </main>
    <footer>
      <?php  include 'footer.html'; ?>
    </footer>
  </body>
</html>
