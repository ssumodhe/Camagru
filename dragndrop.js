var drophere = document.querySelector('.drophere');
var dragme = document.querySelector('.dragme');
var f_left = document.querySelector('#f_left');
var f_top = document.querySelector('#f_top');
var pic_display_left = document.querySelector('#pic_display_left');
var pic_display_top = document.querySelector('#pic_display_top');
var dest_width = document.querySelector('#dest_width');
var dest_height = document.querySelector('#dest_height');
  
dest_height.setAttribute('value', drophere.offsetHeight);
dest_width.setAttribute('value', drophere.offsetWidth);

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
                
//                    drophere.style.borderStyle = 'none';
//                    drophere.style.opacity = '1';
//                    drophere.style.position = 'absolute';
                    //Decalge entre la zone drophere et le coin superieur gauche de la fenetre
                    var int_x = parseInt(e.clientX - e.offsetX);
                    var int_y = parseInt(e.clientY - e.offsetY);
                
                
                    //Placer l'element dragme a l'endroit où la souris s'arrete.
                    dragme.style.left = parseInt(e.clientX - int_x - window.img_x + 5) + 'px';
                    dragme.style.top = parseInt(e.clientY - int_y - window.img_y + 5) + 'px';
                    f_left.setAttribute('value', parseInt(e.clientX - int_x - window.img_x + 5));
                    f_top.setAttribute('value', parseInt(e.clientY - int_y - window.img_y + 5));
                    pic_display_left.setAttribute('value', dragme.offsetLeft);
                    pic_display_top.setAttribute('value', dragme.offsetTop);
                    
            });
            
            
            dragme.addEventListener('dragstart', function(e) {
//                    drophere.style.borderStyle = 'solid';
//                    drophere.style.opacity = '0.5';
               
                    var ev = e || window.event;
                    var pos = findPos(this); 
                        //Position du click de la souris par rapport a l'image
                    var diffx = ev.clientX - pos.x;
                    var diffy = ev.clientY - pos.y;
        
         
                    window['img_x'] = diffx;
                    window['img_y'] = diffy;
                    });
           
            drophere.addEventListener('dragenter', function() {
//                    drophere.style.borderStyle = 'dashed';
                
                    });

            drophere.addEventListener('dragleave', function() {
//                    drophere.style.borderStyle = 'solid';
                    });

        // Cet événement détecte n'importe quel drag & drop qui se termine, autant le mettre sur « document » :
            document.addEventListener('dragend', function() {
                    });

          //Deplacer le dragme avec les touches  
        document.onkeyup=function (e)
        {
            e=e || window.event;
            var code= e.keyCode || e.wihch;
            if(code == 69)
                {
                    var up_top = parseInt(f_top.getAttribute("value"));
                    dragme.style.top = parseInt(up_top - 5) + "px";
                    f_top.setAttribute('value', parseInt(up_top - 5));
                    pic_display_top.setAttribute('value', dragme.offsetTop);
                }
            if(code == 68)
                {
                    var down_top = parseInt(f_top.getAttribute("value"));
                    dragme.style.top = parseInt(down_top + 5) + "px";
                    f_top.setAttribute('value', parseInt(down_top + 5));
                    pic_display_top.setAttribute('value', dragme.offsetTop);
                }
            if(code == 83)
                {
                    var left_left = parseInt(f_left.getAttribute("value"));
                    dragme.style.left = parseInt(left_left - 5) + "px";
                    f_left.setAttribute('value', parseInt(left_left - 5));
                    pic_display_left.setAttribute('value', dragme.offsetLeft);
                }
            if(code == 70)
                {
                    var right_left = parseInt(f_left.getAttribute("value"));
                    dragme.style.left = parseInt(right_left + 5) + "px";
                    f_left.setAttribute('value', parseInt(right_left + 5));
                    pic_display_left.setAttribute('value', dragme.offsetLeft);
                }
        }