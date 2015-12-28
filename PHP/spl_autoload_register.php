<?php
/***
使用 spl_autoload_register() 注册自动加载

***/

/* Http.php */
//namespace Test;
//class Http {
//
//    public function __construct($name = 'undefined') {
//        $this->name = $name;
//    }
//
//    public function callname() {
//        echo "<hr />This is name = {$this->name}";
//    }
//
//}

/* test.php */
namespace Root;
class Auto {

    public static function load($class) {
        echo 'require Http.php <br />';
        //require("Http.php");
        require_once("./Http.php"); // 这里只会加载一次
    }

}
use Test\Http;
spl_autoload_register(array('\Root\Auto', 'load'));
$a1 = new Http('a1');
$a2 = new Http('a2');
$a3 = new Http('a3');
$a1->callname();
$a2->callname();
$a3->callname();
exit;


?>