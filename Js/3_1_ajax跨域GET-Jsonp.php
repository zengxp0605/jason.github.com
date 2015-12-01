<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="http://apps.bdimg.com/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>
            $(function() {
                $.ajax({
                    async: false,
                    url: "http://10.0.10.183:8081/test.php",
                    type: "GET",
                    dataType: 'jsonp',
                    //jsonp��ֵ�Զ���,���ʹ��jsoncallback,��ô��������,Ҫ����һ��jsoncallback��ֵ��Ӧ�Ķ���.
                    jsonp: 'jsoncallback',
                    //Ҫ���ݵĲ���,û�д���ʱ��Ҳһ��Ҫд��
                    data: {t1: 'CCC', t2: 'DD'},
                    timeout: 5000,
                    //����Json����
                    contentType: "application/json;utf-8",
                    //�������η��صĶ������name,data����.
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

<!-- ����˴��� --->
<?php
/*
 *  js �����ύ GET
 */
$callback = $_GET["jsoncallback"];
$_t1 = $_GET['t1'];
$_t2 = $_GET['t2'];
$_arr = array(
    'name'=>'����',
    'age'=>'34',
    'date'=>date('Y-m-d H:i:s'),
);
$result = "{$callback}(". json_encode($_arr).")";
//$result = $callback . "({\"name\":\"zhangsan-{$callback}-{$_t1}-{$_t2}\",\"date\":\"2012-12-03\"})";

echo $result;
exit;
?>