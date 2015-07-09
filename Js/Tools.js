 /**
  * Js 常用操作工具类[基于Jquery]
  * Author: Jason Zeng
  * Date: 2015-7-9 
  */
  var Tools = {
  	version: '1.0.0',
  	$: function(obj) {
  		return document.getElementById(obj);
  	},
  	isUndefined: function(variable) {
  		return typeof variable == 'undefined' ? true : false;
  	},
  	isArray: function(o) {
  		return Object.prototype.toString.call(o) === '[object Array]';
  	},
  getDiffNum: function(ary, r, showAry) {//获取一个值不相等的随机数组元素 ary 数组 r:取值范围
  	var _temp = Math.floor(Math.random() * r);
  	if (Tools.arraySearch(ary, _temp) == -1 && !Tools.isUndefined(showAry[_temp]))
  		return _temp;
  	return Tools.getDiffNum(ary);
  },
  isIE: function() {
  	return -[1, ] ? false : true;
  },
  strlen: function(str) {
  	return (Tools.isIE() && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
  },
  getExt: function(path) {
  	return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
  },
  getParameter: function(param) { // 获取get参数
  	if (window.location.href.indexOf('?') != -1) {
  		var _href = window.location.href.split('?');
  		var reg = new RegExp('(^|&)' + param + '=([^&]*)(&|$)', 'i');
  		var r = _href[1].match(reg);
  		if (r != null)
  			return decodeURIComponent(r[2]);
  	}
  	return null;
  },
  unique: function(data) {//高效清除数组中相同项
  	data = data || [];
  	var a = {}, v = null;
  	for (var i in data) {
  		v = data[i];
  		if (typeof a[v] == 'undefined')
  			a[v] = 1;
  	}
  	data.length = 0;
  	for (var i in a) {
  		data[data.length] = i;
  	}
  	return data;
  },
  checkBoxNeedOne: function(d) {
  	var _b = false;
  	$(d).each(function() {
  		if ($(this).prop('checked'))
  			_b = true;
  	});
  	return _b;
  },
  checkSlt: function(o, d) {
  	var _o = o.split(',');
  	$(d).each(function() {
  		if (Tools.arraySearch(_o, $(this).val()) != -1)
  			$(this).prop('checked', true);
  	});
  },
  initUpload:function(id,obj){
  	var _url = obj.url ? obj.url :'/Upload/upload';
  	$('#' + id).change(function(){
  		Tools.upload(id,_url);
  	});
  },
  upload: function(id,url) { // html5 方式上传文件
  	var data = new FormData();
  	data.append('file', $('#' + id)[0].files[0]);
  	$.ajax({
  		url: url,
  		type: 'POST',
  		data: data,
        processData: false, // 告诉jQuery不要去处理发送的数据  
        contentType: false,  // 告诉jQuery不要去设置Content-Type请求头  
        success:function(data){
        	//console.log(arguments);
        	console.log(data);
        },
        error:function(data){
        	console.log(data);
        }
    });
  },
  delFile: function(uploadType, uploadName) {
  	Tools.alert.locking.confirm(null, '您确定删除上传文件吗？', function() {
  		$.post(PageAction.handlerRoot + 'handler/Admin.System.DelFile', {
  			"delFileName": $('#' + uploadName).val(),
  			"uploadType": uploadType
  		}, function(data) {
  			if (data.status == 'ERROR') {
  				Tools.alert.locking.alert('error', '系统繁忙，请稍候再试');
  			}
  			else {
  				if (uploadType == 'img') {
  					$('#return_' + uploadName).html('<img src="' + PageAction.view + 'images/no_pic.jpg">');
  				}
  				else {
  					$('#return_' + uploadName).html('');
  				}
  				$('#' + uploadName).val('');
  				$('#' + uploadName + '-attachment').val('');
  				$('#add_' + uploadName).show();
  				$('#del_' + uploadName).hide();
  				Tools.alert.locking.remove();
  			}
  		}, 'json');
  		return false;
  	});
  },
  delMultipleImg: function(delImgSrc) {
  	Tools.alert.locking.confirm(null, '您确定这张图片吗？', function() {
  		$.post(PageAction.handlerRoot + 'handler/Admin.System.DelMultipleFile', {
  			"delImgSrc": delImgSrc
  		}, function(data) {
  			if (data.status == 'SUCCESS') {
  				$('#multiple_img_' + delImgSrc.replace(/[,\.]/g, '')).empty().remove();
  				Tools.alert.locking.remove();
  			}
  			else {
  				Tools.alert.locking.alert('error', '系统繁忙，请稍候再试');
  			}
  		}, 'json');
  		return false;
  	});
  },
  checkNull: function(id, str) {
  	var _temp = $('#' + id);
  	if ($.trim(_temp.val()).length == 0) {
  		Tools.alert(str, function() {
  			_temp.focus();
  		});
  		return false;
  	}
  	return true;
  },
  checkDigit: function(id, str) {
  	var _temp = $('#' + id);
  	if (!/^[0-9]+$/.test($.trim(_temp.val()))) {
  		Tools.alert(str, function() {
  			_temp.focus();
  		});
  		return false;
  	}
  	return true;
  },
  compare: function(id, obj, str) {
  	_temp = $('#' + id);
  	if ($.trim(_temp.val()) == obj) {
  		Tools.alert(str, function() {
  			_temp.focus();
  		});
  		return false;
  	}
  	return true;
  },
  switchDiv: function(li, sltClass, switchObj) {
  	$(li).each(function(i) {
  		$(this).click(function() {
  			$(this).addClass(sltClass).siblings().removeClass(sltClass);
  			$(switchObj).eq(i).show().siblings(switchObj).hide();
  		});
  	});
  },
  alert:function(str,callback){
  	window.alert(str);
  	if(callback)
  		callback();
  }
};

String.prototype.trim = function() {
	return this.replace(/(^\s*)|(\s*$)/g, '');
}
/*** 统计指定字符出现的次数 ***/
String.prototype.occurs = function(ch) {
  // var re = eval('/[^' + ch + ']/g');
  // return this.replace(re, "").length;
  return this.split(ch).length - 1;
}
/*** 检查是否由纯数字组成 ***/
String.prototype.isDigit = function() {
	var s = this.trim();
	return (s.replace(/\d/g, "").length == 0);
}
/*** 检查是否由数字字母和下划线组成 ***/
String.prototype.isAlpha = function() {
	return (this.replace(/[\w]/g, "").length == 0);
}
/*** 检查是否为数字 ***/
String.prototype.isNumber = function() {
	var s = this.trim();
	return (s.search(/^[+-]?[0-9.]*$/) >= 0);
}
/*** 返回字节数 ***/
String.prototype.lenb = function() {
	return this.replace(/[^\x00-\xff]/g, "**").length;
}
/*** 检查是否包含汉字 ***/
String.prototype.isInChinese = function() {
	return (this.length != this.replace(/[^\x00-\xff]/g, "**").length);
}
/*** 简单的email检查 ***/
String.prototype.isEmail = function() {
	var _regeMail = /^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/;
	return _regeMail.test(this);
}
/*** 简单的日期检查，成功返回日期对象 ***/
String.prototype.isDate = function() {
	var p;
	var re1 = /(\d{4})[年./-](\d{1,2})[月./-](\d{1,2})[日]?$/;
	var re2 = /(\d{1,2})[月./-](\d{1,2})[日./-](\d{2})[年]?$/;
	var re3 = /(\d{1,2})[月./-](\d{1,2})[日./-](\d{4})[年]?$/;
	if (re1.test(this)) {
		p = re1.exec(this);
		return new Date(p[1], p[2], p[3]);
	}
	if (re2.test(this)) {
		p = re2.exec(this);
		return new Date(p[3], p[1], p[2]);
	}
	if (re3.test(this)) {
		p = re3.exec(this);
		return new Date(p[3], p[1], p[2]);
	}
	return false;
}
/*** 检查是否有列表中的字符字符 ***/
String.prototype.isInList = function(list) {
	var re = eval('/[' + list + ']/');
	return re.test(this);
}
