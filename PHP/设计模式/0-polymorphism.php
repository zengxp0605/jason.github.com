<?php

// 多态
/*
	例如:
		西伯利亚虎 和 孟加拉虎都属于老虎 , 但是孟加拉虎不能爬树 ,  而西伯利亚虎可以
		
		所以如果问 老虎会爬树吗?  没有一定的答案
		猫都能爬树, 但是不是老虎
*/

// 父类: 老虎, 抽象类
abstract class Tiger{

	public abstract function climb();
}

// 子类: 西伯利亚虎
class XTiger extends Tiger{

	public function climb(){
		echo 'XTiger 会爬树';
	}
}

// 子类: 孟加拉虎
class MTiger extends Tiger{
	public function climb(){
		echo 'MTiger 摔下来了';
	}
}


//猫类

class Cat{
	
	function climb(){
	
		echo '爬到天上去了!!!';
	}
}


// 客户端调用, java中参数必须指明类型,而php 中无需指定
class client{
	public function call(Tiger $tiger){
		$tiger->climb();
	}
}

$client = new client();

$client->call(new XTiger());
$client->call(new MTiger());
$client->call(new cat());  // 这里会报错,  call 方法传入的参数必须是 Tiger 类的实例[Tiger 的子类也可以]



?>