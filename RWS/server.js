// const express = require('express');
// const app = express();
// const http = require('http');
// var redis = require('redis');
// const { Socket } = require('socket.io');
// const server = http.createServer(app);


// // var app = require('express')();
// // var server = require('http').Server(app);
// // var io = require('socket.io')(server,{
// //   cors:{origin:"*"}
// // })
// // var Redis = require('ioredis');
// // var redis = new Redis();
 
// const io = require("socket.io")(server,{
//     cors:{origin:"*"}
// })


// io.on("connection", (socket) => {
//     console.log("connection is build");

    
//     var redisClient = redis.createClient();

//     redisClient.subscribe('message');

//     redisClient.on('message', function(channel, data){
//       console.log("checking..",channel,data)
//         data = JSON.parse(data);
//         console.log(data);        
//         io.emit('message', data);
//     });

    

//     redisClient.set("message","val", function(err) {
//       if (err) {
//          console.error("Something went wrong");
//       } else {
//         redisClient.get("message", function(err, value) {
//                if (err) {
//                    console.error("error + Something went wrong");
//                } else {
//                    console.log("Worked: " + value);
//                }
//           });
//       }
//     });



//     // redis.subscribe('message');
//     redis.on("message", function(channel, message) {
//         console.log("new message in queue ",channel, message);
//         // socket.emit(channel, message);
//     });


//     // socket.on("chat", (message) => {
//     //     console.log(message);
//     //     io.sockets.emit('chat', message); // append to all user
//     //     // socket.broadcast.emit('userChat', message); // does not append to current user
//     // })


//     socket.on("disconnect", () => {
//         console.log("disconected")
//     });

// })


// server.listen(3000, () =>{
//     console.log("server is running...")
// })


var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server,{
  cors:{origin:"*"}
});
var redis = require('redis');
 

server.listen(3000);
io.on('connection', function (socket) {
  console.log("connected")
 
  console.log("new client connected");
  var redisClient = redis.createClient();

  redisClient.subscribe('message');
  redisClient.on("message", function(channel, message) {
    console.log("new message in queue ", channel,message);
    // socket.emit(channel, message);
  });

  
 
  socket.on('disconnect', function() {
    redisClient.quit();
  });
 
});


