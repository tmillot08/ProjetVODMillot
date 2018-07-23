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
    <main class="detail">
    <section class="information">
      <?php
      $host_name = 'db745063132.db.1and1.com';
      $database = 'db745063132';
      $user_name = 'dbo745063132';
      $password = ')Thomas016';

      $dbh = null;
      try {
        $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
        $film = $dbh->query("SELECT *
          FROM Film

          INNER JOIN Realise ON Film.ID_Film = Realise.ID_Film
          INNER JOIN relation11 ON Film.ID_Film = relation11.ID_Film
          INNER JOIN Appartient ON Film.ID_Film = Appartient.ID_Film
          INNER JOIN Acteur ON relation11.ID_Acteur = Acteur.ID_Acteur
          INNER JOIN Realisateur ON Realise.ID_Real = Realisateur.ID_Real
          INNER JOIN Genre ON Appartient.ID_Genre = Genre.ID_Genre WHERE Film.ID_Film = '" . $_POST['id'] . "' ");
          $detailfilm = $film->fetch();
         ?>
      <h1 class="title"> <?php  echo $detailfilm['Titre_Film']; ?></h1>
      <div class="info">
        <div class="img">
          <img src="upload/<?php echo $detailfilm['Img_Film']; ?>" alt="">
        </div>
        <div class="infor">
          <h3>Date de sortie: <?php echo $detailfilm['Date_Film']; ?></h3>
          <h3>Réaliser par <?php echo $detailfilm['Nom_Real']; ?></h3>
          <h3>Genres: <?php echo $detailfilm['Nom_Genre']; ?></h3>
          <h3>Acteurs: <?php echo $detailfilm['Nom_Acteur']; ?>, Olivia Cooke, Ben Mendelson</h3>
          <h3>Langue: Français/anglais</h3>
        </div>
      </div>
    </section>
    <section class="syno">
      <div class="Synop">
        <h1>Synopsis:</h1>
      </div>
      <div class="txtSyno">
        <h3><?php echo $detailfilm['Syno_Film']; ?></h3>

      </div>
    </section>
    <section class="bande">
      <h1>Bande annonce</h1>
      <video src="./vid/<?php echo $detailfilm['Ba_Film']; ?>" controls></video>



    </section>
    <?php
  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }

     ?>

    </main>
    <footer>
      <?php  include 'footer.html'; ?>
    </footer>
  </body>
</html>
