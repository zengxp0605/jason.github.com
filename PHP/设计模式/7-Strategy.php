<?php

/*===================================
	
	strategy ����ģʽ[�򵥼���������]

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
������̵ķ�ʽд����
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
	ʹ�ò���ģʽ
======================*/
// дһ������ļ�������
class VirtualMath{
	protected $_calc;
	public function __construct($oper){
		$_className = 'Math' . $oper;
		$this->_calc = new $_className;
	}

	public function calc($op1,$op2){
		// ����������ߵ�calc ����
		return $this->_calc->calc($op1,$op2);
	}
}

// �ͻ��˵���
$_aryOper = array('Add','Sub','Mul','Div');
$_POST['oper'] = $_aryOper[rand(0,count($_aryOper) -1)];
//echo $_POST['oper'] ,'<br />';
$_POST['op1'] = rand(1,999);
$_POST['op2'] = rand(1,999);

$_math = new  VirtualMath($_POST['oper']);
$_rs = $_math->calc($_POST['op1'],$_POST['op2']);

echo $_POST['op1'],'  ',$_POST['oper'],'  ',$_POST['op2'],' = ',$_rs;

?>