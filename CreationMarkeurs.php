<?php
  try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=portraitsofmacedonia;charset=utf8','root',''); 
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }  
  catch(Exception $e)
    {
      die('Erreur :'.$e->getmessage());
    }   

  
  $req = $bdd->prepare('SELECT * FROM portraits WHERE id_categorie = ?');
  $req->execute(array( $_GET['id_categorie']));
  $encode_donnees = json_encode($req->fetchAll());
                    echo $encode_donnees;

?>