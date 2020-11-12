var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('ioredis');
 
server.listen(3000);
io.on('connection', function (socket) {
 
  console.log("client connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('message');
  redisClient.subscribe('bitacora');
  redisClient.subscribe('notify');  
         
  redisClient.on("message", function(channel, data) {
    data = JSON.parse(data);
    if(data.modo =="bitacora"){   
        console.log("Nuevo registro: "+ data.accion + " | En el canal: " + channel  );
        socket.emit( channel , data);
    } else if(data.modo =="notify"){
      console.log("Nuevo registro: "+ data.texto + " | En el canal: " + channel  );
      socket.emit( channel , data);     
    } else if( data.modo =="chat" ){
        console.log("Nuevo mensaje: "+ data.mensaje + " | En el canal: " + channel + data.tipo + data.receptor );
        socket.emit( channel + data.tipo + data.receptor , data);
    }   
  });
  
  socket.on('disconnect', function() {
    redisClient.quit();
  });
 
});