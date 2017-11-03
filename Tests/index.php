<!DOCTYPE HTML>
<html>
    <head>
        <title>TEST OPENCLASSROOM DRAG N' DROP</title>
        <link rel="stylesheet" type="text/css" href="index.css"/>
        
    </head>
    
    <body>
        
        <div class="dropper">

<!--    <div class="draggable">#1</div>-->
<!--    <div class="draggable">#2</div>-->
    
</div>

<!--<div class="dropper">-->
    
    <div class="draggable"><img src="emoji_kitty.png"></div>
<!--    <div class="draggable">#4</div>-->
    
<!--</div>-->
        
        
        <script>
            
//            window.onmousemove = function (e) {
//                var x = e.clientX,
//                    y = e.clientY;
//                
//                console.log(x + 20);
//                console.log(y + 20);
////    tooltipSpan.style.top = (y + 20) + 'px';
////    tooltipSpan.style.left = (x + 20) + 'px';
//};
            
            (function() {

                console.log("#1");
                
    var dndHandler = {

        draggedElement: null, // Propriété pointant vers l'élément en cours de déplacement

        applyDragEvents: function(element) {

            element.draggable = true;

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « dragstart » ci-dessous accède facilement au namespace « dndHandler »

            element.addEventListener('dragstart', function(e) {
                dndHandler.draggedElement = e.target; // On sauvegarde l'élément en cours de déplacement
                e.dataTransfer.setData('text/plain', ''); // Nécessaire pour Firefox
            });
                console.log("#2");

        },

        applyDropEvents: function(dropper) {

                console.log("#3");
            
            dropper.addEventListener('dragover', function(e) {
                e.preventDefault(); // On autorise le drop d'éléments
                this.className = 'dropper drop_hover'; // Et on applique le style adéquat à notre zone de drop quand un élément la survole
                
                console.log("#4");
                
            });

            dropper.addEventListener('dragleave', function() {
                this.className = 'dropper'; // On revient au style de base lorsque l'élément quitte la zone de drop
                console.log("#5");
                
            });

            var dndHandler = this; // Cette variable est nécessaire pour que l'événement « drop » ci-dessous accède facilement au namespace « dndHandler »

            dropper.addEventListener('drop', function(e) {

                var target = e.target,
                    draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                    clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément

                while (target.className.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                    target = target.parentNode;
                console.log("#6");
                    
                }

                target.className = 'dropper'; // Application du style par défaut

                window.onmousemove = function (e) {
                var x = e.clientX,
                    y = e.clientY;
                
//                console.log(x);
//                console.log(y);
                    //    tooltipSpan.style.top = (y + 20) + 'px';
                    //    tooltipSpan.style.left = (x + 20) + 'px';
                   return{mouse_x: x, mouse_y: y};
                console.log("#7");
                    
                };
                
                
                
                clonedElement = target.appendChild(clonedElement); // Permet de copier l'element sur la zone de Drop
                 
                dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                draggedElement.parentNode.removeChild(draggedElement); // Suppression de l'élément d'origine. Sert lors d'un nouveau drag and drop pour que l'element ne reste pas à son emplacement initial

                console.log("#8");
                
                 var x = e.clientX,
                    y = e.clientY;
                console.log(x);
                console.log(y);
                
                clonedElement.style.top = (y - 60) + 'px';
                    clonedElement.style.left = (x - 60) + 'px';
                
                    
            });

        }

    };
                
            

    var elements = document.querySelectorAll('.draggable'),
        elementsLen = elements.length;

    for (var i = 0; i < elementsLen; i++) {
        dndHandler.applyDragEvents(elements[i]); // Application des paramètres nécessaires aux éléments déplaçables
    }
                console.log("#9");
                

    var droppers = document.querySelectorAll('.dropper'),
        droppersLen = droppers.length;

                console.log("#10");
                
    for (var i = 0; i < droppersLen; i++) {
        dndHandler.applyDropEvents(droppers[i]); // Application des événements nécessaires aux zones de drop
    }

})();
//            document.onclick{
//                var x = e.clientX,
//                    y = e.clientY;
//                console.log(x);
//                console.log(y);
//            }
        </script>
    </body>
</html>