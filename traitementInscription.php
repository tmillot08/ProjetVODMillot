<?php

try {


  $connection = new PDO("mysql:host=localhost;dbname=metro", "root", "");
  $email = $_POST["email"];
  $pseudo = $_POST["pseudo"];
  $password = $_POST["password"];
  $password2 = $_POST["Cpassword"];
  $agree= $_POST["check"];
  if(isset($email) && isset($pseudo) && isset($password) && isset($password2) && isset($agree))
    if($password == $password2){
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $query = $connection->prepare("INSERT INTO User (Pseudo_User, Mail_User, Mdp_User, Date_user) VALUES (:pseudo, :email, :password, NOW())");
      $query->bindParam(":pseudo", $pseudo);
      $query->bindParam(":email", $email);
      $query->bindParam(":password", $hash);
      $query->execute();
      header("Location: connexion.php");

    }

  } catch (PDOException $e) {
    echo $e->getMessage();
  }



?>
