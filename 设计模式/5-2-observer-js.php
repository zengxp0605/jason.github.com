<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>观察者模式 js代码</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<style type='text/css'>
	body{
		padding:20px;
	}
	div{
		width:500px;
		height:100px;
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
	<br />
	<button onclick="cancel();">取消study区域观察</button>
	<div id="content">
		内容区域
	</div>
	
	<div id="ad">
		广告区域
	</div>
	<!---在原有内容基础上增加的一块区域-->
	<div id="study">
		学习区域
	</div>
<script type="text/javascript">		
	/*
	 简述: 页面中的三个div 均需要因handler 的变化而做出相应的改变,
		此时就可以使用观察者模式,让div观察 handler 的变化,做出响应
		handler(被观察者) ==> div(观察者) :  [1 => 多] 的关系
	*/
	var sel = document.getElementById('handler');
	sel.observers = {};
	sel.attach = function(key,obj){
		sel.observers[key] = obj;

	}
	sel.detach = function(key){
		delete this.observers[key];
	}
	// 通知的方法
	sel.onchange = sel.notify = function(){
		for(var k in this.observers){
			this.observers[k].update(this);
		}
	}
	
	/*-------观察者们的事件-----*/
	var content = document.getElementById('content');
	var ad = document.getElementById('ad');
	content.update = function(observee){
		if(observee.value == 'male'){
			this.style.backgroundColor = 'gray';
		}else if(observee.value == 'female'){
			this.style.backgroundColor = 'pink';			
		}
	};
	ad.update = function(observee){
		if(observee.value == 'male'){
			this.innerHTML = '汽车广告';
		}else if(observee.value == 'female'){
			this.innerHTML = '美容广告';
		}
	};

	sel.attach('cont',content);
	sel.attach('ad',ad);
	
	
	/*=========================================
		此时若要添加其他div(如 study)的变化事件
	只需要写好它的update 事件, 并绑定attach 事件即可
	=========================================*/
	var study = document.getElementById('study');
	study.update = function(observee){
		if(observee.value == 'male'){
			this.innerHTML = '学习金融';
		}else if(observee.value == 'female'){
			this.innerHTML = '学习财务';
		}
	};
	sel.attach('study',study);
	
	console.log(sel.observers);
	// 取消监听
	function cancel(){
		sel.detach('study');
		console.log(sel.observers);
	}

</script> 
</body>
</html>
