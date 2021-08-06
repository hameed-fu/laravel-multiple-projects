const express = require('express');
const app = express();
const http = require('http');
const redis = require('redis');
const { Socket } = require('socket.io');
const server = http.createServer(app);
 
const io = require("socket.io")(server,{
    cors:{origin:"*"}
})


io.on("connection", (socket) => {
    console.log("connection is build");

    
    var redisClient = redis.createClient();
    redisClient.subscribe('message');
    
        redisClient.on("message", function(channel, data) {
        console.log("mew message add in queue "+ data['message'] + " channel");
        socket.emit(channel, data);
    });


    socket.on("chat", (message) => {
        console.log(message);
        io.sockets.emit('chat', message); // append to all user
        // socket.broadcast.emit('userChat', message); // does not append to current user
    })


    socket.on("disconnect", (socket) => {
        console.log("disconected")
    });

})


server.listen(3000, () =>{
    console.log("server is running...")
})



