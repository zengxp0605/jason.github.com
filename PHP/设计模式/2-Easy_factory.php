<?php

/*=================
	�򵥹���ģʽ
	
==================*/

// ��ͬ�ӿ�
interface Db{
	public function conn();
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

// �򵥹�����
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
	�ͻ��˵���
	[��֪������Щ��, 
		ֻ֪��������һ�� Factory::createDb() ����
		�������������ݿ���������
	]
==================*/

$db = DbFactory::createDb('mysql');
$db->conn();

$db2 = DbFactory::createDb('sqlite');
$db2->conn();

// ��ʱ����������µ����ݿ�����, ���ľɴ������ʵ��????
// ��/��ԭ��: �����޸��Ƿ�յ�,������չ�ǿ��ŵ�
// ��Ϊ����java, c++ ������,�޸�Դ��Ĵ��۵ıȽϴ��, ��Ҫ���±���

// ����һ���ļ�



?>