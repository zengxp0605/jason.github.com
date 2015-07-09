<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="/templates/zh-CN/scripts/jquery-1.9.1.js"></script>
        <script>
            $(function() {
                $.ajax({
                    async: false,
                    url: "http://101.81.114.48:8998/test.php",
                    type: "GET",
                    dataType: 'jsonp',
                    //jsonp的值自定义,如果使用jsoncallback,那么服务器端,要返回一个jsoncallback的值对应的对象.
                    jsonp: 'jsoncallback',
                    //要传递的参数,没有传参时，也一定要写上
                    data: {t1: 'CCC', t2: 'DD'},
                    timeout: 5000,
                    //返回Json类型
                    contentType: "application/json;utf-8",
                    //服务器段返回的对象包含name,data属性.
                    success: function(result) {
                        alert(result.date + '||' + result.name);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus);
                    }
                });
            });
        </script>
    </head>
    <body bgcolor="#E6E6FA">
        <div>
            aaaaaaaaaaaaaaa
        </div>
    </body>
</html>

<!-- 服务端代码 --->
<?php
/*
 *  js 跨域提交 GET
 */
$callback = $_GET["jsoncallback"];
$_t1 = $_GET['t1'];
$_t2 = $_GET['t2'];
$result = $callback . "({\"name\":\"zhangsan-{$callback}-{$_t1}-{$_t2}\",\"date\":\"2012-12-03\"})";

echo $result;
exit;
?>