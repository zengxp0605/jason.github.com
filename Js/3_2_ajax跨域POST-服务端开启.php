<!DOCTYPE html>
<html> 
    <head> 
        <title>Ajax ����</title> 
        <meta charset="utf-8" /> 
    </head> 
    <body> 
        <div id="test">
        </div>
        <script>
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://10.0.10.156:21001/Test/ajax', true);
            //�����������php��Ҫ����ͷ��Ϣ,Ȼ�󷵻�json ��ʽ���ַ�������
            // header("Access-Control-Allow-Origin:*");
            xhr.onload = function (e) {
              document.getElementById('test').innerHTML = 'Jsд�����Ϣ---' + this.response;
              var data = JSON.parse(this.response);
              console.log(data);
            }
            var formData = new FormData();
            formData.append('id', 12);
            formData.append('name', 'Ada');
            xhr.send(formData);

			//jquery ��ʽͬ������    
			//$.post('http://10.0.10.156:21001/Test/ajax',{id:111,name:'test'},function(data){
			//	console.log(data);
			//},'json');
        </script> 
    </body> 
</html> 