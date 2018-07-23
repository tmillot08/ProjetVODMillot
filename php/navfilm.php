
      <nav >
        <div class="nav2">
          <img src="./img/logo.png" alt="LOGO METROPOLIS">
          <div class="select">

            <a href="film.php"><p>Films</p></a>
            <a href="favori.php"><p>Mes Favoris</p></a>
            <p>trier par</p>
            <select  name="genre" onchange="showUser(this.value)">
              <option value="">tous les films</option>
                <?php
                $host_name = 'db745063132.db.1and1.com';
                $database = 'db745063132';
                $user_name = 'dbo745063132';
                $password = ')Thomas016';

                $dbh = null;
                try {
                  $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
                  $genre = $dbh->query('SELECT * FROM Genre ORDER BY Nom_Genre ASC ');
                  while ($donnees = $genre->fetch()){
                ?>
             <option value="<?php echo $donnees['ID_Genre']; ?>"> <?php echo $donnees['Nom_Genre']; ?></option><?php
                  }
                } catch (PDOException $e) {
                  echo "Erreur!: " . $e->getMessage() . "<br/>";
                  die();
                }
                  ?>

            </select>
          </div>
          <div class="button">
            <p>FR |  </p>
            <p>EN</p>
            <a href="logout.php"><button type="button" name="connexion">Se deconnecter </button> </a>
          </div>
        </div>
      </nav>
