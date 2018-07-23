<?php
  session_start();
  require("php/GestionnaireChemin.php");
  GC::load();

  $email = $_POST["email"];
  $pseudo = $_POST["pseudo"];
  $password = $_POST["password"];
  $password2 = $_POST["Cpassword"];
  $agree= $_POST["check"];
  $host_name = 'db745063132.db.1and1.com';
  $database = 'db745063132';
  $user_name = 'dbo745063132';
  $password = ')Thomas016';
  $testEmail = $_POST["email"];
  try {


    $dbh = null;
    $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
    $requeteEmail = $dbh->prepare("SELECT Mail_User FROM User WHERE Mail_User=:email");
    $requeteEmail->bindParam(":email",$testEmail);
    $requeteEmail->execute();
    if($requeteEmail->rowCount() == 0){
      if(isset($email) && isset($pseudo) && isset($password) && isset($password2) && isset($agree)){
        if($_POST["password"] == $_POST["Cpassword"]){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $query = $dbh->prepare("INSERT INTO User (Pseudo_User, Mail_User, Mdp_User, Date_user) VALUES (:pseudo, :email, :password, NOW())");
          $query->bindParam(":pseudo", $pseudo);
          $query->bindParam(":email", $email);
          $query->bindParam(":password", $hash);
          $query->execute();
          $_SESSION["msgins"] = "";
          GC::goTo("connexion.php");

        }else{
          $_SESSION["msgins"] = "Les mot de passe ne sont pas identique";
          GC::goTo("inscription.php");
        }
      }else{
        $_SESSION["msgins"] = "Un ou plusieurs champs sont incomplets";
        GC::goTo("inscription.php");
      }
    }else{
      $_SESSION["msgins"] = "Cette adresse email est déjà utiliser";
      GC::goTo("inscription.php");
    }
    $requeteEmail->closeCursor();

  } catch (PDOException $e) {

    $_SESSION["msgins"] = "Une erreur est survenue";
    GC::goTo("inscription.php");

  }
   ?>
