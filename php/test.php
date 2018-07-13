<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $host_name = 'localhost';
    $database = 'metro';
    $user_name = 'root';
    $password = '';

    $dbh = null;
    try {
      $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
      echo "<p>Connexion au serveur MySQL établie avec succès via pdo.</p >";
      if(isset($_POST['submit'])){

          $film = $dbh->prepare("INSERT INTO Film (Titre_Film, Date_Film, Ba_Film, Img_Film, Syno_Film) VALUES (:Tfilm, :DateFilm, Ba_film, Img_Film, Syno_Film)");
          $film->bindParam(":nomDossier", $_SESSION['dossier']);
          $dossier->execute();

          if(count($_FILES['upload']['name']) > 0){
             for($i=0; $i<count($_FILES['upload']['name']); $i++) {

               $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

               if($tmpFilePath != ""){
                 $shortname = $_FILES['upload']['name'][$i];
                 $filePath = "upload/" .$_FILES['upload']['name'][$i];
                if(move_uploaded_file($tmpFilePath, $filePath)) {
                    $files[] = $shortname;


                }
              }
            }
            echo "<h1>Uploaded:</h1>";
            if(is_array($files)){
              echo "<ul>";
              foreach($files as $file){
                  echo "<li>$file</li>";
                  $id = "1";
                  $query = $dbh->prepare("INSERT INTO Fichier (Nom_Fichier, ID_Dossier) VALUES (:nom, :id)");
                  $searchdossier = $dbh->query("SELECT ID_Dossier FROM Dossier WHERE Nom_dossier = " . $_SESSION['dossier'] . " LIMIT 1");
                  $iddosser = $searchdossier[0]->fetch();
                  $query->bindParam(":nom", $file);
                  $query->bindParam(":id", $iddossier);
                  $query->execute();
              }
              echo "</ul>";
              }
          }

      } else{?>
    <form class="" action="index.html" method="post">
      <input type="text" name="TFilm" value="" placeholder="Tfilm">
      <input type="date" name="Date" value="">
      <input type="text" name="acteur" value="" placeholder="Acteur">
      <input type="text" name="realisateur" value="" placeholder="realisateur">
      <textarea name="synopsis" rows="8" cols="80"></textarea>
      <input type="file" name="affiche" value="">
      <input type="file" name="video" value="">
    </form>
    <?php
    }
  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }

  ?>
  </body>
</html>
