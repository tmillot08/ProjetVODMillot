<?php
class GC{

  ///////////////////////////////////////////////////////////////////////////////////////
  //================================VARIABLE D'INSTANCE================================//
  ///////////////////////////////////////////////////////////////////////////////////////

  private static $_lastURI; // Variable qui stock l'URi de la page precedente

  ///////////////////////////////////////////////////////////////////////////////////////
  //=====================================ACCESSEUR=====================================//
  ///////////////////////////////////////////////////////////////////////////////////////

  //Fonction qui retourne l'adresse de la page actuelle
  // echo GC::getCurrentUri();
    public static function getCurrentUri(){
      return $_SERVER["REQUEST_URI"];
    }

  //Fonction qui retourne l'URi de la page precedente
  // echo GC::getLastUri();
  public static function getLastUri(){
    return self::$_lastURI;
  }

  //Fonction qui permet de recuperer le nom du fichier actuelle a partir de l'URI
  //echo GC::getFileName();
  public static function getFileName(){
    $lastWord = count(explode("/",self::getCurrentUri())) -1;
    return explode("/",self::getCurrentUri())[$lastWord];
  }

  //Fonction qui permet de recuperer le nom du fichier precedent a partir de l'URI precedente
  //echo GC::getLastFileName();
  public static function getLastFileName(){
    $lastWord = count(explode("/",self::getLastUri())) -1;
    return explode("/",self::getLastUri())[$lastWord];
  }

///////////////////////////////////////////////////////////////////////////////////////
//=====================================MUTATEUR======================================//
///////////////////////////////////////////////////////////////////////////////////////

  //Fonction pour définir manuellement l'URI précedente
  // echo GC::setLasttUri("/mon-site/ma-page");
  public static function setLastUri($lastURI){
    self::$_lastURI = $lastURI;
  }

///////////////////////////////////////////////////////////////////////////////////////
//=====================================METHODE======================================//
/////////////////////////////////////////////////////////////////////////////////////

//Fonction qui s'assure que les variables de sessions sont bien définis . /!\ Fonction à appeller en premiers pour le bon fonctionnement du gestionnaire
// GC::load();
  public static function load(){
    if(isset($_SESSION["GC_lastURI"])){
      if($_SESSION["GC_lastURI"] == self::getCurrentUri()){
        $_SESSION["GC_lastURI"] == "this";
      }else{
        self::$_lastURI = $_SESSION["GC_lastURI"];
      }
    }else{
      self::$_lastURI = "Unknown";
    }
    $_SESSION["GC_lastURI"] = "";
  }

//Fonction qui permet de rediriger l'utilisateur vers la page passer en paramètre :
// GC::goTo("NomDePage");
  public static function goTo($fileName){
    $_SESSION["GC_lastURI"] = self::getCurrentUri();
    //self::setLastUri($_SESSION["GC_lastURI"]);
    header("Location:".$fileName);
  }

//Fonction qui permet de revenir a la page precedente
//GC::goBack();
public static function goBack(){
  if(isset($_SESSION["GC_lastURI"])){
    header("Location:" . self::getLastFileName());
  }else{
    echo "Fichier precedent inexistant";
  }
}

//Fonction qui retourne 'true' si l'URI precedente est identique a celle passer en parametre
// GC::fromTo("mon-site/ma-page.php");
// GC::fromTo("ma-page.php",true);
  public static function fromTo($path , $byFileName = false){
    if($byFileName == true){
      echo self::getLastFileName() . "<br>";
      if(self::getLastFileName() == $path){
        return true;
      }
    }else{
      if(self::getLastUri() == $path){
        return true;
      }
    }
    return false;
  }

  //Fonction qui reset les variable session utiliser par la classe
  // GC::resetSession();
  public static function resetSession(){
    $_SESSION["GC_lastURI"] = "";
  }

///////////////////////////////////////////////////////////////////////////////////////
//=================================METHODE PRIVEE===================================//
/////////////////////////////////////////////////////////////////////////////////////

//Fonction qui permet de créer l'URI dun fichier a partir de son nom /!\Celui ci doit se trouver dans le même répertoire
//NON UTILISER /!\
  private static function buildUri($fileName){
    $newPath = explode("/",self::getCurrentUri());
    $finalPath;
    array_pop($newPath);
    array_push($newPath,$fileName);
    for($i = 0 ; $i < count($newPath) ; $i++){
      if($i != 0 && $i != count($newPath)){
        $newPath[$i] = $newPath . "/" ;
        $finalPath =$finalPath . $newPath[$i];
      }
    }
    $finalPath;
    return $finalPath;
  }

}
 ?>
