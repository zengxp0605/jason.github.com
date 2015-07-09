/**
 * 定义操作的父类
 */
function Oper(){
	this.save = function(){
		//$.post('/path/to/file', param1: 'value1', function(data, textStatus, xhr) {
			/*optional stuff to do after success */
			console.log(111);
		//},'json');
	};
	this.start = function(){};
	this.end = function(){
		console.log('global end');
	};
}

/**
 * 第一步
 */
function First(){
	Oper.call(this);
	this.strat = function(){
		console.log('First start');
	};
}

First.prototype = Object.create(Oper.prototype);
First.prototype.constructor = Oper;

var first = new First();
first.end();