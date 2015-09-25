<?php

class Demo extends Thread {

    public $num = 0;

    public function __construct($num) {
        $this->num = $num + 200;
    }

    public function run() {
        //当执行start方法时，run会执行，所以没有直接调用run的方法
        return $this->num;
    }

}

//时间计算开始
$t = microtime(true);
for ($i = 0; $i < 10; $i++) {
    //创建线程池
    $pool[] = new Demo($i);
}

foreach ($pool as $work) {
    //在独立线程中执行 run 方法
    $work->start();
}

foreach ($pool as $key => $value) {
    //对象是否正在运行
    while ($value->isRunning()) {
        usleep(10);
    }
    //让当前执行上下文等待被引用线程执行完毕
    if ($value->join()) {
        $row[$key] = $value->num;
    }
}
//时间计算结束
$e = microtime(true);

print_r($row);
echo '<br />';
echo ($e - $t);
?>  