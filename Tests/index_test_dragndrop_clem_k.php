<!DOCTYPE HTML>

<!--
1) Choisir image drag
2) Choisir image on drop
3) Appliquer la fusion
4) Display le resultat
-->

<html>
  
   
    
    <head>
        <title>TEST DRAG AND DROP</title>
    </head>

    
    
    
    <body> <h1>TEST DRAG AND DROP</h1>
            
        <div >
            <img id="dropper" src="clem_joue.png">
        </div>
    
        <div id="draggable">
            <img style="position: relative" src="emoji_kitty.png">
        </div>
        
        <script>
            var dropper = document.querySelector('#dropper');
            var draggable = document.querySelector('#draggable');
//            console.log(draggable.getAttribute('src'));
            
            
            
            document.querySelector('#dropper').addEventListener('dragover', function(e) {
                    e.preventDefault(); // Annule l'interdiction de drop
                });
            
            document.querySelector('#dropper').addEventListener('drop', function(e) {
                    e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
                    
                    alert('Vous avez bien déposé votre élément !');
                
                    // Il est nécessaire d'ajouter cela car sinon le style appliqué par l'événement « dragenter » restera en place même après un drop :
                    dropper.style.borderStyle = 'none';
                    dropper.style.opacity = '1';
                    var q = draggable.getAttribute('src');
                    alert(q);
                
                
                });
            

            draggable.addEventListener('dragstart', function(e) {
                    dropper.style.borderStyle = 'solid';
                    dropper.style.opacity = '0.5';
                    e.dataTransfer.setData('text/plain', "Ce texte sera transmis à l'élément HTML de réception");
                });
            
            dropper.addEventListener('dragenter', function() {
                    dropper.style.borderStyle = 'dashed';
                });

            dropper.addEventListener('dragleave', function() {
                    dropper.style.borderStyle = 'solid';
                
                });

// Cet événement détecte n'importe quel drag & drop qui se termine, autant le mettre sur « document » :
            document.addEventListener('dragend', function() {
                alert("Un Drag & Drop vient de se terminer mais l'événement dragend ne sait pas si c'est un succès ou non.");
                });
            
        </script>
        
    </body>    
    
    
    
<!--
<div id="mini_1" class="mini" style="width=500px" onclick="DragAndDrop(this.id);">mini_1</div>

<div id="drop">
    <p>Déposer ici</p>
</div>
    
    <script>

        function findPos(el) {
	           var x = y = 0;
	           if(el.offsetParent) {
                   x = el.offsetLeft;
                   y = el.offsetTop;
                   while(el = el.offsetParent) {
                       x += el.offsetLeft;
                       y += el.offsetTop;
		              }
	           }
	   return {'x':x, 'y':y};
        }
        
        window.onload = function(){
	       mondiv = document.getElementById("mini_1");
	       mondiv.onclick = function(e) {
		  var ev = e || window.event;
		  var pos = findPos(this);
          var diffx = ev.clientX - pos.x;
          var diffy = ev.clientY - pos.y;
		  alert(
			'Position relative en X : ' + diffx
			+ '\nPosition relative en Y : ' + diffy
		      );
	       };
        };

    </script>
-->

</html>