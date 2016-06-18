
var express = require('express')
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
var userList = []; // 在线用户昵称列表

app.use('/',express.static(__dirname + '/2048')); //指定静态资源目录
server.listen(80);
console.log('server started. listening on port 80' );

