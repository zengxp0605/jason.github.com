# Js 学习笔记 #

   [参看Web版本](http://jasonnodes.sinaapp.com/index.php?type=js)

--------------------
## 一. 基础知识 ##
### 1. js 替换回车,空格 

	    var testStr = "ss  sss\r\n\ aaaaa\rbbbb\ncccc  cc  c\
                vvv  vv";
        console.log(testStr);
        var resultStr = testStr.replace(/\ +/g, "");//去掉空格
        console.log(resultStr);
        resultStr = testStr.replace(/[ ]/g, ""); //去掉空格
        console.log(resultStr);
        resultStr = testStr.replace(/[\r\n]/g, "");//去掉回车换行
        console.log(resultStr);

### 2. js 中数据类型的判断

	    // 数组
        var a = [];
        console.log(typeof a);       // object
        console.log($.type(a));      // array   
        console.log($.type(a) === 'array');      // true

        console.log(typeof a[1] == undefined);       // false
        console.log($.type(a[1]) == undefined);      // false
        console.log(typeof a[1] === 'undefined');   // true
        console.log($.type(a[1]) === 'undefined');  // true
        console.log('---分隔符---1');

        // 对象
        var b = {};
        console.log(typeof b);       // object
        console.log($.type(b));      // object
        console.log('---分隔符---2');

        var n = null;
        console.log(typeof n);       // object
        console.log($.type(n));      // null

        console.log(typeof n == 'undefined');       // false
        console.log(typeof n == 'null');            // false !!!!!
        console.log(typeof n == null);             // false !!!!! 这里尤其需要注意,结果为false 
        console.log($.type(n) == null);             // false
        console.log(typeof n === 'object');        // true
        console.log($.type(n) === 'null');         // true
        console.log('---分隔符---3');

        // 下面的测试也值得注意, 在 m  未声明前,  typeof m  可以运行, 但是 $.type(m) 将报错
        console.log(typeof m === 'undefined');       // true
        //console.log($.type(m) === 'undefined');      // 报错, 若后面及时定义了 m 也不报错
        //var m;
        setTimeout(function() {   // 延时是为了 不让 声明对象影响到上面的判断
            var m;   // 声明但是未初始化值.
            console.log(typeof m === 'undefined');       // true
            console.log($.type(m) === 'undefined');     // true
        }, 1000);

       
 
   **小结:**

   -  js 中的typeof 方法 和jq 中 $.type() 方法判断数据类型时,应该与字符串相比较,如 : 'undefined','object','null','array'(适用于jq) .
   - var a = [] 时, typeof a==='object', $.type(a) === 'array', 未定义的数组元素 typeof a[1] === 'undefined',$.type(a[1]) === 'undefined'.
   - var b = {} 时, typeof b==='object', $.type(b) === 'object' .
   - var n = null 时, typeof n === 'object', $.type(n) === 'array'.
   - 未声明的变量, 可以使用 typeof 来判断, 但用 $.type() 将会报错
   

### 3. js 实现php 中isset 函数

        var isset = function(obj, props) {
            if ((typeof (obj) === 'undefined') || (obj === null))
                return false;
            else if (props && props.length > 0)
                return isset(obj[props.shift()], props);   //shift() 方法用于把数组的第一个元素从其中删除，并返回第一个元素的值。
            else
                return true;
        };

        var a = [];  // var a = {}; // 空数组 和空对象一样的处理

        // Test 1...
        console.log(isset(a['not'])); 	// false
        console.log(isset(a[1])); 		// false
        // Test 2..
        console.log(isset(a, ['not'])); 		// false
        console.log(isset(a, ['not', 'existent']));  // false
        console.log(isset(['not', 'existent'])); 	 // true 

        console.log('----分隔符---');
        // Test 3..
        var n = null;
        console.log(isset(n)); 			// false
        console.log(isset(n, ['not', 'existent']));  // false
        console.log(isset(['not', 'existent']));  	// true 
        console.log(isset({a: [], b: {}}));  		// true   
		
		// 或者使用以下简单的判断
		/*
        isset = function(a) {
           if ((typeof (a) === 'undefined') || (a === null))
               return false;
           else
               return true;
       }; */



###4. Js 对象
 1. [JS中的constructor与prototype](http://blog.csdn.net/niuyongjie/article/details/4810835 "--待理解--")  _待理解_
 2. [js中页面跳转和刷新的几个小技巧](http://0768vic.blog.163.com/blog/static/6808571201332142921878/) _待总结_
 3. js 对象属性名使用变量
 
	      // js 对象属性名使用变量
	        var key = ['o', 'p', 'q'];
	        var val = ['order', 'page', 'query'];
	        testArray2(key, val);
	        function testArray2(key, val) {
	            if (key.length != val.length)
	                return null;
	            var _rs = {};
	            for (var i in key) {
	                _rs[key[i]] = val[i];
	            }
	            console.log(_rs);   //Output:  Object { o="order", p="page", q="query"}
	        }

###5. Js 数组
 1.  定义数组 : 
  - 疑问1: 两个相同方法定义的数组无法比较其是否相等？？
  
			function testArray1(){
		            // 定义数组的两种方式
		            var a = new Array(1, 2, 3, 4, 5);
		            var b = [1, 2, 3, 4, 5];
		            var c = [1, 2, 3, 4, 5];
		            console.log(a);
		            console.log(b);
		            alert(a == b);   // false  
		            alert(c === b);  // false 无法比较??
		            // 多维数组的使用 , 若使用关联数组的方式,需要使用{ name1 : value1 , name2 : value2, .... }  这种方式定义
		            var arr1 = new Array([1, 2, 3], [4, 5, 6], [{test11: 11, test22: 22, test33: 33}, [44, 55, 66]]); // 多维数组混排
		            var arr2 = [
		                '000000',
		                {name: 'xiaoming', age: 25, sex: 0},
		                {name: '老王', age: 32, sex: 1},
		                {test1: 'test1', test2: 'test2', test3: 'test3', test4: 'test4'},
		                ['bbb1', 'bbbb2'],
		            ];
		            console.log(arr2);
		        }

 2. 数组操作(截取,插入,删除)
 
        /*---------1. 数组插入,删除-----------*/
        var arr = ["php", "java", "javascript"];
        console.log(arr);
        var s = arr.splice(1, 1);  // 从第一项开始删除 1项
        console.log(s, arr); // ["java"] ["php", "javascript"]
        var arr = ["php", "java", "javascript"];
        var s = arr.splice(0, 0, "asp", "C#");  // 在数组起始位置插入2项
        console.log(s, arr);  // [] ["asp", "C#", "php", "java", "javascript"]

        var arr = ["php", "java", "javascript"];
        var s = arr.splice(1, 2, "asp", "C#");  // 从第一项开始,删除2项再插入2项
        console.log(s, arr);  //  ["java", "javascript"] ["php", "asp", "C#"]

        /*------2. 数组截取-------*/
        var arr = ["asp", "C#", "php", "java", "javascript"];
        var s1 = arr.slice(0, 3);
        var s2 = arr.slice(3, 5);
        console.log(s1, s2); // ["asp", "C#", "php"] ["java", "javascript"]
 
 
###6. js 获取当前页面的链接

    console.log(window.location.href);  // 当前页面完整链接
    console.log(window.location.host);   // 当前页面 域名
    console.log(window.location.port);    // 端口号
    console.log(window.location.pathname);  // 文件相对根目录的路径 
    console.log(window.location.protocol);   // 获取协议 如 http: 
    console.log(window.location.search);   // get参数部分
    console.log(window.location.hash);   // #号的内容


###7. js window
	
  - window.open(URL,name,features,replace)
     -  window.open('/test.php','test','fullscreen=1'); // 打开一个全屏的新窗口
     - 	window.open('/test.php','test','height=300, width=300, top=0, left=400');
  - 	window.opener.location.href='http://www.baidu.com'; // 打开本窗口的父窗口跳转至 百度
  - 	在应用有frameset或者iframe的页面时，parent是父窗口，top是最顶级父窗口（有的窗口中套了好几层frameset或者iframe），self是当前窗口， opener是用open方法打开当前窗口的那个窗口。



###8. js 判断是否为微信浏览器

	function isWeiXin(){  // 判断是否为微信浏览器
		var ua = window.navigator.userAgent.toLowerCase(); 
		if(ua.match(/MicroMessenger/i) == 'micromessenger'){ 
			return true; 
		}else{ 
			return false; 
		} 
	}

###9. JS 闭包
 - 函数的闭包(closure)，可以让匿名函数立即被执行（最后面的那对括号就是让上面定义的匿名函数立即执行的秘密）
 - 闭包的写法
	- 写法1 : 最后那对括弧必须使用, 否则不会执行, 而且这个括号里可以传递参数进去,包括window, jquery 等变量,见写法2
	
		 	(function(){
	        	var str1="I am string 1";
	        	console.log(str1); 
	    	})();
	    	//console.log(str1); // 在这里的 str1 是未定义的 
	- 写法2 :
	
		     var globalData = [{key:1,name:'Li Si'},{key:2,name:'Wang Wu'}];
		     (function(window,$,data){
				var _str = 'private variable "_str"';
				function funTest(t) {   
		            console.log(t + '||' + _str);
		        }
				funTest('ttt');	  // 这里可以用直接调用闭包里的函数
				console.log(window.location.href); 
		        console.log(data); // 这里的data 就是 闭包外定义的 globalData
		     })(window,jQuery,globalData);  // 这里可以将global变量传递到闭包内使用
	- 写法3 :
		
		    var myWin = window;
			!function (myWin){
				console.log(myWin.location.href);
			}(myWin); // 这里可以定义闭包并立即执行
		
			window.App = window.App || {
				test1:{
					data:[1,2,3,4,5],
				},
				fun1:function(){
					alert('I am a function in App');
				}
			}
			console.log(window.App);
			window.App.fun1();

 - 闭包有以下几个优势或特点：
	- 减少了全局变量的个数，可以有效减少命名冲突,原因是包在里面的变量对于外面来说是不可见的，他们的作用域近局限在匿名函数的函数体内
	- 这种方式可以保存闭包外面的变量的状态，这个特点还是举个例子比较易懂：
		- test1 : 函数内部使用闭包,两次alert 都是1

				function fn() {
					for(var i=0 ; i<2; i++) {
					//(function(){
						var backup = i;
						setTimeout(function() {
							alert(backup);
						}, 2000);
					//})();
					}
				} 
				fn();
		- test2 : 函数内使用闭包,此时才能分别alert出 0 和1 [闭包引用的是父函数范围内的最终值]
		
				function fn() {
					for(var i=0 ; i<2; i++) {
						(function(){
							var backup = i;
							setTimeout(function() {
								alert(backup);
							}, 2000);
						})();
					}
				} 
				fn();

###10. 


1. A
2. B
3. C
 
4. D

		<script>
			console.log('aaaaa');
			alert(11111);
		</script>




<link href="./assets/css/style.css" rel="stylesheet">
<script type="text/javascript" src="./assets/js/jquery.js"></script>
<script type="text/javascript" src="./assets/js/codeToggle.js"></script>
<script type="text/javascript">
    //alert('tttttt');
    console.log(11111);
</script>