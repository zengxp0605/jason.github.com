<?php

/*=======================
	php 实现观察者模式
	php5 中提供了boserver与被观察者的subject 的接口
========================*/

class user implements SplSubject{
	public $lognum;
	public $hobby;
	
	protected $observers = null;

	public function __construct($lognum = 0,$hobby = ''){
		$this->lognum = rand(1,10);
		$_hobbies = array('sport','study');
		$this->hobby = $_hobbies[rand(0,count($_hobbies) - 1)];
		$this->observers = new SplObjectStorage();
	}

	public function attach(SplObserver $observer){
		$this->observers->attach($observer);
	
	}
	
	public function detach(SplObserver $observer){
		$this->observers->detach($observer);
	}

	public function notify(){
		$this->observers->rewind();
		while($this->observers->valid()) {
			$observer = $this->observers->current(); 
			$observer->update($this);
			$this->observers->next();
		}	
	}

	public function login(){
		// 登录操作, session 等

		// 触发自身的 notify 方法
		$this->notify();
	
	}
}	

/**-----观察者们需要实现的方法-----**/
class secrity implements SplObserver {
	
	public function update(SplSubject $subject){
		if($subject->lognum < 3){
			echo '<br />您今天是第',$subject->lognum,'次登录';
		}else{
			echo '<br />您的登录状态异常',$subject->lognum;
		}
	}
}

class ad implements SplObserver {
	
	public function update(SplSubject $subject){
		if($subject->hobby == 'sport'){
			echo '<br />台球英锦赛门票预订!',$subject->hobby;
		}else{
			echo '<br />好好学习,天天向上!',$subject->hobby;
		}
	}
}


// 实施观察
header('Content-type:text/html;charset=utf-8;');
$user = new user();
$user->attach(new secrity());
$user->attach(new ad());

$user->login();

?>