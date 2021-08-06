const express = require('express');
const app = express();
const http = require('http');
const { Socket } = require('socket.io');
const server = http.createServer(app);

const io = require("socket.io")(server,{
    cors:{origin:"*"}
})



io.on("connection", (socket) => {
    console.log("connection is build");

    socket.on("disconnect", (socket) => {
        console.log("disconected")
    });


    socket.on("userChat", (message) => {
        console.log(message);
       
        io.sockets.emit('userChat', message); // append to all user
        // socket.broadcast.emit('userChat', message); // does not append to current user
    })
    

})

server.listen(3000, () =>{
    console.log("server is running...")
})