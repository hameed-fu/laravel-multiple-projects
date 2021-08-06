
const express = require('express');
const app = express();
const server = require('http').Server(app);
const io = require("socket.io")(server,{
    cors:{origin:"*"}
})


var sockets = {};

var mysql      = require('mysql');
var moment      = require('moment');

var con = mysql.createConnection({
  host     : '127.0.0.1',
  user     : 'hameed',
  password : 'root',
  database : 'rws'
});
 
// con.connect(() =>{
//     // if(error)
//     // throw error;

//     console.log("db connected")
    
// });


io.on("connection", (socket) => {

    if(!sockets[socket.handshake.query.user_id]){
        sockets[socket.handshake.query.user_id] = [socket];
    }
    sockets[socket.handshake.query.user_id].push(socket)
    socket.broadcast.emit('user_connected',socket.handshake.query.user_id)
    
    console.log("connection is build",socket.handshake.query.user_id);
    // con.query('UPDATE users SET is_online = ? WHERE  id=?',[1,socket.handshake.query.user_id],function(){
    //     console.log('user connect',socket.handshake.query.user_id)
    // });
    
    
    socket.on("disconnect", () => {
        // console.log("disconected")
        socket.broadcast.emit('user_disconected',socket.handshake.query.user_id)
        // con.query('UPDATE users set name = ?  WHERE id=?',['0',socket.handshake.query.user_id],function(){
        //     console.log('user disconected',socket.handshake.query.user_id)
        // });
       

        for(index in sockets[socket.handshake.query.user_id]){
            if(socket.id == sockets[socket.handshake.query.user_id][index].id){
                sockets[socket.handshake.query.user_id].splice(index,1)
            }
            else{
                con.query('UPDATE users set is_online = ?  WHERE id=?',[0,socket.handshake.query.user_id],function(){
                    console.log('user disconected',socket.handshake.query.user_id)
                });
            }
        }
    });


    
})

server.listen(3000, () =>{
    console.log("server is running...")
})