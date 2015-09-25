/*********************************
IScroll 上拉分页 v1.0
Author: Jason Zeng
Date: 2015-8-31 
**********************************/
/*--demo--*/
/*
	PageSetting.init({
		url:'page.php',
		firstPage:false,
		downBtn:true,
		mouseWheel:true,
	});
*/
var PageSetting = {
	/*-----------下面的参数通过 PageSetting.init() 传config 设定-------------*/
	url:'', // ajax 请求的url,
	wrapperId:'wrapper',  // 容器id
	firstPage:true, // 是否需要使用ajax加载第一页
	downBtn:true,   // 是否需要下拉刷新的功能
	mouseWheel:false,// 是否支持鼠标滚动
	/*-----------以下参数无需设置---------*/
	myScroll:{},
	currentPage:1,
	pullDownEl:{},
	pullUpEl:{},
	downHolding:false,
	upHolding:false,
	ajaxHolding:false,
	isStop:false,
	init:function(config){  // 初始化
		if(!config || !config.url){
			throw new Error("Init arguments is lost!");
			return;
		}
		this.url = config.url;
		if(typeof config.firstPage !== 'undefined')
			this.firstPage = config.firstPage;
		//this.currentPage = this.firstPage ? 1 : 2; // 不加载首页则从第二页开始加载
		this.pullDownEl = document.getElementById('pullDown');
		this.pullUpEl = document.getElementById('pullUp');	
		if(config.downBtn === false && this.pullDownEl){
			this.pullDownEl.style.display = 'none';
		}
		this.loaded();
		document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
	},
	initPullLabel:function (){  // 初始化标签文本
		if(PageSetting.pullDownEl){
			PageSetting.pullDownEl.className = '';
			PageSetting.pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
		}	
		PageSetting.pullUpEl.className = '';
		PageSetting.pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
	},
	loaded:function  () {
			var pullDownOffset = 0; //顶部最小的高度
			if(this.pullDownEl)
				pullDownOffset = this.pullDownEl.offsetHeight;
			var pullUpOffset = this.pullUpEl.offsetHeight;
			this.myScroll = new IScroll('#' + this.wrapperId, { 
				probeType: 3, 
				mouseWheel: PageSetting.mouseWheel,
				startY:-pullDownOffset,
			});
			this.initPullLabel();
			this.myScroll.on('scroll', function(){
				if (PageSetting.pullDownEl && !PageSetting.downHolding && this.y > 3) {
					PageSetting.pullDownEl.className = 'flip';
					PageSetting.downHolding = true;
					PageSetting.pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手刷新...';
				} else if (!PageSetting.upHolding && this.y < (this.maxScrollY - 5)) {
					PageSetting.pullUpEl.className = 'flip';
					PageSetting.upHolding = true;
					PageSetting.pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新...';
				}else if(!PageSetting.istoTop && this.y > -pullDownOffset){
					PageSetting.istoTop = true;
					console.log(this.y);
				}
			});
			this.myScroll.on('scrollEnd',  function(){
				if (PageSetting.pullDownEl && PageSetting.downHolding ) { // 下拉刷新第一页
					PageSetting.pullDownEl.className = 'loading';
					PageSetting.pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';	
					PageSetting.currentPage = 1;
					PageSetting.loadFirstPage(function(){
						PageSetting.myScroll.scrollTo(0,-pullDownOffset);//重新回到顶部
					});	
				} else if(!PageSetting.isStop && PageSetting.upHolding) {
					PageSetting.pullUpEl.className = 'loading';
					PageSetting.pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';	
					PageSetting.loadNextPage();	
				}else if(PageSetting.istoTop){
					PageSetting.istoTop = false;
					PageSetting.myScroll.scrollTo(0,-pullDownOffset,100); // 回滚到隐藏下拉
				}
			});
			this.myScroll.on('refresh',  function(){
				PageSetting.downHolding =false;PageSetting.upHolding = false;
				console.log('refresh');
				setTimeout(PageSetting.initPullLabel,100);
			});
			if(this.firstPage){
				this.loadFirstPage(function(){
				});
			}
		},
		loadFirstPage:function (callback){
			this.currentPage = 1;
			this.isStop = false;
			this.pullUpEl.querySelector('.pullUpIcon').style.display = '';
			this.pullUpEl.className = '';
			this.loadNextPage(callback);
		},
		loadNextPage:function (callback){
			if(PageSetting.ajaxHolding === true || !PageSetting.url) return;
			PageSetting.ajaxHolding = true;
			var _data = {page:PageSetting.currentPage};
			$.post(PageSetting.url,_data,function(rsp){
				if(rsp && rsp.status ==1){
					if(rsp.data && rsp.data.rows.length > 0){
						var _html = PageSetting.getHtml(rsp.data.rows);
						var _list = document.getElementById('thelist');
						if(PageSetting.currentPage == 1){
							_list.innerHTML = _html;
						}else{
							_list.innerHTML = _list.innerHTML + _html;
						}
						if(callback)
							callback();
						PageSetting.myScroll.refresh();	
					}else{
						PageSetting.isStop = true;
						PageSetting.pullUpEl.querySelector('.pullUpIcon').style.display = 'none';
						PageSetting.pullUpEl.querySelector('.pullUpLabel').innerHTML = '没有更多了';	
					}
					++PageSetting.currentPage;
				}else{
					alert('加载页面异常');						
				}
				PageSetting.ajaxHolding = false;
			},'json');
		},
		getHtml:function (rows){ // 此方法需要自己实现
			var _html = '';
			for(var k in rows){
				_html += '<li>' + rows[k] +'</li>';
			}
			return _html;
		},
	}

