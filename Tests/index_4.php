<!DOCTYPE HTML>
<html>
    <head>
        <title>TEST 3 DRAG N' DROP</title>
<!--        <link rel="stylesheet" type="text/css" href="index.css"/>-->
        
    </head>
    
    <body>
        <div>
            <img id="drophere" src="clem_joue.png" width="400">
            
        </div>
        
        <div>
            <img id="dragme" src="emoji_kitty.png" style="position: relative; left: 10px; top: 100px;">
        </div>
        
        
        <script>
            
            console.log("#1");

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
            console.log("#2");
        
//        window.onload = function(){
	       mondiv = document.getElementById("dragme");
            
           
   
            var elem = mondiv.addEventListener('mousedown',function(e) {
                    var ev = e || window.event;
                    var pos = findPos(this); 
                    console.log(this);
                        //Position du click de la souris par rapport a l'image
                    var diffx = ev.clientX - pos.x;
                    var diffy = ev.clientY - pos.y;
                    var left_x = mondiv.style.left;
                    var top_y = mondiv.style.top;
                console.log("left_x= " + left_x);
                console.log("top_y= " + top_y);
                console.log("diffx= " + diffx);
                console.log("diffy= " + diffy);
                var img_x = parseInt(left_x) + parseInt(diffx);
                var img_y = parseInt(top_y) + parseInt(diffy);
                console.log("left should be= " + (img_x));
                console.log("top should be= " + (img_y));
             
                
                return {'left_x':left_x, 'top_y':top_y, 'diffx':diffx, 'diffy':diffy, 'img_x': img_x, 'img_y': img_y};
	       });
            console.log("#3");
//            
//            mondiv.addEventListener('drop', function(e){
//                mondiv.style.left = elem.left_x + elem.diffx;
//                mondiv.style.top = elem.top_y + elem.diffy;
//            });

        
//	       mondiv.onclick = function(e) {
//		  var ev = e || window.event;
//		  var pos = findPos(this); 
//               console.log(this);
//            //Position du click de la souris par rapport a l'image
//            var diffx = ev.clientX - pos.x;
//            var diffy = ev.clientY - pos.y;
//            var left_x = mondiv.style.left;
//            var top_y = mondiv.style.top;
//                console.log("left_x= " + left_x);
//                console.log("top_y= " + top_y);
//                console.log("diffx= " + diffx);
//                console.log("diffy= " + diffy);
//
//                this.style.left = left_x + diffx;
//                this.style.top = top_y + diffy;
//	       };
            
//        };


        </script>
    </body>

<!--
//		  alert(
//			'Position relative en X : ' + diffx
//			+ '\nPosition relative en Y : ' + diffy
//			+ '\nPosition ev.client en X : ' + ev.clientX
//			+ '\nPosition ev.client en Y : ' + ev.clientY
//			+ '\nPosition pos.x en x : ' + pos.x
//			+ '\nPosition pos.y en y : ' + pos.y
//
//		      );
-->
    </html>