<?php

/*=================
	����ģʽ
==================*/

/* 
// ��һ��, ��ͨ
class Sigle{

}
$s1 = new Sigle();
$s2 = new Sigle();
// ͬһ������ʱ,ȫ�Ȳų���,new ������������ͬ�Ķ���
if($s1 === $s2){
	echo '��һ������';
}else{
	echo '����������';
}
*/

/* 
// �ڶ���, ����new ����,  �� __construct ������Ϊprotected
// ���ṩһ�� new ����ľ�̬����
class Sigle{
	protected static $instance = null;
	//�ṩһ��new ����ķ���,����new ֮ǰ�ж��Ƿ���������ʵ��
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	// �ⲿ�޷�new �������
	protected function __construct(){
	
	}

}
//$s1 = new Sigle(); // ��ʱnew �����������
$s1 = Sigle::getInstance();
$s2 = Sigle::getInstance();

// ͬһ������ʱ,ȫ�Ȳų��� ,��ʱ��ͬһ������
if($s1 === $s2){
	echo '��һ������';
}else{
	echo '����������';
}
*/

/* 
// ������, ��ֹ�� __construct �������̳е��� ���ǵ���[����final , final �ķ������ܸ���, final���� ���ܱ��̳�]
// ���ṩһ�� new ����ľ�̬����
class Sigle{
	protected static $instance = null;
	//�ṩһ��new ����ķ���,����new ֮ǰ�ж��Ƿ���������ʵ��
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	// �ⲿ�޷�new �������
	final protected function __construct(){
	
	}

}

class otherClass extends Sigle{
	// ���ᱨ�� Fatal error: Cannot override final method 
	public function __construct(){
	
	}
}
$s1 = new otherClass();
$s2 = new otherClass();
// ͬһ������ʱ,ȫ�Ȳų���
if($s1 === $s2){
	echo '��һ������';
}else{
	echo '����������';
}
*/

/*  */
// ���Ĳ�, ��ֹ��¡
// ���ṩһ�� new ����ľ�̬����
class Sigle{
	protected static $instance = null;
	//�ṩһ��new ����ķ���,����new ֮ǰ�ж��Ƿ���������ʵ��
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	// ����ǰ��final, �򷽷��޷�������; ��ǰ��final ���಻�ܱ��̳�
	final protected function __construct(){
	
	}

	// ��ֹ��¡����
	final protected function __clone(){
	
	}
}
//$s1 = new Sigle(); // ��ʱnew �����������
$s1 = Sigle::getInstance();
//$s2 = clone($s1); //�޷���¡�ö���
$s2 = Sigle::getInstance();


// ͬһ������ʱ,ȫ�Ȳų���
if($s1 === $s2){
	echo '��һ������';
}else{
	echo '����������';
}


?>