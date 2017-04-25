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

  
  $req = $bdd->prepare('SELECT * FROM categories ORDER BY ?');
  $req->execute(array( $_GET['idtransmis']));

  while ($donnees = $req->fetch())
  {
    ?>
      <section class="MenuControlleur">
        <form class="portrait" method="POST" action="carte.php">
          <article class="img">

          <img class="photo" src="images/<?php echo($donnees['photo'])?>" value="<?php echo($donnees['id_categorie'])?>">

          <div class="description">
            <p class="texte">
            <?php echo($donnees['nom'])?>
            </p>
          </div>  

          </article>
        </form>
      </section> 
    <?php
  }
?>