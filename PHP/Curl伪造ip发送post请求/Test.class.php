
Class Test{
	//客户端代码
	public function test_clint() {
        $ch = curl_init();
        $url = "http://10.0.10.183:8081/Index/test_server?t=1&b=2";
        $data = array(
            'name' => 'tanteng',
            'password' => 'password'
        );

        $header = array(
            'CLIENT-IP:58.68.44.61',
            'X-FORWARDED-FOR:58.68.44.61',
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $page_content = curl_exec($ch);
        curl_close($ch);
        echo $page_content;
        var_dump( json_decode($page_content));
    }
	
	// 服务端返回测试结果
    public function test_server() {
        $data = array(
            '$_POST' => $_POST,
            '$_GET' => $_GET,
            'get_client_ip' => get_client_ip(),
            '$_SERVER[\'HTTP_CLIENT_IP\']' => $_SERVER['HTTP_CLIENT_IP'],
            '$_SERVER[\'HTTP_X_FORWARDED_FOR\']' => $_SERVER['HTTP_X_FORWARDED_FOR'],
            '$_SERVER[\'REMOTE_ADDR\']' => $_SERVER['REMOTE_ADDR'],
        );

        echo json_encode($data);
    }

}