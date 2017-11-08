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
        
        <div>
        <div style="position: absolute;">
            <img class="drophere"   src="clem_joue.png" width=400px>
<!--            <img  class="dragme" style="position: absolute;" src="emoji_kitty.png">-->
        </div>
        <div>
            <img  class="dragme" style="position: relative;" src="emoji_kitty.png">
        </div>
        </div>
        <script>
            var drophere = document.querySelector('.drophere');
            var dragme = document.querySelector('.dragme');
            
            function findPos(el) {
	           var x = y = 0;
	           if(el.offsetParent) 
               {
                   x = el.offsetLeft;
                   y = el.offsetTop;
                   while(el = el.offsetParent) 
                   {
                       x += el.offsetLeft;
                       y += el.offsetTop;
		           }
	           }
                return {'x':x, 'y':y};
            }
        
            document.querySelector('.drophere').addEventListener('dragover', function(e) {
                    e.preventDefault(); // Annule l'interdiction de drop
                    });
            
            document.querySelector('.drophere').addEventListener('drop', function(e) {
                    e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
                
                    drophere.style.borderStyle = 'none';
                    drophere.style.opacity = '1';
                    drophere.style.position = 'absolute';
                    //Decalge entre la zone drophere et le coin superieur gauche de la fenetre
                    var int_x = parseInt(e.clientX - e.offsetX);
                    var int_y = parseInt(e.clientY - e.offsetY);
                
                
                    //Placer l'element dragme a l'endroit où la souris s'arrete.
                    dragme.style.left = parseInt(e.clientX - int_x - window.img_x) + 'px';
                    dragme.style.top = parseInt(e.clientY - int_y - window.img_y) + 'px';
             
            });
            
            
            dragme.addEventListener('dragstart', function(e) {
                    drophere.style.borderStyle = 'solid';
                    drophere.style.opacity = '0.5';
               
                    var ev = e || window.event;
                    var pos = findPos(this); 
                        //Position du click de la souris par rapport a l'image
                    var diffx = ev.clientX - pos.x;
                    var diffy = ev.clientY - pos.y;
        
         
                    window['img_x'] = diffx;
                    window['img_y'] = diffy;
                    });
           
            drophere.addEventListener('dragenter', function() {
                    drophere.style.borderStyle = 'dashed';
                
                    });

            drophere.addEventListener('dragleave', function() {
                    drophere.style.borderStyle = 'solid';
                    });

        // Cet événement détecte n'importe quel drag & drop qui se termine, autant le mettre sur « document » :
            document.addEventListener('dragend', function() {
                    });
            
        
 
        </script>
        
    </body>    
<!-- SCRIPT POUR DRAG AND DROP WITH MOUSE EVENTS ANYWHERE ON THE WINDOW
 //var nn6=document.getElementById&&!document.all;
//var isdrag=false;
//var x,y;
//var dobj;
//
//function movemouse(e)
//{
//  if (isdrag)
//  {
//            console.log("#7");
//      
//    dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x;
//    dobj.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y;
//    return false;
//  }
//}
//
//function selectmouse(e) 
//{
//            console.log("#8");
//    
//  var fobj       = nn6 ? e.target : event.srcElement;
//  var topelement = nn6 ? "HTML" : "BODY";
//
//  while (fobj.tagName != topelement && fobj.className != "dragme")
//  {
//    fobj = nn6 ? fobj.parentNode : fobj.parentElement;
//  }
//
//  if (fobj.className=="dragme")
//  {
//    isdrag = true;
//    dobj = fobj;
//    tx = parseInt(dobj.style.left+0);
//    ty = parseInt(dobj.style.top+0);
//    x = nn6 ? e.clientX : event.clientX;
//    y = nn6 ? e.clientY : event.clientY;
//    document.onmousemove=movemouse;
//    return false;
//  }
//}
//
//document.onmousedown=selectmouse;
//document.onmouseup=new Function("isdrag=false");   
-->
    
    
<!-- SCRIPT POUR POSITION DE LA SOURIS SUR UN ELEMENT
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