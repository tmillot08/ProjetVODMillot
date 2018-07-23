<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MetroVod</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <header>
      <?php include 'php/navaccueil.html'; ?>
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
        <a href="connexion.php">
         <button type="button" name="button"> Déja Membre?  <br> Connectez-vous  </button>
        </a>
          <h3> ─ ou ─</h3>
        <a href="inscription.php">
          <button type="button" name="button"> Créez un compte  </button>
        </a>
        </div>

      </div>
		   <div class="content-carrousel">
                   <?php
                   $host_name = 'db745063132.db.1and1.com';
                   $database = 'db745063132';
                   $user_name = 'dbo745063132';
                   $password = ')Thomas016';

                   $dbh = null;
                   try {
                     $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
                     $carro = $dbh->query("SELECT * FROM Film ORDER BY Date_Film DESC LIMIT 3 ");
                     while ($carroimg = $carro->fetch()) {?>
                        <div class="img">
                          <img src="upload/<?php echo $carroimg['Img_Film'] ?>"/>
                        </div>
                      <?php
                     }
                      } catch (PDOException $e) {
                     echo "Erreur!: " . $e->getMessage() . "<br/>";
                     die();
                      }

                     ?>
		             </div>
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
      <?php
        if(isset($_POST['mailsend'])){
          $from = $_POST['Mail'];
          $to = "thomas.millot08@gmail.com";
          $subject = "Demande de" . $_POST['Prenom'] . "" . $_POST['Nom'];
          $message = $_POST['Msg'];
          $headers = "From:"  . $from;

          mail($to,$subject, $message, $headers);
          echo "Votre Email a bien été envoyé.";

        } else { ?>
      <form class="contact" action="" method="post">
        <h1>Nous contactez</h1>
        <div class="row">
          <input type="text" name="Nom" value="" placeholder="Votre Nom">
          <input type="text" name="Prenom" value="" placeholder="Votre Prenom">
        </div>
        <div class="row">
          <input type="mail" name="Mail" value="" placeholder="Adresse mail">
          <input type="tel" name="Tel" value="" placeholder="numero de telephone">
        </div>
        <div class="row">
          <textarea name="Msg" placeholder="Votre message ici..." rows="4" cols="70"></textarea>
        </div>
          <input type="submit" name="mailsend" value="Envoyer">

      </form>
      <?php
    }

     ?>

    </section>
    </main>
    <footer>
      <?php  include 'php/footer.html'; ?>
    </footer>
  </body>
</html>
