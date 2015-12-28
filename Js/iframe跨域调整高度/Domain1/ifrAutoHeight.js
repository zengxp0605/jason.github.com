// 计算页面的实际高度，iframe自适应会用到
function calcPageHeight(doc) {
  var cHeight = Math.max(doc.body.clientHeight, doc.documentElement.clientHeight);
  var sHeight = Math.max(doc.body.scrollHeight, doc.documentElement.scrollHeight);
  var height = Math.max(cHeight, sHeight);
  return height;
}
window.onload = function () {
  //判断是否属于后台的预览
  var isPview = false;
  var search = location.search.replace('?', '');
  if (search.split('=')[1] == 'pview') {
    isPview = true;
  }
  console.log('onload33', window.location.href);
  //创建一个iframe隐藏的,并且通过这个iframe 调整父iframe的高度
  var frameObj = document.createElement("iframe");
  frameObj.setAttribute("id", "third-ifr");
  frameObj.setAttribute("style", "display:none;");
  var height = calcPageHeight(document);
  // 预览使用后台的域名,否则使用前端的
  var _domain = isPview ? 'http://domain1.admin/' : 'http://domain1.com/';
  frameObj.setAttribute("src", _domain + 'innerIframe.html?height=' + height);
  document.body.appendChild(frameObj);
  console.log(document.documentElement.scrollHeight);
};

//alert('ifrAutoHeight.js');

		// 只能处理同域名的情况
		function iFrameAutoHeight(id) {
			var cwin =  document.getElementById(id);
			if (cwin && !window.opera){
			  console.log(cwin.contentDocument.body.offsetHeight);
			  if (cwin.contentDocument && cwin.contentDocument.body.offsetHeight){
				  console.log(111111,cwin.contentDocument.body.offsetHeight );
				cwin.height = cwin.contentDocument.body.offsetHeight + 20; //FF NS 
			  }else if (cwin.Document && cwin.Document.body.scrollHeight){
				  console.log(22);
				cwin.height = cwin.Document.body.scrollHeight + 10;//IE 
			  }
			   console.log('no 1');
			}else if (cwin.contentWindow.document && cwin.contentWindow.document.body.scrollHeight){
				console.log(33);
			  cwin.height = cwin.contentWindow.document.body.scrollHeight;//Opera 
			}
			
		}
