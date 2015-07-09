<?php
/*=========================================
	�Ž�ģʽ:

��̳���û�����Ϣ,������վ�ڶ���,email,�ֻ�
==========================================*/
/*
interface Imsg{
	public function send($to,$content);
}
class Letter implements Imsg{
	public function send($to,$content){
		echo 'վ���� ��',$to,'  ����:',$content;
	}
}

class Email implements Imsg{
	public function send($to,$content){
		echo 'email ��',$to,'  ����:',$content;
	}
}

class Sms implements Imsg{
	public function send($to,$content){
		echo '���� ��',$to,'  ����:',$content;
	}
} */
/*==========================
	��ʱ,����ְ�������Ϣ�ֱ��Ϊ ��ͨ,����,�ؼ��������,
	��ô�ͻ�ֱ���Ҫ3����,һ��9������������...

===============================*/

/*-------------������ʹ���Ž�ģʽ-------------------*/

abstract class info{
	protected $sender = null;
	public function __construct($sender){
		$this->sender = $sender;
		
	}

	abstract public function msg($content);
	public function send($to,$content){
		$content = $this->msg($content);
		$this->sender->send($to,$content);

	}
}

class commonInfo extends info{
	public function msg($content){
		return '��ͨ' . $content;
	}
}
class warnInfo extends info{
	public function msg($content){
		return '����' . $content;
	}
}
class urgentInfo extends info{
	public function msg($content){
		return '�ؼ�' . $content;
	}
}


class Letter{
	public function send($to,$content){
		echo 'վ���� ��',$to,'  ����:',$content,'<br />';
	}
}

class Email {
	public function send($to,$content){
		echo 'email ��',$to,'  ����:',$content,'<br />';
	}
}

class Sms{
	public function send($to,$content){
		echo '���� ��',$to,'  ����:',$content,'<br />';
	}
} 

//  ��վ�ڷ���ͨ��Ϣ
$_comInfo = new commonInfo(new Letter());
$_comInfo->send('xiaoming','�ؼҳԷ���');
// �ö��ŷ��ͽ�����Ϣ
$_wInfo = new warnInfo(new Sms());
$_wInfo->send('С��','ʧ����');


?>