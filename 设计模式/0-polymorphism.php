<?php

// ��̬
/*
	����:
		�������ǻ� �� �ϼ������������ϻ� , �����ϼ������������� ,  ���������ǻ�����
		
		��������� �ϻ���������?  û��һ���Ĵ�
		è��������, ���ǲ����ϻ�
*/

// ����: �ϻ�, ������
abstract class Tiger{

	public abstract function climb();
}

// ����: �������ǻ�
class XTiger extends Tiger{

	public function climb(){
		echo 'XTiger ������';
	}
}

// ����: �ϼ�����
class MTiger extends Tiger{
	public function climb(){
		echo 'MTiger ˤ������';
	}
}


//è��

class Cat{
	
	function climb(){
	
		echo '��������ȥ��!!!';
	}
}


// �ͻ��˵���, java�в�������ָ������,��php ������ָ��
class client{
	public function call(Tiger $tiger){
		$tiger->climb();
	}
}

$client = new client();

$client->call(new XTiger());
$client->call(new MTiger());
$client->call(new cat());  // ����ᱨ��,  call ��������Ĳ��������� Tiger ���ʵ��[Tiger ������Ҳ����]



?>