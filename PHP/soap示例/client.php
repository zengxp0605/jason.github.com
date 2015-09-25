<?php

try{
    $client = new SOAPClient(null, array(
                        'location' => 'http://10.0.10.156:21001/server.php', // 设置server路径
                        'uri' => 'http://10.0.10.156:21001/server.php',
                        'login' => 'admin1', // HTTP auth login
                        'password' => '123456' // HTTP auth password
                    ));

    echo $client->strtolink('http://www.baidu.com').'<br>';               // 直接调用server方法
    echo $client->__soapCall('strtolink', array('http://www.baidu.com')); // 间接调用server方法
}catch(SOAPFault $e){
    print $e->getMessage();
}

?>