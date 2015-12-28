<?php

/*=================
	��������ģʽ  ==>  ���⻹�г��󹤳�ģʽ
	
==================*/

// ��ͬ�ӿ�
interface Db{
	public function conn();
}
// ���������ӿ�
interface Factory{
	public function createDb();
}

// �������˿���[��֪�����ᱻ˭����]
class DbMysql implements Db{
	public function conn(){
		echo '��������DbMysql';
	}
}


class DbSqlite implements Db{
	public function conn(){
		echo '��������DbSqlite';
	}
}


// ��������
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
	��ʱ��������һ�����ݿ�����,���øľɵĴ���.
	ֻҪд��������ʵ�����������ӿڼ���
=======================*/

class Oracle implements Db{
	public function conn(){
		echo '�������� oracle';
	}
}

class OracleFactory implements Factory{
	public function createDb(){
		return new Oracle();
	}
}

// ��������ӵ����ݿ�
$fact = new OracleFactory();
$db = $fact->createDb();
$db->conn();

/*=================
	�ͻ��˵���
	[�������˿����������ӿ�
		һ�����ݿ�ӿ�,һ���������ݿ�Ľӿ�
	]
==================*/
$factory = new MysqlFactory();
$db = $factory->createDb();
$db->conn();


$factory = new SqliteFactory();
$db = $factory->createDb();
$db->conn();










?>