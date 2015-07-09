var VoteOper = {
	isPublic:0,
	voteId:0, // 第一次点击第一步的'下一步'后保存一条数据,并获取该条数据的id
	step:1,//当前所在步骤
	changeCurrentStep:function(){ // 改变当前操作步骤
		this.step = $('div .cur').index() + 1;
	},
	init:function(){
		// 初始化操作
		this.first.start();
	},
	save:function(){ // 通过 step 的值判断是保存哪一步数据
		var postData = $('form').eq(this.step).serializeArray();
		postData.step = this.step;
		postData.vote_id = this.voteId;
		$.post('/Vote/save',postData,function(data){
			if(data && data.status ==1){
				//code
			}else{
				alert(data.info ? data.info : '系统繁忙,请稍后再试!');
			}
			console.log(data);
		},'json');
	},
	prev:function(){ // 跳回到上一步操作,保存当前步骤的数据
		this.save();
		this.changeCurrentStep();
	},
	// 第一步操作
	first:{
		start:function(){
			this.initBind();
		},
		initBind:function(){

		},	
		next:function(){
			VoteOper.save();
			VoteOper.isPublic = $('checked').val();
			VoteOper.second.start();
		},
	},
	//第二步操作
	second:{
		start:function(){
			VoteOper.changeCurrentStep();
			this.initBind();
		},
		initBind:function(){

		},
		next:function(){
			VoteOper.save();
			VoteOper.third.start();
		},
		move:function(){ //上移,下移操作

		},
		addOption:function(){ // 添加选项

		},
		delOption:function(){ // 删除选项

		},
	},
	//第三步操作
	third:{
		start:function(){
			VoteOper.changeCurrentStep();
			this.initBind();
		},
		initBind:function(){

		},
		end:function(){ //完成
			VoteOper.save();
		},
		viewDemo:function(){ //预览
			VoteOper.save();
		}
	},
};
