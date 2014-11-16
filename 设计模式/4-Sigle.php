<?php

/*=================
	单例模式
==================*/

/* 
// 第一步, 普通
class Sigle{

}
$s1 = new Sigle();
$s2 = new Sigle();
// 同一个对象时,全等才成立,new 两次是两个不同的对象
if($s1 === $s2){
	echo '是一个对象';
}else{
	echo '是两个对象';
}
*/

/* 
// 第二步, 封锁new 操作,  将 __construct 方法设为protected
// 并提供一个 new 自身的静态方法
class Sigle{
	protected static $instance = null;
	//提供一个new 自身的方法,并在new 之前判断是否存在自身的实例
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	// 外部无法new 这个对象
	protected function __construct(){
	
	}

}
//$s1 = new Sigle(); // 这时new 操作将会出错
$s1 = Sigle::getInstance();
$s2 = Sigle::getInstance();

// 同一个对象时,全等才成立 ,此时是同一个对象
if($s1 === $s2){
	echo '是一个对象';
}else{
	echo '是两个对象';
}
*/

/* 
// 第三步, 防止将 __construct 方法被继承的类 覆盖掉了[加上final , final 的方法不能覆盖, final的类 不能被继承]
// 并提供一个 new 自身的静态方法
class Sigle{
	protected static $instance = null;
	//提供一个new 自身的方法,并在new 之前判断是否存在自身的实例
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	// 外部无法new 这个对象
	final protected function __construct(){
	
	}

}

class otherClass extends Sigle{
	// 将会报错 Fatal error: Cannot override final method 
	public function __construct(){
	
	}
}
$s1 = new otherClass();
$s2 = new otherClass();
// 同一个对象时,全等才成立
if($s1 === $s2){
	echo '是一个对象';
}else{
	echo '是两个对象';
}
*/

/*  */
// 第四步, 防止克隆
// 并提供一个 new 自身的静态方法
class Sigle{
	protected static $instance = null;
	//提供一个new 自身的方法,并在new 之前判断是否存在自身的实例
	public static function getInstance(){
		if(self::$instance === null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	// 方法前加final, 则方法无法被覆盖; 类前加final 则类不能被继承
	final protected function __construct(){
	
	}

	// 防止克隆对象
	final protected function __clone(){
	
	}
}
//$s1 = new Sigle(); // 这时new 操作将会出错
$s1 = Sigle::getInstance();
//$s2 = clone($s1); //无法克隆该对象
$s2 = Sigle::getInstance();


// 同一个对象时,全等才成立
if($s1 === $s2){
	echo '是一个对象';
}else{
	echo '是两个对象';
}


?>