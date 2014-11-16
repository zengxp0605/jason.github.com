<?php

/*=================
	简单工厂模式
	
==================*/

// 共同接口
interface Db{
	public function conn();
}

// 服务器端开发[不知道将会被谁调用]
class DbMysql implements Db{
	public function conn(){
		echo '连接上了DbMysql';
	}
}


class DbSqlite implements Db{
	public function conn(){
		echo '连接上了DbSqlite';
	}
}

// 简单工厂类
class DbFactory{
	public static function createDb($type){
		if('mysql' == $type)	
			return new 	DbMysql();
		else if('sqlite' == $type)
			return new DbSqlite();
		else
			throw new Exception('Error db type',1);
	}
}




/*=================
	客户端调用
	[不知道有哪些类, 
		只知道开放了一个 Factory::createDb() 方法
		方法允许传递数据库类型名称
	]
==================*/

$db = DbFactory::createDb('mysql');
$db->conn();

$db2 = DbFactory::createDb('sqlite');
$db2->conn();

// 这时如果增加了新的数据库类型, 不改旧代码如何实现????
// 开/闭原则: 对于修改是封闭的,对于扩展是开放的
// 因为对于java, c++ 等语言,修改源码的代价的比较大的, 需要重新编译

// 看下一个文件



?>