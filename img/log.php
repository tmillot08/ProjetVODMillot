<?php
session_start();
require("php/GestionnaireChemin.php");
GC::load();
$_SESSION["connect"] = 0;
$_SESSION["msg"] = "";

$password = htmlentities($_POST["password"]);
$mail = htmlentities($_POST["email"]);
$host_name = 'db745063132.db.1and1.com';
$database = 'db745063132';
$user_name = 'dbo745063132';
$password = ')Thomas016';

try {
  $isSearching = true;
  $location = "connexion.php";

  $connection = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if($isSearching){
    $requete = $connection->prepare("SELECT * FROM User WHERE Mail_User=:email");
    $requete->bindParam(":email",$mail);

    $mail = htmlentities($_POST["email"]);
    $requete->execute();
    while($donnees = $requete->fetch()){
      if(password_verify($_POST['password'],$donnees['Mdp_User'])){
        $_SESSION["connect"] = 1;
        $_SESSION["mail"] = $mail;
        $_SESSION["pseudo"] = $donnees["Pseudo_User"];

      }else{
        $_SESSION["msg"] = "Un ou plusieurs champs saisis sont incorrect";
      }

    }
    $requete->closeCursor();
  }
} catch (PDOException $e) {
  $_SESSION["msg"] = "Un probleme de connection est survenus .";
  //$e->getMessage();
}
if($_SESSION["connect"] == 1){
  GC::goTo("film.php");
}else {
  GC::goTo("connexion.php");
}
 ?>
