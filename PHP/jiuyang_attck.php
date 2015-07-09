<meta charset="utf-8">
<?php
error_reporting(E_ALL ^ E_NOTICE);
// 测试  刮刮卡项目

function curl($url, $post = null, $method = 'POST', $getHeader = false) {
    if (!$url)
        return false;
    $headerArray = array(
        'Accept:text/html, application/xhtml+xml, application/javascript, */*'
        , 'Content-Type:application/x-www-form-urlencoded'
            //            , 'Referer:https://mp.weixin.qq.com/'
    );
    if ($method == 'GET' && !is_null($post)) {
        $url .= '?' . http_build_query($post);
    }
    //        logger::debug($url);
    $_ch = curl_init();
    curl_setopt($_ch, CURLOPT_URL, $url);
    curl_setopt($_ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($_ch, CURLOPT_HEADER, $getHeader);
    curl_setopt($_ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
    if ($method == 'POST' && !is_null($post)) {
        //            logger::debug(http_build_query($post));
        curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($post));
    }
    $_output = curl_exec($_ch);
    //$_status = curl_getinfo($_ch, CURLINFO_HTTP_CODE);
    curl_close($_ch);
    //        logger::debug($_output);
    return $_output;
}

class dog{
    
    public $test1 = null;
    function myDefine(){
        
       $this->test1 = 111; 
    }
}


$dog = new dog();
// ======= empty  isset is_null  比较 ==================

//$dog->test1= null;

// 对象的属性 
$is_null = is_null($dog->test1) ? "test  is null-true !" : "test  is not null!";
echo "is_null:$is_null\r\n";

$isset = isset($dog->test1) ? "test  is define!" : "test  is undefine!";;
echo "isset:$isset\r\n";

$empty = !empty($dog->test1) ? "test  is define!" : "test  is undefine!";
echo "empty:$empty\r\n";

echo '<hr/>';

#不存在$test 变量
$is_null = is_null($test) ? "test  is null-true !" : "test  is not null!";
echo "is_null:$is_null\r\n";

$isset = isset($test) ? "test  is define!" : "test  is undefine!";;
echo "isset:$isset\r\n";

$empty = !empty($test) ? "test  is define!" : "test  is undefine!";
echo "empty:$empty\r\n";



$test = 100;
echo isset($test) ;  //  isset($b =100) , isset(100);    //   number 将报错 , 赋值将报错


echo empty($test); //, empty(100), empty($b = 100);

echo is_null($test), is_null(100), is_null($b = 100);  // 不报错


exit;





//  /api/saveInfo", {mobile: mobile, coupon_type: couponType, member_num: memberNum , openid :openid}
//$_url = 'http://tiefuyouhuiquan.idea-source.net/member/2/test123333';
$_i = 0;
while ($_i < 1) {

//    $_url2 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx666ac08c2587beb9'
//            . '&redirect_uri=http://soa.joyoung.com/idea/callback.aspx&response_type=code&scope=snsapi_base&state=lingquan#wechat_redirect';
//    $_res2 = curl($_url2, null, 'GET');
//
//    var_dump($_res2, '333333333');
//
//    exit;

    $_url = 'http://tiefuyouhuiquan.idea-source.net/api/saveInfo';
    $_post = array(
        'mobile' => '13565658565'
        , 'coupon_type' => '1'
        , 'member_num' => '天猫123'
        , 'openid' => 'oFefZjkJGv3p7RrY8oNaxeu2l110'//'TEST'.mt_rand(1000,9999)
    );


    $_res = curl($_url, $_post, 'POST');

    var_dump($_res);
    ++$_i;
}


////echo "<pre>";
//echo '</pre>';
echo '<br /> ok??';
exit;
?>