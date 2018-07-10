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
      <?php include 'navaccueil.html'; ?>
    </header>
    <main class="accueil">
    <section class="interface">
      <div class="description">
        <h1>Le cinema se déplace jusqu'à vous</h1>
        <h3 id="txt">Accès à tous les films du grands écran trois mois après la sortie de celui-ci. <br>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec leo metus.  <br>
          Etiam bibendum consequat magna eget imperdiet. Mauris interdum, dui non <br>
          sollicitudin iaculis, risus risus maximus mi, nec cursus ex tortor vitae sapien.
        </h3>
        <div class="button">
        <a href="inscription.php">
         <button type="button" name="button"> Déja Membre?  <br> Connectez-vous  </button>
        </a>
          <h3> ─ ou ─</h3>
        <a href="connexion.php">
          <button type="button" name="button"> Créez un compte  </button>
        </a>
        </div>

      </div>
    </section>
    <section class="icono">
      <div class="ico">
        <i class="fas fa-film fa-8x"></i>
        <h3>Un grand choix de film</h3>

      </div>
      <div class="ico">
        <i class="fas fa-envelope fa-8x"></i>
        <h3> vous avez besoin d'aide <br> Contactez nous</h3>
      </div>
      <div class="ico">
        <i class="fab fa-creative-commons-nc-eu fa-8x"></i>
        <h3> Louez des films <br> à petit prix</h3>

      </div>
    </section>
    <section class="help">

      <form class="contact" action="index.html" method="post">
        <h1>Nous contactez</h1>
        <div class="row">
          <input type="text" name="" value="" placeholder="Votre Nom">
          <input type="text" name="" value="" placeholder="Votre Prenom">
        </div>
        <div class="row">
          <input type="mail" name="" value="" placeholder="Adresse mail">
          <input type="tel" name="" value="" placeholder="numero de telephone">
        </div>

      </form>

    </section>
    </main>
    <footer>
      <?php  include 'footer.html'; ?>
    </footer>
  </body>
</html>
