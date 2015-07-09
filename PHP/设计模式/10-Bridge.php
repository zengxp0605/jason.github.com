<?php
/*=========================================
	桥接模式:

论坛给用户发消息,可以是站内短信,email,手机
==========================================*/
/*
interface Imsg{
	public function send($to,$content);
}
class Letter implements Imsg{
	public function send($to,$content){
		echo '站内信 给',$to,'  内容:',$content;
	}
}

class Email implements Imsg{
	public function send($to,$content){
		echo 'email 给',$to,'  内容:',$content;
	}
}

class Sms implements Imsg{
	public function send($to,$content){
		echo '短信 给',$to,'  内容:',$content;
	}
} */
/*==========================
	此时,如果又把三种信息分别分为 普通,紧急,特急三种类别,
	那么就会分别需要3个类,一共9个类来处理了...

===============================*/

/*-------------下面是使用桥接模式-------------------*/

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
		return '普通' . $content;
	}
}
class warnInfo extends info{
	public function msg($content){
		return '紧急' . $content;
	}
}
class urgentInfo extends info{
	public function msg($content){
		return '特急' . $content;
	}
}


class Letter{
	public function send($to,$content){
		echo '站内信 给',$to,'  内容:',$content,'<br />';
	}
}

class Email {
	public function send($to,$content){
		echo 'email 给',$to,'  内容:',$content,'<br />';
	}
}

class Sms{
	public function send($to,$content){
		echo '短信 给',$to,'  内容:',$content,'<br />';
	}
} 

//  用站内发普通消息
$_comInfo = new commonInfo(new Letter());
$_comInfo->send('xiaoming','回家吃饭了');
// 用短信发送紧急消息
$_wInfo = new warnInfo(new Sms());
$_wInfo->send('小刚','失火了');


?>