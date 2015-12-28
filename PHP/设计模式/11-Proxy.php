<?php
/*=========================================
	����ģʽ:


==========================================*/
//���������ɫ
abstract class Subject{
	public function request(){
	}
}

//��ʵ�����ɫ
class RealSubject extends Subject{
	public function request(){
		echo "<br/>RealSubject::request: I am realSubject \n";
	}
}

//���������ɫ
class Proxy extends Subject{
	protected $_realSubject;
	private function __init__(){
		$this->_realSubject = new RealSubject();
	}
	public function request(){
		$this->__init__();
		$this->_preRequest();
		$this->_realSubject->request();
		$this->_afterRequest();
	}

	private function _preRequest(){
		echo "<br/>Proxy::preRequest \n";
	}
	private function _afterRequest(){
		echo "<br/>Proxy::afterRequest \n";
	}
}

// Client

$proxy = new Proxy();
$proxy->request();


?>