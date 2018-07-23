<?php
class Pageur{

  ///////////////////////////////////////////////////////////////////////////////////////
  //================================VARIABLE D'INSTANCE================================//
  ///////////////////////////////////////////////////////////////////////////////////////

  private $_BDDName;
  private $_tableName;
  private $_connection;
  private $_initialURI ;
  private $_currentPage;
  private $_nbPage;
  private $_valuesPerPage;
  private $_configs = [];

  ///////////////////////////////////////////////////////////////////////////////////////
  //====================================Constructeur===================================//
  ///////////////////////////////////////////////////////////////////////////////////////

  public function __construct($BDDName,$tableName,$hote = "localhost",$utilisateur = "root",$mdp = "",$valuesPerPage = 10){
    $this->_BDDName = $BDDName;
    $this->_tableName = $tableName;
    $this->_valuesPerPage = $valuesPerPage;
    $this->doConnection($hote,$utilisateur,$mdp);
    $this->setSession();
    $this->init();
  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //================================ACCESSEUR/MUTATEUR=================================//
  ///////////////////////////////////////////////////////////////////////////////////////

  //ACCESSEUR:

  //MUTATEUR:

  //ADDER
  public function addConfig(){
    foreach(func_get_args() as $arg ){
      switch ($arg) {
        case 'with_first':
          array_push($this->_configs , $arg);
          break;
        case 'with_last':
          array_push($this->_configs , $arg);
          break;
        case 'with_form':
            array_push($this->_configs , $arg);
            break;
        default:

          break;
      }
    }
  }
  ///////////////////////////////////////////////////////////////////////////////////////
  //=======================================METHODES====================================//
  ///////////////////////////////////////////////////////////////////////////////////////

  public function createElement(){
    $currentA;
    $nav = [];
    for($i = 1 ; $i < $this->_nbPage + 1; $i++){
      if($i == 1 || $i == $this->_nbPage|| $i == $this->_currentPage || $i > $this->_currentPage - 3 && $i < $this->_currentPage + 3){
        if($i == $this->_currentPage){
          $currentA =
          "<a class='pageur_index' id='pageur_active_index' href='".explode("?",$this->_initialURI)[0]."?pageur_page=".$i."' style='margin-right:5px;' >".$i."</a>";
          array_push($nav,$currentA);
        }else{
          $currentA =
          "<a class='pageur_index' id='pageur_index".$i."' href='".explode("?",$this->_initialURI)[0]."?pageur_page=".$i."' style='margin-right:5px;' >".$i."</a>";
          array_push($nav,$currentA);
        }
      }
    }

    $element =
    "<div class = 'pageur' style='display: flex ; flex-direction: column ; width: 65%';>
      <div class='pageurContent' style='height: auto; display:flex;flex-direction:column' >
        ".$this->getEntry(func_get_args())."
      </div>
      <div class='pageurNav' style='display: inline-flex ;'>
        ".implode("",$nav)."
      </div>
    </div>
    ";
    return $element;
  }

  ///////////////////////////////////////////////////////////////////////////////////////
  //==================================METHODES PRIVEES ================================//
  ///////////////////////////////////////////////////////////////////////////////////////
  private function doConnection($hote,$utilisateur,$mdp){
    try {
      $this->_connection = new PDO("mysql:host=".$hote.";dbname=".$this->_BDDName,$utilisateur,$mdp);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  private function setSession(){
      $_SESSION["pageur_initialURI"] = $_SERVER["REQUEST_URI"];
    if(!isset($_GET["pageur_page"])){
      $_SESSION["pageur_currentPage"] = 1;
    }else{
      $_SESSION["pageur_currentPage"] = $_GET["pageur_page"];
    }

    $this->_initialURI = $_SESSION["pageur_initialURI"];
    $this->_currentPage = $_SESSION["pageur_currentPage"];
    //echo " PageActuelle[".$this->_currentPage."] ";
  }

  private function init(){
    $getNbPage = $this->_connection->query("SELECT * FROM " . $this->_tableName);
    while($getNbPage->fetch()){
      $this->_nbPage ++;
    }
    $this->_nbPage = ceil(  $this->_nbPage/$this->_valuesPerPage);
    //echo " NombrePage[".$this->_nbPage."] ";
  }

  private function getEntry($params = []){
    $request = $this->_connection->query("SELECT * FROM " . $this->_tableName . " LIMIT " . ($this->_currentPage-1)*$this->_valuesPerPage . ", " .$this->_valuesPerPage);

    $entry;
    $divs = [];
    $columnValues = [];
    $j = 0;
    while($donnees = $request->fetch()){
      $currentColumn = [];

      if(count($params)>0){
        for($i = 0 ; $i < count($params); $i++){
          array_push($currentColumn,"<p class='pageur_col' id='pageur_col_".$params[$i]."$j"."'>".$donnees[$params[$i]]."</p>");
        }
      }else{
        $end =false;
        $i = 0;
        while($end ==false){
          if(isset($donnees[$i])){
            array_push($currentColumn,"<p class='pageur_col' id='pageur_col".$i."'>".$donnees[$i]."</p>");
          }else{
            $end = true;
          }
          $i++;
        }
      }

      if(in_array("with_first",$this->_configs)){
        $firstCol = "<div class='pageur_col pageur_col_first'></div>";
      }else{
        $firstCol = "";
      }

      if(in_array("with_last",$this->_configs)){
        $lastCol = "<div class='pageur_col pageur_col_last'></div>";
      }else if(in_array("with_form",$this->_configs)){
        $lastCol = "<div class='pageur_col pageur_col_last'><form class='test' action='traitementdelete.php' method='post'>
          <input type='hidden' name='baka' value=' $donnees[0]'>
          <input type='submit' name='submit' id='submit' value='' hidden >
          <label for='submit' class='fas fa-trash'></label>
        </form></div>";
      }else{
        $lastCol = "";
      }



      $div ="
      <div class='pageur_row' id='pageur_row".$j."' style='display:inline-flex;'>
        ".$firstCol. implode("",$currentColumn) .$lastCol."
      </div>";
      array_push($divs,$div);
      //echo "CurrentColumn : " . implode(" ",$currentColumn);
      $j ++;
    }
    $entry = implode("",$divs);
    return $entry;
  }

}
