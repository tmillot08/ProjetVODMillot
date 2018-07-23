
      <section class="Nouveaute">
        <div class="listfilm">
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


        $q = intval($_GET['q']);
        $host_name = 'db745063132.db.1and1.com';
        $database = 'db745063132';
        $user_name = 'dbo745063132';
        $password = ')Thomas016';

        $dbh = null;
        try {
          $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
          $film = $dbh->query("SELECT *
                               FROM Film
                               INNER JOIN Appartient ON Film.ID_Film = Appartient.ID_Film
                               INNER JOIN Genre ON Appartient.ID_Genre = Genre.ID_Genre
                               WHERE Genre.ID_Genre = '" .$q. "'
                               ORDER BY Film.ID_Film ASC
                               LIMIT 4");
           while($filmgenre = $film->fetch()){ ?>
            <div class="container">
                <img src="upload/<?php echo $filmgenre['Img_Film']; ?>" alt="test" class="image">
                <div class="middle">
                <div class="titre"> <?php echo $filmgenre['Titre_Film'] ?></div>
                <div class=""> <?php echo $filmgenre['Date_Film'] ?></div>
                <div class="overlay-synop"> <?php echo truncate($filmgenre['Syno_Film']); ?></div>
                <form class=""  action="detail.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $filmgenre[ID_Film]?>" readonly>
                  <input type="submit" name="submit" value="Plus d'info">
                </form>
                </div>

            </div>

        <?php
            }
          } catch (PDOException $e) {
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            die();
          }

         ?>
        </div>
    </section>
