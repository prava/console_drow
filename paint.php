<?PHP

?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="websocket.js"></script>

    <script>
		var clickX = new Array();
		var clickY = new Array();
		var clickDrag = new Array();
		var paint;
		var context;
		var clickXCorrection = 10;
		var clickYCorrection = 10;

        $(document).ready(function(){

            initWebSocket();

			context = document.getElementById('canvasInAPerfectWorld').getContext("2d");
			$('#canvasInAPerfectWorld').mousedown(function(e){

			  var mouseX = e.pageX - this.offsetLeft - clickXCorrection;
			  var mouseY = e.pageY - this.offsetTop - clickYCorrection;
					
			  paint = true;
			  //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
			  addClick(mouseX, mouseY);
			  redraw();
			});
			
			$('#canvasInAPerfectWorld').mousemove(function(e){
			  if(paint){
					var mouseX = e.pageX - this.offsetLeft - clickXCorrection;
					var mouseY = e.pageY - this.offsetTop - clickYCorrection;
					//addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
					addClick(mouseX, mouseY, true);
					redraw();
			  }
			});
			
			$('#canvasInAPerfectWorld').mouseup(function(e){
			  paint = false;
			});
			
			$('#canvasInAPerfectWorld').mouseleave(function(e){
			  paint = false;
			});
		});

//----------------------------------------------------------------------------------------------------------------------
		function addClick(x, y, dragging)
		{
		  var jd = 0;
          if(dragging)jd = 1;
		  var pointData = JSON.stringify(new Array(x,y,jd));
//console.log(pointData);
          send(pointData);
		  clickX.push(x);
		  clickY.push(y);
		  clickDrag.push(dragging);
		}
//----------------------------------------------------------------------------------------------------------------------
		function redraw()
		{
		  context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
		  
		  context.strokeStyle = "#df4b26";
		  context.lineJoin = "round";
		  context.lineWidth = 5;

//$("#debug-div").html("<pre>CLICK</pre>");
		  
		  for(var i=0; i < clickX.length; i++) {		
			context.beginPath();
			if(clickDrag[i] && i){
			  context.moveTo(clickX[i-1], clickY[i-1]);
			 }else{
			   context.moveTo(clickX[i]-1, clickY[i]);
			 }
			 context.lineTo(clickX[i], clickY[i]);
			 context.closePath();
			 context.stroke();
		  }
		}
//----------------------------------------------------------------------------------------------------------------------
		function clearDrow()
		{
			clickX = new Array();
			clickY = new Array();
			clickDrag = new Array();
			context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
		}
//----------------------------------------------------------------------------------------------------------------------
    </script>
</head>
<body>
<table width="100%">
	<tr>
		<td>
			<canvas id="canvasInAPerfectWorld" width="1000" height="800" style="border:1px solid #d3d3d3;">Your browser does not support the HTML5 canvas tag.</canvas>
			<button onClick="clearDrow()">clear</button>
		</td>
		<td>
			<div id="debug-div"></div>
		</td>
	</tr>
</table>

</body>
</html>


