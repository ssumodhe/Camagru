<html>

    <head>
        <style>
<!--
.dragme{position:relative;}
-->
</style>



    </head>
    
    <body>
        <img class="drophere" src="clem_joue.png" width=354px>
        <img id="dragme" class="dragme" src="emoji_kitty.png">
    
    
    
    
<script language="JavaScript1.2">


//var ie=document.all;
//var nn6=document.getElementById&&!document.all;
var nn6=document.querySelector('.dragme');

var isdrag=false;
var x,y;
var dobj;

function movemouse(e)
{
//                    console.log("#10");
  if (isdrag)
  {
    dobj.style.left = tx + e.clientX - x;
    dobj.style.top  = ty + e.clientY - y;
    return false;
  }
}
    
function selectmouse(e) 
{
//                    console.log("#9");
                    console.log(e);
    
  var fobj       = e.target;
                    console.log(e.target);
    
  var topelement ="HTML";

  while (fobj.tagName != topelement && fobj.className != "dragme")
  {
    fobj = fobj.parentNode;
  }

  if (fobj.className=="dragme")
  {
//                    console.log("#11");
      
    isdrag = true;
    dobj = fobj;
    tx = parseInt(dobj.style.left+0);
    ty = parseInt(dobj.style.top+0);
    x = e.clientX;
    y = e.clientY;
      console.log("tx = " + tx);
      console.log("ty = " + ty);
      console.log("x = " + x);
      console.log("y = " + y);
    document.onmousemove=movemouse;
                    console.log(e.target);
      
    return false;
  }
}
//    
//function selectmouse(e) 
//{
//                    console.log("#9");
//                    console.log("nn6: " + nn6);
//    
//  var fobj       = nn6 ? e.target : event.srcElement;
//                    console.log("fobj: " + fobj);
//    
//  var topelement = nn6 ? "HTML" : "BODY";
//                    console.log("topelement: " + topelement);
//
//  while (fobj.tagName != topelement && fobj.className != "dragme")
//  {
//    fobj = nn6 ? fobj.parentNode : fobj.parentElement;
//  }
//
//  if (fobj.className=="dragme")
//  {
//                    console.log("#11");
//      
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

document.onmousedown=selectmouse; //S'applique pendant que la souris
document.onmouseup=new Function("isdrag=false");
    
//    document.querySelector('.drophere').addEventListener('dragover', function(e){
//        e.preventDefault();                                                                         console.log("#1");});
////    Annule l'interdiction de drop et donc Autorise le drop dans la zone de la classe definie.
//    
//     document.querySelector('.drophere').addEventListener('drop', function(e) {
//                    e.preventDefault(); // Cette méthode est toujours nécessaire pour éviter une éventuelle redirection inattendue
////                    alert('Vous avez bien déposé votre élément !');
//                
//                    // Il est nécessaire d'ajouter cela car sinon le style appliqué par l'événement « dragenter » restera en place même après un drop :
//                   document.querySelector('.drophere').style.borderStyle = 'none';
//                   document.querySelector('.drophere').style.opacity = '1';
//                   document.querySelector('.drophere').style.position = 'absolute';
//                    console.log("#2");
//         
//                    });
//    
//    document.querySelector('.dragme').addEventListener('dragstart', function(e) {
//                   document.querySelector('.drophere').style.borderStyle = 'solid';
//                  document.querySelector('.drophere').style.opacity = '0.5';
//                    e.dataTransfer.setData('text/plain', "Ce texte sera transmis à l'élément HTML de réception");
//                    console.log("#3");
//                    });
//    
//    document.querySelector('.drophere').addEventListener('dragenter', function() {
//                   document.querySelector('.drophere').style.borderStyle = 'dashed';
//                    console.log("#4");
//                
//                    });
//
//    document.querySelector('.drophere').addEventListener('dragleave', function() {
//                   document.querySelector('.drophere').style.borderStyle = 'solid';
//                    console.log("#5");    
//                    });
//
//            // Cet événement détecte n'importe quel drag & drop qui se termine, autant le mettre sur « document » :
//    document.addEventListener('dragend', function() {
//                //                  alert("Un Drag & Drop vient de se terminer mais l'événement dragend ne sait pas si c'est un succès ou non.");
//                    console.log("#6");
//                    });
//    

</script>
    </body>
    
</html>