<?php

// 服务器验证
if ($_SERVER['PHP_AUTH_USER'] != 'admin1' || $_SERVER['PHP_AUTH_PW'] != '123456') {
    header('WWW-Authenticate: Basic realm="MyFramework Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must enter a valid login ID and password to access this resource.\n";
    exit;
}

//require("soapHandle.class.php"); // 处理请求的class
class soapHandle {

    public function strtolink($url = '') {
        return sprintf('<div><p>This is the result from server!</p><a href="%s">%s</a></div><hr />', $url, $url);
    }

}

try {
    $server = new SOAPServer(null, array('uri' => 'http://10.0.10.156:21001/server.php'));
    $server->setClass('soapHandle'); //设置处理的class
    $server->handle();
} catch (SOAPFault $f) {
    print $f->faultString; // 打印出错信息
}
?>