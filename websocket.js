
var socket;



function initWebSocket() {

    var host = "ws://165.227.140.252:9000/";
    try {
        socket = new WebSocket(host);
        log('WebSocket - status '+socket.readyState);
        socket.onopen    = function(msg) {
            log("Welcome - status "+this.readyState);
        };
        socket.onmessage = function(msg) {
            //log("Received: "+msg.data);

			var pointsData = JSON.parse(msg.data);
			pointsData.forEach(function(element) {
				//log(element[0]);
				var x=element[0];
				var y=element[1];
				var dragging=element[2];
				if(dragging == 0)dragging = false; else dragging = true;
				//addClick(x, y, dragging);
				clickX.push(x);
				clickY.push(y);
				clickDrag.push(dragging);
				redraw();
			});

        };
        socket.onclose   = function(msg) {
            log("Disconnected - status "+this.readyState);
        };
    }
    catch(ex){
        log(ex);
    }
}

function send(msg){

    if(!msg) {
        alert("Message can not be empty");
        return;
    }
    try {
        socket.send(msg);
        //log('Sent: '+msg);
    } catch(ex) {
        log(ex);
    }
}

function quit(){
    if (socket != null) {
        log("Goodbye!");
        socket.close();
        socket=null;
    }
}

function reconnect() {
    quit();
    initWebSocket();
}

// Utilities
function log(msg){ console.log(msg); }

