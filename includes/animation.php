<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fundo Animado</title>
  <link rel="stylesheet" href="style.css">
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body, html {
  height: 100%;
  overflow: hidden;
}

.background {
  position: fixed;
  width: 100%;
  height: 100%;
  background: linear-gradient(to top right, #0f2027, #203a43, #2c5364);
}

canvas {
  display: block;
}

  </style>
</head>
<body>
  <div class="background">
    <canvas id="bubbles"></canvas>
  </div>

  <script src="script.js"></script>

  <script>
    const canvas = document.getElementById("bubbles");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let bubbles = [];

for (let i = 0; i < 50; i++) {
  bubbles.push({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    r: Math.random() * 10 + 5,
    dx: Math.random() * 1 - 0.5,
    dy: Math.random() * -2 - 1,
    color: `rgba(255,255,255,${Math.random()})`
  });
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  
  for (let b of bubbles) {
    ctx.beginPath();
    ctx.arc(b.x, b.y, b.r, 0, Math.PI * 2);
    ctx.fillStyle = b.color;
    ctx.fill();
    ctx.closePath();
    
    b.x += b.dx;
    b.y += b.dy;
    
    if (b.y + b.r < 0) {
      b.y = canvas.height + b.r;
      b.x = Math.random() * canvas.width;
    }
  }

  requestAnimationFrame(animate);
}

animate();

  </script>
</body>
</html>
