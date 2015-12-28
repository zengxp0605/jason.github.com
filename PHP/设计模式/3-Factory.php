<?php

/*=================
	工厂方法模式  ==>  另外还有抽象工厂模式
	
==================*/

// 共同接口
interface Db{
	public function conn();
}
// 工厂方法接口
interface Factory{
	public function createDb();
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


// 工厂方法
class MysqlFactory implements Factory{
	public function createDb(){
		return new DbMysql(); 
	}
}

class SqliteFactory implements Factory{
	public function createDb(){
		return new DbSqlite(); 
	}
}

/*-====================
	此时如果添加了一个数据库类型,不用改旧的代码.
	只要写两个个类实现上述两个接口即可
=======================*/

class Oracle implements Db{
	public function conn(){
		echo '连接上了 oracle';
	}
}

class OracleFactory implements Factory{
	public function createDb(){
		return new Oracle();
	}
}

// 调用新添加的数据库
$fact = new OracleFactory();
$db = $fact->createDb();
$db->conn();

/*=================
	客户端调用
	[服务器端开放了两个接口
		一个数据库接口,一个创建数据库的接口
	]
==================*/
$factory = new MysqlFactory();
$db = $factory->createDb();
$db->conn();


$factory = new SqliteFactory();
$db = $factory->createDb();
$db->conn();










?>