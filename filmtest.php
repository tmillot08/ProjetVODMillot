<?php

/*require("php/GestionnaireChemin.php");
GC::load();
if($_SESSION["connect"]  != 1){
  header("Location:connexion.php");
}
if(!GC::fromTo("connexion.php")){
  echo "Bienvenue " . $_SESSION["pseudo"] . "<br>";
  echo $_SESSION["GC_lastURI"];
}*/

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Film</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

  </head>
  <body>
    <header>
      <?php include 'php/navfilm.php'; ?>
    </header>

    <main class="film" id="txtHint">

      <section class="Nouveaute" >
        <?php
        function truncate($text, $chars = 120) {
            if(strlen($text) > $chars) {
                $text = $text.' ';
                $text = substr($text, 0, $chars);
                $text = substr($text, 0, strrpos($text ,' '));
                $text = $text.'...';
            }
            return $text;
        };

         ?>
        <h1>Nouveauté:</h1>
        <div class="listfilm">
        <?php
        $host_name = 'db745063132.db.1and1.com';
        $database = 'db745063132';
        $user_name = 'dbo745063132';
        $password = ')Thomas016';

        $dbh = null;
        try {
          $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
          $prochainement = $dbh->query("SELECT * FROM Film ORDER BY ID_Film DESC LIMIT 4 ");
          while($donnees = $prochainement->fetch()){ ?>
            <div class="container">
                <img src="upload/<?php echo $donnees['Img_Film']; ?>" alt="test" class="image">
                <div class="middle">
                <div class="titre"> <?php echo $donnees['Titre_Film'] ?></div>
                <div class=""> <?php echo $donnees['Date_Film'] ?></div>
                <div class="overlay-synop"> <?php echo truncate($donnees['Syno_Film']); ?></div>
                <form class=""  action="detail.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $donnees[ID_Film]?>" readonly>
                  <input type="submit" name="submit" value="Plus d'info">
                </form>
                </div>

            </div>

        <?php
      }?>
      </div>
      </section>
      <?php

          $genre = $dbh->query('SELECT * FROM Genre ORDER BY Nom_Genre ASC ');
          while ($nomgenre = $genre->fetch()){?>
            <section class="<?php  echo $nomgenre['Nom_Genre']; ?>">
              <h1><?php  echo $nomgenre['Nom_Genre']; ?></h1>
              <div class="listfilm">
                <?php
                  $film = $dbh->query("SELECT *
                                       FROM Film
                                       INNER JOIN Appartient ON Film.ID_Film = Appartient.ID_Film
                                       INNER JOIN Genre ON Appartient.ID_Genre = Genre.ID_Genre
                                       WHERE Genre.ID_Genre = '" . $nomgenre['ID_Genre'] . "'
                                       ORDER BY Film.ID_Film ASC
                                       LIMIT 4");
                   while($filmgenre = $film->fetch()){ ?>
                    <div class="container">
                            <img src="upload/<?php echo $filmgenre['Img_Film']; ?>" alt="test" class="image">
                             <div class="middle">
                             <div class="right"> <i class="fav far fa-star "></i> </div>
                             <div class="titre"> <?php echo $filmgenre['Titre_Film'] ?></div>
                             <div class=""> <?php echo $filmgenre['Date_Film'] ?></div>
                             <div class="overlay-synop "> <?php echo $filmgenre['Syno_Film'] ?></div>
                             <form class=""  action="detail.php" method="post">
                                  <input type="hidden" name="id" value="<?php echo $filmgenre[ID_Film]?>" readonly>
                                  <input type="submit" name="submit" value="Plus d'info">
                             </form>

                             </div>

                    </div>

             <?php
              }
              ?>
              </div>

            </section>
         <?php
            }
          } catch (PDOException $e) {
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            die();
          }

         ?>

    </main>

    <script type="text/javascript" src="js/main.js">
    </script>


  </body>
</html>
