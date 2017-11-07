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
            <img id="dragme" src="emoji_kitty.png" style="position: relative">
        </div>
        
        
<script>
    
    var ball = document.getElementById('dragme');
    
ball.onmousedown = function(event) {

  let shiftX = event.clientX - ball.getBoundingClientRect().left;
  let shiftY = event.clientY - ball.getBoundingClientRect().top;

  ball.style.position = 'absolute';
//  ball.style.zIndeqx = 1000;
  document.body.append(ball);

  moveAt(event.pageX, event.pageY);

  // centers the ball at (pageX, pageY) coordinates
  function moveAt(pageX, pageY) {
    ball.style.left = pageX - shiftX + 'px';
    ball.style.top = pageY - shiftY + 'px';
  }

  function onMouseMove(event) {
    moveAt(event.pageX, event.pageY);
  }

  // (3) move the ball on mousemove
  document.addEventListener('mousemove', onMouseMove);

  // (4) drop the ball, remove unneeded handlers
  ball.onmouseup = function() {
    document.removeEventListener('mousemove', onMouseMove);
    ball.onmouseup = null;
  };

};

ball.ondragstart = function() {
  return false;
};
    </script>
    </body>
</html>