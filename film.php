<?php
session_start();
require("php/GestionnaireChemin.php");
GC::load();
if($_SESSION["connect"]  != 1){
  header("Location:connexion.php");
}
if(!GC::fromTo("connexion.php")){
  echo "Bienvenue " . $_SESSION["pseudo"] . "<br>";
  echo $_SESSION["GC_lastURI"];
}



 ?>
