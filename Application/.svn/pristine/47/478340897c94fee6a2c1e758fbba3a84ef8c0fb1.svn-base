<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>消息</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/tclist.css" rel="stylesheet">
   
    <script>    	
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
    <style type="text/css">
    	.confirm{
    		display: block;
    		
    	}
    	.mask{
    		display: block;
    	}
    </style>

</head>    
	<body>
		<div class="tc-box" id="tmlist" v-cloak>
			<div class="tc-mode" v-if='tab==1'>
				<div class="tc-list" v-for="(item,index) of campusArr" :key="item.userid">
					<div class="tc-txt">
						<p>教师名称：{{item.name}}</p>
						<p>教师职称：{{item.teacherzc}}</p>
						<p>联系电话：{{item.mobile}}</p>
						<p>管理类型：{{item.powertype}}</p>
						<p>账户是否锁定：<span class="link-switch" :class="{'open':item.status}" @click="dostatus(item.userid,index,item.status)"><i></i></span></p>
					</div>
					<div class="tc-btn-box">
						<button class="tc-btn1" @click="tinfo(index)">查看详情</button>
						<button class="tc-btn2" @click="dels(1,item.userid)">删除</button>
					</div>
				</div>
			</div>
		
				
			<div class="tc-mode" v-if='tab==2'>
				<div class="tc-details">
					<div class="tc-img">
						<img :src="thead">
					</div>
					<div class="tc-details-info">
						<p>教师名称：{{name}}</p>
						<p>教师职称：{{teacherzc}}</p>
						<p>联系电话：{{mobile}}</p>
						<P>电子邮箱：{{email}}</P>
						<p>老师账号：{{username}}</p>
						<p>管理员类型：{{powertype}}</p>
						<p>所在地区：{{address}}</p>
						<p>教师简介：{{shortIntro}}</p>
						
					</div>
				 <div class="tc-btn-box tc-btn-box1">
				 	<button class="tc-btn1" @click="tabs()" >关闭</button>
				 	<button class="tc-btn2" @click="dels(1,userid)">删除</button>
				 </div>
				</div>
			</div>
			<div class="mask" v-if="del==1" ></div>
		
			<div class="confirm" id="confirm" v-if="del==1" >
				<div class="title">确认删除吗</div>							
				<div class="item-b">
					<div class="item-inner" @click="dels(2)">取消</div>
					<div class="item-inner active" @click="deluser(userid)">确认</div>
				</div>
			</div>
		</div>
		
		
		
		
	</body>
	
	<script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
	<script>
		module.add('tmlist',{
			el:'#tmlist',
			data:{			
		 		campusArr:[],
		 		jsonUrl:uoot + 'Json/index.php', 	
		 		maxPerpage:5,
		 		p:1,
		 		tab:1,
		 		name:'',
		 		teacherzc:'',
		 		mobile:'',
		 		email:'',
		 		username:'',
		 		powertype:'',
		 		address:'',
		 		shortIntro:'',
		 		del:0,
		 		userid:0,
		 		thead:''
			},
			created:function(){
		 		var that = this;
		   		that.getdata() 
		   		$_monitor.scroll.bottom(window,function(){
					that.getdata()
				})
		 		
		 	},
			
			methods:{
				getdata:function(){
					var that = this;
					var newData = {}
					 newData.maxPerpage = this.maxPerpage;
						newData.p = that.p;
			 			$post(that.jsonUrl+'?act=Microportal.teacherList',newData,function(res){
			 				
			 				console.log(res)
			 				//如果没有数据的话
			 				if(res.teacherList.page.total_pages==0){
			 					that.loadMoreFlag = false;
			 					return false
			 				}
			 				var datas = res.teacherList.list;
			 				var datalength = datas.length;
			 				
			 				for(var i=0;i<datalength;i++){
			 					that.campusArr.push(datas[i])
			 				}
			 				that.p++;
			 				if(datas<that.maxperpage || datas==0){
			 					that.loadMoreFlag = false;
			 					return false
			 				}
			 				
			 			
			 			},'json')	
		 			},
		 			dostatus:function(userid,index,statu){
			 			var that = this;
						var newData = {}
						newData.userid = userid;
						if(statu){
							newData.status = 1;
						}else{
							newData.status = 0;
						}
			 			$post(that.jsonUrl+'?act=WeChat.editstatus',newData,function(res){
			 				var data = that.campusArr;
			 				if(statu){
								data[index].status  = false;
							}else{
								data[index].status  = true;
							}
			 			},'json')	
		 			},
		 			tinfo:function(index){
		 				var data = this.campusArr;
		 				this.name=data[index].name,
				 		this.teacherzc=data[index].teacherzc,
				 		this.mobile=data[index].mobile,
				 		this.email=data[index].email,
				 		this.username=data[index].username,
				 		this.powertype=data[index].powertype,
				 		this.address=data[index].address,
				 		this.shortIntro=data[index].shortIntro,
				 		this.tab = 2;
				 		this.userid = data[index].userid;
				 		this.thead  = data[index].headpic;
		 			},
		 			tabs:function(){
		 				this.tab = 1;
		 			},
		 			dels:function(i,userid){
		 				this.del = i;
		 				this.userid = userid;
		 			},
		 			deluser:function(userid){
		 				var that = this;
						var newData = {}
						newData.userid = userid;
			 			$post(that.jsonUrl+'?act=WeChat.deluser',newData,function(res){
							window.location.reload();
			 			},'json')	
		 			}
		 		},
		 		

		
			
		})
		




	module.import('tmlist')
	
		

	</script>
</html>
