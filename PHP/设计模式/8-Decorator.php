<?php
/*=================================
	װ����ģʽ���������ι���
====================================*/

class BaseArt{
	protected $_content;
	
	protected $_art = null;

	public function __construct($content){
		$this->_content = $content;
	}

	public function decorator(){
		return $this->_content; // �����κ�����
	}
}

// С�������ժҪ
class BianArt extends BaseArt{
	public function __construct(BaseArt $art){
		$this->_art = $art;
		
	}

	public function decorator(){
		return $this->_art->decorator()  
			. '<br /> С���������ժҪ <br />';
		 
	}
}
// SEO ��Ա����
class SEOArt extends BaseArt{
	public function __construct(BaseArt $art){
		$this->_art = $art;
		
	}

	public function decorator(){
		
		return $this->_art->decorator()  
			. '<br /> SEO ��Ա�ӹؼ��� <br />';
		
	}
}


// ����


//$_art = new SEOArt(new BianArt(new BaseArt('�ú�ѧϰ,��������')));
$_art = new BianArt(new SEOArt(new BaseArt('�ú�ѧϰ,��������')));

echo $_art->decorator();

?>