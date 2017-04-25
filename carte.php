<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Informations -->
    <title>Portraits of Macedonia</title>
    <meta charset="utf-8">
  <!-- Feuilles de Style -->

  <link rel="stylesheet" href="style.css">
  <link type="text/css" href="style2.css" rel="stylesheet"/>
  <link rel="stylesheet" href="leaflet/leaflet.css">
  <link rel="stylesheet" href="src/L.Control.SlideMenu.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <!-- Scripts -->

  	<script src="leaflet/leaflet.js"></script>
    <script src="src/L.Control.SlideMenu.js"></script>
    <script src='https://code.jquery.com/jquery-1.11.0.min.js'></script>


</head>
<body>
  <div id="map">


  </div>
  <script>
    // Initialisation de la carte
      var map =L.map('map', {
          center: [41.997346, 21.427996],
          zoom: 14,
          zoomControl: true
      });

    // Apparence de la carte
    var Hydda_base = L.tileLayer('http://{s}.tile.openstreetmap.se/hydda/base/{z}/{x}/{y}.png', {
        attribution: 'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        minZoom: 1,
        maxZoom: 16,
      });
    //Ajout de la carte
      Hydda_base.addTo(map);

    // Menu déroulant le contenu

//Appel Ajax Pour création des Categorie dans le menu deroulant depuis la base de donné!
let bloc =document.getElementById("Menuderoulant");

$('#Menuderoulant').ready(function(){
        $.ajax({
                type: "GET",
                url: "CreationCategorie.php",
                data: {'idtransmis':'id_categorie'},
                success: function(msg){
                    $('#bloccarte').append(msg);
                }

            });
});



var TitreMenu  = '<h1 id="titre">PORTRAITS OF MACEDONIA</h1>';
var MenuContent = '<section id="Menuderoulant"></br>';

  MenuContent+= '<div class="blocentete"><div id="btn-1" class="titrebloc">Présentation</div></div>';
  MenuContent+='<div class="blocContenu" id="blocpresentation" style="display:none">';
  MenuContent+= '<br><p>Un portrait cela peut-être des points, des lignes, des mots, agrégés d\'une unique manière pour représenter quelqu\'un. Mais chaque chose pourrait s\'écrire en mille portraits. Cette carte en regroupe quelqu\'uns de Macédoine, sa vie, ses souffles, ses lieux de passages où se croisent les vivants et leurs ancêtres.</p>';
  MenuContent+='</div>';

  MenuContent+= '<div class="blocentete"><div id="btn-2" class="titrebloc"> Carte</div></div>';
  MenuContent+='<div class="blocContenu" id="bloccarte" style="display:block">';
  MenuContent+='</div>'
  MenuContent+='</div>';

  MenuContent+= '<div class="blocentete"><div id="btn-3" class="titrebloc"> Contact</div></div>';
  MenuContent+='<div class="blocContenu" id="bloccontact" style="display:none">';
  MenuContent+= '<p>Nous sommes Sarah et Corentin, deux volontaires pour une année en Macédoine. Nous avons voulu vous partager nos découvertes.<br>';
  MenuContent+= '<form method="POST" action="traitement.php"><p><caption>Pour nous contacter :</caption><p><table><tr><th><label for="nom">Nom :</label></th><td><input type="text" id="nom" name="user_name"></td></tr><tr><th><label for="courriel">Courriel :</label></th><td><input type="email" id="courriel" name="user_email"></td></tr><tr><th><label for="message">Message :</label></th><td><textarea id="message" name="user_message" rows="5" cols="16"></textarea></td></tr><tr><th></th><td><button type="submit">Envoyer</button></td></tr></table></form>';
  MenuContent+='</div>';

MenuContent+= '</section>';




//on crée le menu
var MenuDeroulant = L.control.slideMenu(TitreMenu + MenuContent);
//on l'ajoute a la carte
MenuDeroulant.addTo(map);






  </script>

<script src="carte.js">

</script>



  <footer>

  </footer>


</body>
</html>
