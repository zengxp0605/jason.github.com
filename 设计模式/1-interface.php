<?php

/*
	面向接口开发 

	{
		客户端无法看到服务器端的源码
	}
*/

// 共同接口
interface Db{
	public function conn();
}

// 服务器端开发[不知道将会被谁调用]
class DbMysql implements Db{
	public function conn(){
		echo '连接上了' . $this->_dbName();
	}
	private function _dbName(){
		return 'MySql';
	}
}


class DbSqlite implements Db{
	public function conn(){
		echo '连接上了DbSqlite';
	}
}


/*=================
	客户端调用
	[不知道DbMysql/DbSqlite 内部的细节, 
		只知道上两个类实现了db 接口,只看接口就知道如何调用,
		但是此时客户端还知道服务端的另外2个类名, 如果要让客户端不要知道其他的类名,可以使用简单工厂方法, 见下一文件
	]
==================*/
$db = new DbMysql();
$db->conn();


$db = new DbSqlite();
$db->conn();

?>