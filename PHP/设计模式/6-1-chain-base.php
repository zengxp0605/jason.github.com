<?php
/*===============================
   6-1:面向过程的方式完成举报功能
================================*/	
$_POST['jubao'] = 3;

$_lev = $_POST['jubao'];

// 版主类, 处理 level = 1 的举报
class board {
	public function process(){
		echo '版主删帖';
	}
}

// 管理员类,处理 level = 2 的举报
class admin {
	public function process(){
		echo '管理员封账号';
	}
}

// 警察类, 处理 level = 3 的举报
class  plice {
	public function process(){
		echo '抓起来坐牢';
	}
}

/*============
	客户端调用
===========*/
header('Content-type: text/html; charset=utf-8;');
if($_lev == 1){
	$_judge = new board();
	$_judge->process();
}else if ($_lev == 2){
	$_judge = new admin();
	$_judge->process();
}else {
	$_judge = new plice();
	$_judge->process();
}



?>