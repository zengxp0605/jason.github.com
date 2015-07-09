<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>观察者模式 js代码[未使用任何模式]</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script type="text/javascript">
	function changeStyle(){
		var sel = document.getElementById('handler');
		if(sel.value == 'male'){
			document.getElementById('content').style.backgroundColor = 'gray';
			document.getElementById('ad').innerHTML = '汽车广告';
		}else if(sel.value =='female'){
			document.getElementById('content').style.backgroundColor = 'pink';
			document.getElementById('ad').innerHTML = '美容广告';
		}
	}
	/*
		上述代码如果新增了一个study区域,内容也要随风格做切换,
		那么就要修改 js 的 changeStyle() 方法,此时又对修改开放了!
	*/
</script> 
<style type='text/css'>
	body{
		padding:50px;
	}
	div{
		width:500px;
		height:200px;
		border:2px solid blue;
		margin:20px;
	}
</style>
</head>
<body>

	<h2>面向过程,不用任何设计模式</h2>
	<select id="handler" onchange="changeStyle();">
		<option value="">请选择风格</option>
		<option value="male">男士风格</option>
		<option value="female">女士风格</option>
	</select>

	<div id="content">
		内容区域
	</div>
	
	<div id="ad">
		广告区域
	</div>
	<!---在原有内容基础上增加的一块区域-->
	<div id="study">
		广告区域
	</div>
</body>
</html>
