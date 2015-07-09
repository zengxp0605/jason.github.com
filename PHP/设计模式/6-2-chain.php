<?php
/*===============================
   6-2:使用责任链模式完成举报功能
================================*/	
$_POST['jubao'] = 4;

$_lev = $_POST['jubao'];

// 版主类, 处理 level = 1 的举报
class board {
	protected $_power = 1;
	protected $_superior = 'admin'; // 上级的类名
	public function process($lev){
		if($lev <= $this->_power){
			echo '版主删帖';
		}else{
			$_superior = new $this->_superior;
			$_superior->process($lev);
		}
	}
}

// 管理员类,处理 level = 2 的举报
class admin {
	protected $_power = 2;
	protected $_superior = 'plice'; // 上级的类名
	public function process($lev){
		if($lev <= $this->_power){
			echo '管理员封账号';
		}else{
			$_superior = new $this->_superior;
			$_superior->process($lev);
		}
	}
}

// 警察类, 处理 level = 3 的举报 [此时是最高级别的处理者,无需判断]
class  plice {
	protected $_power;
	protected $_superior = null; 
	public function process($lev){
		echo '抓起来坐牢';
	}
}

/*============
	客户端调用
===========*/
header('Content-type: text/html; charset=utf-8;');

$_judge = new board();
$_judge->process($_lev);



?>