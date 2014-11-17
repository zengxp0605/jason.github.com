<?php

/*===================================
	
	strategy 策略模式[简单计算器功能]

====================================*/
interface IMath{
	public function calc($op1,$op2);
}

class  MathAdd implements IMath{
	public function calc($op1,$op2){
		return $op1 + $op2;
	}
}
class  MathSub implements IMath{
	public function calc($op1,$op2){
		return $op1 - $op2;
	}
}
class  MathMul implements IMath{
	public function calc($op1,$op2){
		return $op1 * $op2;
	}
}
class  MathDiv implements IMath{
	public function calc($op1,$op2){
		return $op1 / $op2;
	}
}
/*===============
面向过程的方式写法是
if($oper == 'Add'){
	$_math = new MathAdd();
	$_rs = $_math->calc($_op1,$_op2);
}else if(){

}
.
..
...
*/

/*====================
	使用策略模式
======================*/
// 写一个虚拟的计算器类
class VirtualMath{
	protected $_calc;
	public function __construct($oper){
		$_className = 'Math' . $oper;
		$this->_calc = new $_className;
	}

	public function calc($op1,$op2){
		// 调用子类里边的calc 方法
		return $this->_calc->calc($op1,$op2);
	}
}

// 客户端调用
$_aryOper = array('Add','Sub','Mul','Div');
$_POST['oper'] = $_aryOper[rand(0,count($_aryOper) -1)];
//echo $_POST['oper'] ,'<br />';
$_POST['op1'] = rand(1,999);
$_POST['op2'] = rand(1,999);

$_math = new  VirtualMath($_POST['oper']);
$_rs = $_math->calc($_POST['op1'],$_POST['op2']);

echo $_POST['op1'],'  ',$_POST['oper'],'  ',$_POST['op2'],' = ',$_rs;

?>