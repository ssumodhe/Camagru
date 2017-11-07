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
            
        