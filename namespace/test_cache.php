<meta charset="utf-8" />
<?php
/* 读取文件的一种方法
  111
  222
  333
  444
  555
 */
var_dump(memory_get_usage()) ;      //  返回分配给 PHP 的内存量
var_dump(memory_get_usage(true));   // 当设置为 TRUE 时，得到的内存为不包括该函数（PHP 内存管理器）占用的内存。

$file = new SplFileObject(__FILE__);
while (!$file->eof()) {

    $file->next();
    var_dump($file->current()); 
}

$file->seek(3); //这里是行数，从0开始
echo $file->current() . '<br>';

unset($file);  //  释放后占用内存变小

var_dump(memory_get_usage()) ;


$test = new MemoryTest();

var_dump(get_class($test) , get_class_vars( get_class($test) ) , get_class_methods($test));//  获取类名 || 类成员属性 || 类方法


var_dump(memory_get_usage()) ;
$test->test1();
//MemoryTest::test1();  // 调用普通方法, 报错
// 调用静态方法
$test->test2();   // 一般不报错!
MemoryTest::test2();


var_dump(memory_get_usage()) ;
unset($test);
var_dump(memory_get_usage()) ;


var_dump(memory_get_usage(true));
?>

<?php

class MemoryTest{
    
    const MUL = 10;

    public $var1 ;
    public $var2 = 'aaaaaaaaaaaa';
    public static $varStatic = 'static-value';

    public function __construct() {
        $this->var = str_repeat('中国人民....', self::MUL);
    }
    
    public function test1(){
        
        $this->var2 = str_repeat('中国人民....', self::MUL);
    }
      public static function test2(){
        
        return str_repeat('中国人民....', self::MUL);
    }
        public function test3(){
        
        $this->var2 = str_repeat('中国人民....', self::MUL);
    }
        public function test4(){
        
        $this->var2 = str_repeat('中国人民....', self::MUL);
    }
        public function test5(){
        
        $this->var2 = str_repeat('中国人民....', self::MUL);
    }
      
    
    
}


?>
<p>================读取文件性能分析================</p>

<?php
set_time_limit(0);

$filePath = "d:/px_test.sql";  
$start = microtime(true);  
  
for($i=0;$i<10000;$i++){  
    $fileHander = fopen($filePath, 'r');  
    $fileContent = fread($fileHander,  filesize($filePath));  
}  
echo "<br />耗时：".(microtime(true) - $start);  
//耗时：2.3537759780884  
unset($fileHander);

$filePath = "d:/px_test.sql";  
$start = microtime(true);  
$fileHander = fopen($filePath, 'r');  
for($i=0;$i<10000;$i++){  

    $fileContent = fread($fileHander,  filesize($filePath));  
}  
echo "<br />耗时：".(microtime(true) - $start);  
//耗时：0.43659901618958  
unset($fileHander);


$filePath = "d:/px_test.sql";  
$start = microtime(true);  
  
for($i=0;$i<10000;$i++){  
    $fileContent = file_get_contents($filePath);  
}  
echo "<br />耗时：".(microtime(true) - $start);  
//耗时：1.9885809421539
unset($fileHander);

?> 