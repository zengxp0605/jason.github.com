<?php

/*
	����ӿڿ��� 

	{
		�ͻ����޷������������˵�Դ��
	}
*/

// ��ͬ�ӿ�
interface Db{
	public function conn();
}

// �������˿���[��֪�����ᱻ˭����]
class DbMysql implements Db{
	public function conn(){
		echo '��������' . $this->_dbName();
	}
	private function _dbName(){
		return 'MySql';
	}
}


class DbSqlite implements Db{
	public function conn(){
		echo '��������DbSqlite';
	}
}


/*=================
	�ͻ��˵���
	[��֪��DbMysql/DbSqlite �ڲ���ϸ��, 
		ֻ֪����������ʵ����db �ӿ�,ֻ���ӿھ�֪����ε���,
		���Ǵ�ʱ�ͻ��˻�֪������˵�����2������, ���Ҫ�ÿͻ��˲�Ҫ֪������������,����ʹ�ü򵥹�������, ����һ�ļ�
	]
==================*/
$db = new DbMysql();
$db->conn();


$db = new DbSqlite();
$db->conn();

?>