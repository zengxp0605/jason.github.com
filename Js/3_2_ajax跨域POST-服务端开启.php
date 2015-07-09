<!DOCTYPE html>
<html> 
    <head> 
        <title>Ajax 跨域</title> 
        <meta charset="utf-8" /> 
    </head> 
    <body> 
        <div id="test">
        </div>
        <script>
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://10.0.10.156:21001/Test/ajax', true);
            //这里服务器端php需要设置头信息,然后返回json 格式的字符串即可
            // header("Access-Control-Allow-Origin:*");
            xhr.onload = function (e) {
              document.getElementById('test').innerHTML = 'Js写入的信息---' + this.response;
              var data = JSON.parse(this.response);
              console.log(data);
            }
            var formData = new FormData();
            formData.append('id', 12);
            formData.append('name', 'Ada');
            xhr.send(formData);

			//jquery 方式同样可以    
			//$.post('http://10.0.10.156:21001/Test/ajax',{id:111,name:'test'},function(data){
			//	console.log(data);
			//},'json');
        </script> 
    </body> 
</html> 