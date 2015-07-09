<?php
/*=================================
	装饰器模式做文章修饰功能
====================================*/

class BaseArt{
	protected $_content;
	
	protected $_art = null;

	public function __construct($content){
		$this->_content = $content;
	}

	public function decorator(){
		return $this->_content; // 不做任何修饰
	}
}

// 小编加文章摘要
class BianArt extends BaseArt{
	public function __construct(BaseArt $art){
		$this->_art = $art;
		
	}

	public function decorator(){
		return $this->_art->decorator()  
			. '<br /> 小编加了文章摘要 <br />';
		 
	}
}
// SEO 人员操作
class SEOArt extends BaseArt{
	public function __construct(BaseArt $art){
		$this->_art = $art;
		
	}

	public function decorator(){
		
		return $this->_art->decorator()  
			. '<br /> SEO 人员加关键词 <br />';
		
	}
}


// 调用


//$_art = new SEOArt(new BianArt(new BaseArt('好好学习,天天向上')));
$_art = new BianArt(new SEOArt(new BaseArt('好好学习,天天向上')));

echo $_art->decorator();

?>