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

 2. 数组操作(截取,插入,删除)  arrayObject.slice(start,end)
 	- 截取,插入,删除
 	
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
	- 数组添加,删除元素
   		
		    var arr = [1, 2, 3];
	        arr.push(4); // 
	        console.log(arr); //  [1, 2, 3, 4]
	        arr[arr.length] = 5;  // 等价与  arr.push(5)
	        console.log(arr); //  [1, 2, 3, 4, 5]
	        arr.unshift(0); // 添加首位的元素
	        console.log(arr); //  [0, 1, 2, 3, 4, 5]
	        arr.shift(0)// 删除首个元素
	        console.log(arr); //[1, 2, 3, 4, 5]
	        arr.pop(5);//删除最后一个元素
	        console.log(arr); // [1, 2, 3, 4]
	        arr.length = arr.length - 1; //删除最后一个元素
	        console.log(arr); //   [1, 2, 3]
			
			delete arr[1]; //  arr[1] === undefined

 3. 通过 join 自定义一个repeatString 的方法
    
        function repeatString(str, n) {
          return new Array(n + 1).join(str);
        }
        console.log(repeatString('a', 5));  // aaaaa
        console.log(repeatString('Hi', 3)); // HiHiHi
 4. 其他方法
    - reverse

      		var arr = [1, 2, 3];
        	console.log(arr.reverse()); // [3, 2, 1]
        	console.log(arr);  // [3, 2, 1]
 
	- sort

			    arr = [13, 49, 25, 5, 0, 34, 51];
		        console.log(arr.sort()); // 并不是按照数字的大小排序的 结果为:[0, 13, 25, 34, 49, 5, 51]
		        // 要按数字大小排序,需要传递一个比较函数
		        arr.sort(function (a, b) { // 正序
		          return a - b;
		        });
		        console.log(arr); //  [0, 5, 13, 25, 34, 49, 51]
		        arr.sort(function (a, b) { // 倒序
		          return b - a;
		        });
		        console.log(arr); //  [51, 49, 34, 25, 13, 5, 0]
	- sort 排序对象
	
		        arr = [
		          {name: 'xiaomi', age: 39},
		          {name: 'laowang', age: 41},
		          {age:23, name:'xiaoli'},
		        ];
		        arr.sort(function(a,b){
		            return a.age - b.age;
		        });
		        arr.forEach(function(item,index,arr){
		            console.log(item.name + '-' + item.age);
		        });
		        //result
		        //xiaoli-23
		        //xiaomi-39
		        //laowang-41
	- concat 合并数组 (生成副本)
	
		    var arr = [1, 2, 3];
	        console.log(arr.concat(4, 5)); //[1, 2, 3, 4, 5]
	        console.log(arr);  // 原数组未改变 [1, 2, 3]
	
	        console.log(arr.concat([10, 11], 13)); //  [1, 2, 3, 10, 11, 13]
	        console.log(arr.concat([14, [15, 16]])); //  [1, 2, 3, 14, [15, 16]]
	- splice 数组拼接,删除
	
		    var arr = [1, 2, 3, 4, 5];
	        console.log(arr.splice(2)); // [3, 4, 5]
	        console.log(arr);  // 原数组被改变  [1, 2]
	
	        arr = [1, 2, 3, 4, 5];
	        console.log(arr.splice(2, 2)); //  [3, 4]
	        console.log(arr);  // [1, 2, 5]
	
	        arr = [1, 2, 3, 4, 5];
	        console.log(arr.splice(1, 2, 'a', 'b', 'c')); //  [2, 3]
	        console.log(arr);  //  [1, "a", "b", "c", 4, 5]
	- slice  数组截取
	
		    var arr = [1, 2, 3, 4, 5];
	        console.log(arr.slice(2, 2)); // []
	        console.log(arr.slice(2, 3)); // [ 3 ]
	        console.log(arr.slice(0, 3)); //[1, 2, 3]
	        console.log(arr.slice(0, -1)); // [1, 2, 3, 4]
	        console.log(arr.slice(-4, -3)); // [2]
	        console.log(arr.slice(-3, -4));  // []
    - map  数组映射
    
			var arr = [1, 2, 3, 4, 5];
	        var brr = arr.map(function (x) {
	          return x + 10;
	        });
	        console.log(brr);  //[11, 12, 13, 14, 15]
	        console.log(arr); // 原数组未改变 [1, 2, 3, 4, 5]
   - filter 数组过滤
   
		    var arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	        var brr = arr.filter(function (x, index) {
	          return index % 3 === 0 || x >= 8;
	        });
	        console.log(brr);  // [1, 4, 7, 8, 9, 10]
	        console.log(arr); // 原数组未改变 [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
   - 数组判断: every (每个值都要符合) & some (一个值符合即可)  

		    var arr = [1, 2, 3, 4, 5];
	        var _re = arr.every(function (x) {
	          return x < 10;
	        });
	        console.log(_re);  // true
	        var _re = arr.every(function (x) {
	          return x < 3;
	        });
	        console.log(_re);  // false 
	        //=================================
	        var arr = [1, 2, 3, 4, 5];
	        var _re = arr.some(function (x) {
	          return x === 3;  // 只要有一个值符合即返回 true
	        });
	        console.log(_re);  // true 
	        var _re = arr.some(function (x) {
	          return x === 50;
	        });
	        console.log(_re);  // false 

    - reduce 将数组聚合成为一个结果,如数组求和,求最大值
    
		        var arr = [1, 2, 3, 4, 5];
		        var sum = arr.reduce(function (x, y) {
		          console.log(x + '||' + y);
		          return x + y;
		        }, 0); // 不改变原来的数组
		        console.log(sum);
			        //result
			        //0||1
			        //1||2
			        //3||3
			        //6||4
			        //10||5
			        //15
	
		        var arr = [15, 21, 3];
		        var max = arr.reduce(function (x, y) {
		          console.log(x + '|' + y);
		          return y > x ? y : x;
		        }); // 不改变原来的数组
		        console.log(max);
			        //result
			        //15|21
			        //21|3
			        //21
   - indexOf  &  lastIndexOf (从右向左查找) 数组检索
	
			    var arr = [1, 2, 3, 2, 1];
		        console.log(arr.indexOf(2)); // 1
		        console.log(arr.indexOf(99)); // -1
		        console.log(arr.indexOf(1, 2)); // 从第三个位置开始检索数字1出现的位置,输出 4
		        console.log(arr.indexOf(1, -3)); // 4
		        console.log(arr.indexOf(2, -1)); // -1
		        //===============================
		        console.log(arr.lastIndexOf(2)); // 3
	
   - isArray 判断是否为数组
	   
			    var arr = [1, 2, 3, 2, 1];
		        console.log(Array.isArray(arr)); // true
		        console.log(arr instanceof Array);  // true
		        console.log(({}).toString.apply(arr) === '[object Array]');  // true
		        console.log(arr.constructor === Array)  // true
  
   - 字符串当做数组处理
   
	   			var str = 'hello world';
		        console.log(str.charAt(0)); // h
		        console.log(str[1]);  // e
		
		        console.log(Array.prototype.join.call(str, '_')); //h_e_l_l_o_ _w_o_r_l_d
				console.log(Array.prototype.join(str, '_'));  // 这样调用无法实现!!!

 5. 数组遍历
    - forEach    
    
			arr = [
	          {name: 'xiaomi', age: 39},
	          {name: 'laowang', age: 41},
	          {age: 23, name: 'xiaoli'},
	        ];
	        arr.forEach(function (item, index, a) {
	          console.log(item.age + '|' + index + '|' + (a === arr));
	        });
	        //result
	        //39|0|true
	        //41|1|true
	        //23|2|true
	- for(var k in arr){}  这种方式不保证顺序!!
	- var i = 0; for(;i < arr.length;i++){} 
	
###6. js 获取当前页面的链接 url = http://192.168.0.57:8008/wx_sample?fromUser=11131&id=25#12/25

    console.log(window.location.href);  // 当前页面完整链接 http://192.168.0.57:8008/wx_sample?fromUser=11131&id=25#12/25

    console.log(window.location.host);   // 当前页面 域名  192.168.0.57:8008
    console.log(window.location.port);    // 端口号  8008
    console.log(window.location.pathname);  // 文件相对根目录的路径   /wx_sample
    console.log(window.location.protocol);   // 获取协议 如 http:   http:
    console.log(window.location.search);   // get参数部分    ?fromUser=11131&id=25
    console.log(window.location.hash);   // #号的内容		#12/25


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
 - 注意:滥用闭包会影响性能.变量得不到释放
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

###10. JS 操作 iframe

 - (1) 父窗口操作 iframe

 	- js 写法
 		
		document.getElementById('iframe').contentWindow //查找iframe加载的页面的window对象  
		document.getElementById('iframe').contentWindow.document //查找iframe加载的页面的document对象  
		document.getElementById('iframe').contentWindow.document.body //查找iframe加载的页面的body对象  
		document.getElementById('iframe').contentWindow.document.getElementById('icontent') //查找iframe加载的页面的id为icontent的对象  	
		document.getElementById('iframe').contentWindow.resizeImg(); // 调用iframe 页面中的方法,方法在iframe中执行		

 	- jquery
	
		$('#iframe').contents() //查找iframe加载的页面的document对象  
		$('#iframe').contents().find('body') //查找iframe加载的页面的body对象  
		$('#iframe').contents().find('body').find('#icontent') //查找iframe加载的页面的id为icontent的对象  

 - (2)  iframe 操作父窗口

	- js
	
		window.parent.document.getElementById('reply-form') //查找父页面中id为 reply-form 的对象  
		window.parent.toshow('ccccchild');   // 调用父页面中的 toshow() 方法
	- jquery
	
		var _commentBox = $('#reply-form',window.parent.document);  // 获取父窗口  $('#reply-form')

###11. JS 作用域
1. 定义的函数和变量会被前置     
   (1).

          function test(a, b) {
	          var c = 10;
	          var e = function _e() {};
	           (function y() {alert('yyy');});
	          var b = 20;
	        }
        // console.log(a);
        // console.log(b);
        //  console.log(c); // 这里输出 a b c 均会报错,这些变量为函数变量,不是全局变量,
        console.log(x);  // 这里调用x 不会报错,输出是x 为函数
        x();
        var x = 10;
        console.log(x);
        x = 20;
        function x() {alert(x)};  // 这里的function  函数声明会被前置处理,所以不会影响上一个语句的赋值
        console.log(x); // 这里输出的是20
        if (true) {
          var t1 = 1;
        } else {
          // 虽然这句没有执行,但是var 变量声明会被前置处理
          var t2 = 2;  // 这里如果不使用var关键字,则后面的 console.log(t2) 会报错
        }
        console.log(t1);
        console.log(t2); 
   
  (2). 直接用function 定义的函数 和var 定义的函数的区别

	    console.log(typeof func); //undefined
        console.log(typeof foo);  // 'function'
        //func(); // func函数使用var赋值的匿名函数,这里无法调用, 报错
        foo(); // 函数定义会被前置,这里可以直接调用
        var func = function () {
          alert('func');
        };
        function foo() {
          alert('foo1');
        }
        console.log(typeof func);  //'function'
        func();

2. 	this 关键字的调用  
             
	    function MyClass() {
          this.a = 37;
        }
        var o = new MyClass();
        console.log(o.a);  //37
        function C2() {
          this.a = 37;
          return {a: 38};
        }
        var o = new C2();
        console.log(o.a); //38

3.  arguments 的使用
	
	  	function foo(x, y, z) {
         // 'use strict';
          console.log(arguments.length); // 2  实参的个数
          console.log(arguments[0]); //1
          arguments[0] = 10;  // 如果使用严格模式,这里不会直接改变 x 的值
          console.log(x); //10 ;如果不使用严格模式, 改变了x 的值,x 和  arguments[0] 是绑定的关系,TODO 这里有问题!!!
          console.log(arguments[1]); // 2
          console.log(arguments[2]); // undefined
           console.log(arguments.callee);  // 严格模式时将会报错, 不是严格模式则输出  foo
        }
        foo(1, 2);
        console.log('foo.name = ' + foo.name); // foo
        console.log('foo.length = ' + foo.length); //3 形参的个数

4. 属性标签

	 	var Person = {};
        Object.defineProperty(Person, 'name', {
          configurable: true, // 是否可以delete 
          writable: true, // 是否可以改写
          enumerable: false, // 是否枚举, false 时用in 检测到,
          value: 'Tom'
        });
        console.log(Person.name);
        Person.name = 1;
        console.log(Person.name);// writable 为true 时输出1, false 时输出 Tom
        // console.log(delete Person.name);
        console.log(Person);  // 这里不会输出name 属性
        console.log('name' in Person);  // true
        for (var k in Person) {  // 这里遍历不到 name 属性
          console.log('key = ' + k);
        }
        console.log('---------分隔符1---------');
        console.log(Object.getOwnPropertyDescriptor(Person, 'name'));
        // Object { configurable=true,  enumerable=false,  value=1,  writable = true}
        console.log(Object.getOwnPropertyDescriptor(Person, 'age')); // undefined
        Person.age = 26; // 直接赋值创建的属性,默认的标签为 true
        console.log(Object.getOwnPropertyDescriptor(Person, 'age'));
        // Object { configurable=true,  enumerable=true,  value=26,  writable=true}
        Object.defineProperty(Person, 'county', {value: 'China'});
        console.log(Object.getOwnPropertyDescriptor(Person, 'county')); // 不设置属性标签则默认为false
        // Object { configurable=false,  enumerable=false,  value=China,  writable=false}
        console.log(Object.keys(Person)); // ['age'];

5. 原型链

	    function Foo() {
          this.func = function () {
            alert('foo -- func');
          }
        }
        Foo.prototype.x = 1;
        var obj = new Foo();
        console.log(obj.x); //  这里的x 属性是继承的Foo 对象的原型链上的属性
        console.log(obj.hasOwnProperty('x'));  // false
        console.log(obj.__proto__.hasOwnProperty('x'));  // __proto__ 获取到的是原型, 输出 true
        obj.func();
6. 对象标签
   (1). proto

		console.log(Object.prototype);
        console.log(Object.__proto__);	

   (2). class
		
		var toString = Object.prototype.toString; //将函数定义一个简短的名称
        console.log(Object.prototype.toString(null));  // [object Object]
        console.log(Object.prototype.toString.call(null)); //[object Null]
        console.log(typeof toString);
        function getType(o) {
          return toString.call(o).slice(8, -1);
        }
        console.log(toString.call(null)); //[object Null]
        console.log(getType(null)); // Null
        console.log(getType(undefined)); //  Undefined
        console.log(getType(1)); //  Number
        console.log(getType(new Number(1))); // Number
        console.log(getType(true)); //  Boolean
        console.log(getType(new Boolean(true))); //  Boolean
   (3). extentsible 是否可以扩展
	
	    var obj = {x: 1, y: 2};
        console.log(Object.isExtensible(obj));  //true
        Object.preventExtensions(obj);
        console.log(Object.isExtensible(obj));  //false

7. 序列化对象



8. 整理的一些代码

		// 死链的图片统一替换为自己的图片
			$('img').on('error', function () {
				$(this).prop('src', '/test2/0.jpg');
			});
	
			// 定义自己的伪类选择器
			$.extend($.expr[':'], {
				moreThen100px: function(a) {
					return $(a).width() > 100;
				}
			});
			$('.box:moreThen100px').click(function() {
     		 	// creating a simple js alert box
     		 	alert('The element that you have clicked is over 100 pixels wide');
     		 });
	
		// 关闭浏览器时发送请求
		window.addEventListener('unload', function(event) {
		  navigator.sendBeacon('/collector', data);
		});
		
		//获取url GET 参数
		function getQueryObject(url) {
		    url = url == null ? window.location.href : url;
		    var search = url.substring(url.lastIndexOf("?") + 1);
		    var obj = {};
		    var reg = /([^?&=]+)=([^?&=]*)/g;
		    search.replace(reg, function (rs, $1, $2) {
		        var name = decodeURIComponent($1);
		        var val = decodeURIComponent($2);                
		        val = String(val);
		        obj[name] = val;
		        return rs;
		    });
		    return obj;
		}
	
	

9. end
10. 
	
			

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