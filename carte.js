
//Function pour ouvrir et fermer les sous paragraphes du menu deroulant
var classTitreBloc = document.getElementsByClassName("titrebloc");
var presentation = document.getElementById("blocpresentation");
var carte = document.getElementById("bloccarte");
var contact = document.getElementById("bloccontact");
var bool=true;

var CreationCategorie = function(event) {
	
	var cible = event.target.id;
	var resulat = cible.replace("btn-","");
	var id = parseInt(resulat);
    if(id===1 && bool ===true){
    	presentation.style.display='block';
    	bool =false;
    }
    else if(id===1 && bool ===false){
    	presentation.style.display='none';
    	bool=true;
    }
     if(id===2 && bool ===true){
    	carte.style.display='none';
    	bool =false;
    }
    else if(id===2 && bool ===false){
    	carte.style.display='block';
    	bool=true;
    }
    if(id===3 && bool ===true){
    	contact.style.display='block';
    	bool =false;
    }
    else if(id===3 && bool ===false){
    	contact.style.display='none';
    	bool=true;
    }
};

for (var i = 0; i < classTitreBloc.length; i++) {
    classTitreBloc[i].addEventListener('click', CreationCategorie, false);

}
//Fin de la function Menu


//Function de geolocalisation
var geoloc = function(){
map.locate({setView: true, maxZoom:10, watch: true}) /* This will return map so you can do chaining */
        .on('locationfound', function(e){
             marker = L.marker([e.latitude, e.longitude]).bindPopup('Your are here :)');
             circle = L.circle([e.latitude, e.longitude], e.accuracy/2, {
                weight: 2,
                color: 'blue',
                fillColor: '#cacaca',
                fillOpacity: 0.2
            });
            map.addLayer(marker);
            map.addLayer(circle);

        })
       .on('locationerror', function(e){
            alert("Location access denied.");
        });
}

var returnGeoloc = function(){
	map.stopLocate({setView: false, watch: false});
	map.removeLayer(marker);
	map.removeLayer(circle);
	map.setView([41.991346,21.429200]);
}
  
//Functions Menus!!


var classname = document.getElementsByClassName("blocContenu");
var antibug =true;


var myFunction = function(event) {

var id=event.target;
var attribute = id.getAttribute("value");
var idCat = parseInt(attribute);
 
if(idCat === 1 && antibug ===true){
		geoloc();
		id.style.backgroundColor ="yellow";
		antibug = false;
}
else if(idCat === 1 && antibug ===false){
		returnGeoloc();
		id.style.backgroundColor ="#93969F";
		antibug = true; 
}
if(idCat === 2 && antibug ===true){
	L.tileLayer('http://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png',{
        minZoom: 1,
        maxZoom: 16,
    }).addTo(map);
	id.style.backgroundColor ="yellow";
	antibug = false;
}
else if(idCat === 2 && antibug ===false){
	L.tileLayer('http://{s}.tile.openstreetmap.se/hydda/base/{z}/{x}/{y}.png',{
	minZoom: 1,
	maxZoom: 16,
	}).addTo(map);
	id.style.backgroundColor ="#93969F";
	antibug = true; 
}
else{
	$.ajax({
                type: "GET",
                url: "CreationMarkeurs.php",
                data: {'id_categorie': idCat}, // je passe la variable JS
                success: function(msg){ // je récupère la réponse dans la variable msg
            var donneRecu = JSON.parse(msg);
	            for (var i = 0; i < donneRecu.length; i++) {

							var MyCity = {
							"type": "FeatureCollection",
								features: [{
									type: 'Feature',
									"geometry": {
									"type": "Point",
									"coordinates": [donneRecu[i].longitude, donneRecu[i].latitude],
									},
									"properties": {
									'title': donneRecu[i].identity,
									'images': [
										['img/'+donneRecu[i].photo1, donneRecu[i].text],
									]
									}
								}]
							};
					var essai =L.geoJSON(MyCity);
                    essai.addTo(map);
                    var test = L.geoJSON(MyCity, {
                        onEachFeature: onEachFeature
                    });
                       
	            }
               
	    			
            }

            });
    }
};

for (var i = 0; i < classname.length; i++) {
    classname[i].addEventListener('click', myFunction, false);

}

function onEachFeature(feature,layer) {
   if (feature.properties && feature.properties.title) {

        var images = feature.properties.images;
        var slideshowContent = '';

        for (var i = 0; i < images.length; i++) {
          var img = images[i];

          slideshowContent += '<div class="image' + (i === 0 ? ' active' : '') + '">' +
            feature.properties.title +
            '<img src="' + img[0] + '" />' +
            '<div class="caption">' + img[1] + '</div>' +
            '</div>';
        }

        var popupContent = '<div id="' + feature.properties.title + '" class="popup">' +
          '<div class="slideshow">' +
          slideshowContent +
          '</div>' +
          '<div class="cycle">' +
          '<a href="#" class="prev">&laquo; Previous</a>' +
          '<a href="#" class="next">Next &raquo;</a>' +
          '</div>'
        '</div>';

        layer.bindPopup(popupContent).addTo(map);
      }
}


