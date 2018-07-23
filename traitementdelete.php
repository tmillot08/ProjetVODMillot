<?php
$host_name = 'db745063132.db.1and1.com';
$database = 'db745063132';
$user_name = 'dbo745063132';
$password = ')Thomas016';

$co = null;
try {
  $co = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  if(isset($_POST['submit'])){
    $delete = $co->prepare('DELETE FROM User WHERE ID_User = :id ');
    $delete->bindParam(':id', $_POST['baka']);
    $delete->execute();
  }
} catch (PDOException $e) {
  echo "Erreur!: " . $e->getMessage() . "<br/>";
  die();
}

header("location:admin.php")

 ?>
