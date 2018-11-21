<!DOCTYPE html>
<html>
<head>
    <script>
	
	

        var sun = new Image();
        var moon = new Image();
        var earth = new Image();
        function init() {
            sun.src = 'https://mdn.mozillademos.org/files/1456/Canvas_sun.png';
            moon.src = 'https://mdn.mozillademos.org/files/1443/Canvas_moon.png';
            earth.src = 'https://mdn.mozillademos.org/files/1429/Canvas_earth.png';
            window.requestAnimationFrame(draw);
        }

        function draw() {
            var ctx = document.getElementById('canvas').getContext('2d');

            ctx.globalCompositeOperation = 'destination-over';
            ctx.clearRect(0, 0, 300, 300); // clear canvas

            ctx.fillStyle = 'rgba(0, 0, 0, 0.4)';
            ctx.strokeStyle = 'rgba(0, 153, 255, 0.4)';
            ctx.save();
            ctx.translate(150, 150);

// Earth
            var time = new Date();
            ctx.rotate(((2 * Math.PI) / 60) * time.getSeconds() + ((2 * Math.PI) / 60000) * time.getMilliseconds());
            ctx.translate(105, 0);
            ctx.fillRect(0, -12, 40, 24); // Shadow
            ctx.drawImage(earth, -12, -12);

// Moon
            ctx.save();

            //ctx.rotate(((2 * Math.PI) / 6) * time.getSeconds() + ((2 * Math.PI) / 6000) * time.getMilliseconds());
            //ctx.translate(0, 28.5);
            //ctx.drawImage(moon, -3.5, -3.5);
            ctx.restore();

            ctx.restore();

            ctx.beginPath();
            ctx.arc(150, 150, 105, 0, Math.PI * 2, false); // Earth orbit
            ctx.stroke();

            //ctx.drawImage(sun, 0, 0, 300, 300);

            window.requestAnimationFrame(draw);
        }

        //init();


        function rotate() {

            var canvasWidth = 300;
            var canvasHeight = 300;

            context = document.getElementById('canvas').getContext('2d');

            // Clear the canvas
            context.clearRect(0, 0, canvasWidth, canvasHeight);

            // Move registration point to the center of the canvas
            context.translate(canvasWidth/2, canvasWidth/2);

            // Rotate 1 degree
            context.rotate(Math.PI / 180);

            // Move registration point back to the top left corner of canvas
            context.translate(-canvasWidth/2, -canvasWidth/2);

            context.fillStyle = "red";
            context.fillRect(canvasWidth/4, canvasWidth/4, canvasWidth/2, canvasHeight/4);
            context.fillStyle = "blue";
            context.fillRect(canvasWidth/4, canvasWidth/2, canvasWidth/2, canvasHeight/4);

            //window.requestAnimationFrame(rotate);
        }

        setInterval(rotate, 100);
        //window.requestAnimationFrame(rotate);

    </script>
</head>
<body>

<canvas id="canvas" width="300" height="300" style="border:1px solid #d3d3d3;">Your browser does not support the HTML5 canvas tag.</canvas>


</body>
</html>


