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
$result = $callback . "({\"name\":\"zhangsan-{$callback}-{$_t1}-{$_t2}\",\"date\":\"2012-12-03\"})";

echo $result;
exit;
?>