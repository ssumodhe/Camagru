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
            <img class="dropper"  src="clem_joue.png" width=400px>
        </div>
        <div>
            <img class="draggable" style="position: relative" src="emoji_kitty.png">
        </div>
        
        <script>
            var dropper = document.querySelector('.dropper');
            var draggable = document.querySelector('.draggable');
            var nn6=document.getElementById&&!document.all;
            var isdrag=false;
            var x,y,tx,ty;
            var dobj;
            
            var topelement = nn6 ? "HTML" : "BODY";
            
            function movemouse(e)
            {
                if (isdrag)
                {
                    console.log("#7");
      
                    dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x;
                    dobj.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y;
                    return false;
                }
            }

            function selectmouse(e) 
            {
                console.log("#8");
                var fobj       = nn6 ? e.target : event.srcElement;
                while (fobj.tagName != topelement && fobj.className != "dragme")
                {
                    fobj = nn6 ? fobj.parentNode : fobj.parentElement;
                }

                if (fobj.className=="draggable")
                {
                    isdrag = true;
                    dobj = fobj;
                    tx = parseInt(dobj.style.left+0);
                    ty = parseInt(dobj.style.top+0);
                    x = nn6 ? e.clientX : event.clientX;
                    y = nn6 ? e.clientY : event.clientY;
                     console.log("txselect = " + tx);
                    console.log("tyselect = " + ty);
                    console.log("xselect = " + x);
                    console.log("yselect = " + y);
//                    document.onmousemove=movemouse;
                    return false;
                }
            }
            document.onmousedown=selectmouse;
            
            
            document.querySelector('.dropper').addEventListener('dragover', function(e) {
                    e.preventDefault(); // Annule l'interdiction de drop
                    console.log("#1");
                
                    });
            
            document.querySelector('.dropper').addEventListener('drop', function(e) {
                    e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
                    
                    // Il est nécessaire d'ajouter cela car sinon le style appliqué par l'événement « dragenter » restera en place même après un drop :
                    dropper.style.borderStyle = 'none';
                    dropper.style.opacity = '1';
                    dropper.style.position = 'absolute';
                    console.log("#2");
//                    document.onmouseup=new Function("isdrag=false");
                
        
                
               
                    //Placer l'element draggable a l'endroit où la souris s'arrete.
                    draggable.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x;
                    draggable.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y;
            });
            
            draggable.addEventListener('dragstart', function(e) {
                    dropper.style.borderStyle = 'solid';
                    dropper.style.opacity = '0.5';
                    e.dataTransfer.setData('text/plain', "Ce texte sera transmis à l'élément HTML de réception");
                    console.log("#3");
                
                
//                  var pos = findPos(draggable);
//                    console.log(e.clientX - pos.x);
//                    console.log(e.clientY - pos.y);
//                 draggable.style.top = (e.clientY - pos.y) + 'px';
//                    draggable.style.left = (e.clientX - pos.x) + 'px';
                    
                    });
           
            dropper.addEventListener('dragenter', function() {
                    dropper.style.borderStyle = 'dashed';
                    console.log("#4");
                
                    });

            dropper.addEventListener('dragleave', function() {
                    dropper.style.borderStyle = 'solid';
                    console.log("#5");    
                    });

        // Cet événement détecte n'importe quel drag & drop qui se termine, autant le mettre sur « document » :
            document.addEventListener('dragend', function() {
                    console.log("#6");
                    });
            
           
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
//  if (fobj.className=="draggable")
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