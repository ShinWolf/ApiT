const ip = "localhost";
const port = "3000";
const socket = io(ip + ":" + port);

socket.on("state", function(pData) {
	if (pData.status == "connected") {
		console.log("connected to host");
	}
})

// socket.on("message", function(pData) {
// 	console.log(pData);
// })

// socket.on("eval", function(pData) {
// 	eval(pData);
// })