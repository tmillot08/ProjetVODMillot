<?php
require("php/pageur.php");
$fenetre = new Pageur('db745063132' , 'User', 'db745063132.db.1and1.com' , 'dbo745063132', ')Thomas016', 5);
$fenetre->addConfig(with_form);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <main class="admin">


    <?php
    /*$host_name = 'localhost';
    $database = 'metro';
    $user_name = 'root';
    $password = '';*/

    $host_name = 'db745063132.db.1and1.com';
    $database = 'db745063132';
    $user_name = 'dbo745063132';
    $password = ')Thomas016';

    $dbh = null;
    try {
      $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
      echo "<p>Connexion au serveur MySQL établie avec succès via pdo.</p >";
      if(isset($_POST['submit'])){
          if(isset($_FILES['affiche'])){
            $dossier = 'upload/';
            $affiche = basename($_FILES['affiche']['name']);
            if(move_uploaded_file($_FILES['affiche']['tmp_name'], $dossier . $affiche)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
              if(isset($_FILES['video'])){
                $dossier2 = 'vid/';
                $video = basename($_FILES['video']['name']);
                if(move_uploaded_file($_FILES['video']['tmp_name'], $dossier2 . $video)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                  $film = $dbh->prepare("INSERT INTO Film (Titre_Film, Date_Film, Ba_Film, Img_Film, Syno_Film) VALUES (:Tfilm, :DateFilm, :BaFilm, :ImgFilm, :SynoFilm)");
                  $film->bindParam(":Tfilm", $_POST['TFilm']);
                  $film->bindParam(":DateFilm", $_POST['Date']);
                  $film->bindParam(":BaFilm", $video );
                  $film->bindParam(":ImgFilm", $affiche );
                  $film->bindParam(":SynoFilm", $_POST['synopsis'] );
                  $film->execute();
                  $real = $dbh->prepare("INSERT INTO Realisateur(Nom_Real) VALUES (:NomReal) ");
                  $real->bindParam(":NomReal", $_POST['realisateur']);
                  $real->execute();
                  $acteur = $dbh->prepare("INSERT INTO Acteur(Nom_Acteur) VALUES (:NomActeur) ");
                  $acteur->bindParam(":NomActeur", $_POST['acteur']);
                  $acteur->execute();
                  $searchIdFilm = $dbh->query("SELECT ID_Film From Film WHERE Titre_Film = '" . $_POST['TFilm'] . "' LIMIT 1");
                  $idFilm = $searchIdFilm->fetch()[0];
                  $searchIdReal = $dbh->query("SELECT ID_Real From Realisateur WHERE Nom_Real = '" . $_POST['realisateur'] . "' LIMIT 1");
                  $idReal = $searchIdReal->fetch()[0];
                  echo "$idReal";
                  $searchIdAct = $dbh->query("SELECT ID_Acteur From Acteur WHERE Nom_Acteur = '" . $_POST['acteur'] . "' LIMIT 1");
                  $idAct = $searchIdAct->fetch()[0];
                  $realise = $dbh->prepare("INSERT INTO Realise(ID_Film, ID_Real) VALUES (:ID_Film, :ID_Real) ");
                  $realise->bindParam(":ID_Film", $idFilm);
                  $realise->bindParam(":ID_Real", $idReal);
                  $realise->execute();
                  $joue = $dbh->prepare("INSERT INTO relation11(ID_Acteur, ID_Film) VALUES (:ID_Acteur, :ID_Film) ");
                  $joue->bindParam(":ID_Acteur", $idAct);
                  $joue->bindParam(":ID_Film", $idFilm);
                  $joue->execute();
                  $appartient = $dbh->prepare("INSERT INTO Appartient(ID_Film, ID_Genre) VALUES (:ID_Film, :ID_Genre) ");
                  $appartient->bindParam(":ID_Film", $idFilm);
                  $appartient->bindParam(":ID_Genre", $_POST['genre']);
                  $appartient->execute();

                  echo 'Upload effectué avec succès !';
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                echo 'Echec de l\'upload !';
                }

              echo 'Upload effectué avec succès !';
            }
            else //Sinon (la fonction renvoie FALSE).
            {
            echo 'Echec de l\'upload !';
            }
          }

            echo "<h1>Uploaded:</h1>";

        }
  } else{?>
    <form class="" action="" enctype="multipart/form-data" method="post">
      <input type="text" name="TFilm" value="" placeholder="Titre Film">
      <input type="date" name="Date" value="">
      <input type="text" name="acteur" value="" placeholder="Acteur">
      <input type="text" name="realisateur" value="" placeholder="realisateur">
      <select  name="genre">
        <?php
          $genre = $dbh->query('SELECT * FROM Genre ORDER BY Nom_Genre ASC ');
          while ($donnees = $genre->fetch()){
         ?>
         <option value="<?php echo $donnees['ID_Genre']; ?>"> <?php echo $donnees['Nom_Genre']; ?></option><?php
       }
       ?>

      </select>
      <textarea name="synopsis" rows="8" cols="80"></textarea>
      <input type="file" name="affiche" value="affiche">
      <input type="file" name="video" value="video">
      <input type="submit" name="submit" value="">
    </form>
    <?php
    }
  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }

    echo $fenetre->createElement("Pseudo_User","Mail_User", "Date_User");


  ?>
  </main>
  </body>
</html>
