<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>我的分销</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/rely.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/microportal/index.css" rel="stylesheet">    
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	 
    <style>
		.collage-icon{
			width: 18px;
			height: 18px;
			line-height: 18px;
			text-align:center;
			background:rgba(0,0,0,.3);
			color: #fff;
			text-align: center;
			position: absolute;
			top: 5px;
			right: 5px;
			font-size: 12px;
			border-radius: 50%
		}
		.es span{
			color: #e64a3b;
		}
		.small-box{
			width: 50%;
			float: left;
		}
		.md-cross-btn{
			padding: 0 12px;
		    height: 32pxs;
		    border: 1px solid #37a7ed;
		    font-size: 14px;
		    color: #37a7ed;
		    line-height: 32px;
		    border-radius: 4px;
		    float: right;
            margin-right: 11%;
            background: #fff;
		}
		.dialog-tips {
		    position: fixed;
		    z-index: 100;
		    width: 120px;
		    padding: 20px;
		    white-space: normal;
		    background-color: #fff;
		    box-shadow: 0px 8px 15px 0 rgba(0, 0, 0, 0.1);
		    text-align: center;
		    background: rgba(33,33,33,.3);
		    color: #fff;
		    font-size: 14px;
		    border-radius: 5px;
		}
		.dialog-center {
		    top: 40%;
		    left: 50%;
		    margin-left: -75px;
		}
		.money-box{
			background: #fff;
		    margin-bottom: 10px;
		    height: 46px;
		    padding: 10px;
		    /*text-align: center;*/
		}
		.money-box div{
			float: left;
			margin-left: 34px;
		    font-size: 14px;
		    line-height: 49px;
		}
    </style>
</head>
<body>
	<div id="my-witharwal" v-cloak> 
		<!--<div class="money-box">
			<div>
				总计：<span style="color: red;font-size: 20px;">{{settled1}}</span>元
			</div>
			<div id="">
				可结算：<span style="color: #37a7ed;font-size: 20px;">{{settled2}}</span>元
			</div>
		</div>-->
		<template v-if="renderFlag">
			<template v-if="datalist.length>0">
				
				<div class="md-info md-info-def" style="padding: 0px;margin-top:0px;">
					<div class="md-item-wrap">
						
						<div class="md-item line" v-for="item of datalist" style="padding: 10px;">
							<div class="md-time">
								日期：{{item.adddate}}
							</div>
							<div>提现金额：<span style="color: red;">{{item.cmoney}}</span></div>
							<div class="md-name">备注：<span style="color: lightslategray;font-size: 10px;">{{item.mark}}</span></div>
						</div>
						
					</div>
				</div>
	
				
			</template>
			<template v-else><div class="nodata">暂无数据</div></template>
			<div class="nomore" v-show="limit">我们是有底线的~</div>
			<div class="loadings" v-show="loadingFlag"></div>		
		</template>
	</div>
	 <script src="<?php echo UOOT ?>Public/common/js/MicroPortal.js"></script>

     <script type="text/javascript">
      
  function $post(_url,data,fn,type){
    var xhr = new XMLHttpRequest();
    /**
     * @method open
     * @for xhr
     * @param {String}  [请求类型，get or post]
     * @param {String}  [请求url]
     * @param {Boolean} [是否异步请求] 
     */
    xhr.open("POST", _url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // 添加http头，发送信息至服务器时内容编码类型
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {
        switch (type){
          case "json":
            typeof fn === 'function' && fn.call(this, $json(xhr.responseText,'parse'))
            break;
          default:
            typeof fn === 'function' &&  fn.call(this, xhr.responseText)
            break;
        }
      }
    };
    
    if(typeof data === 'object'){
      data = $json(data,'stringify') 
    };
    xhr.send(data)

  };

  function $json(data,type){
    
    switch (type){
      case "parse":
        return JSON.parse(data)
        break;
      case "stringify":
        return JSON.stringify(data)
        break;
    }
    
  };
 	window.$_monitor = new Object({
		/**	
		 * @module 滚动监听
		 * @name   scroll
		 * @for    $_monitor
		 */
		scroll:{
			top:function(target,fn){
				if(typeof target !== 'object'){
					return false
				};
				target.onscroll = function(e){
					if(typeof fn === 'function'){

						var scrollTop;
						if(target === window){
							scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop
						}else{
							scrollTop = target.scrollTop
						};
						(scrollTop === 0) ? fn.call(fn) : ''
						
					}
				}
			},
			bottom:function(target,fn){
				if(typeof target !== 'object'){
					return false
				};
				target.onscroll = function(e){
				
					if(typeof fn === 'function'){
						var scrollTop, scrollHeight = target.scrollHeight, containerHeight = target.offsetHeight;
						if(target === window){
							containerHeight = window.innerHeight;
							scrollHeight = document.body.scrollHeight;
							scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop
						}else{
							scrollTop = target.scrollTop
						};
						
						(scrollTop+containerHeight === scrollHeight) ? fn.call(fn,scrollTop,scrollHeight) : ''
						
					}
				}
				
			}
		}
	});
	
        module.add('my-witharwal',{
            el:'#my-witharwal',
            data:{  
                collectlist:[],
                jsonUrl:uoot + 'Json/index.php',    
                maxPerpage:10,
                type:0,
                p:1,
                renderFlag:true,
                limit:false,
                datalist:[],
                settled1:0,
                settled2:0,
            },
            created:function(){
                var that = this;
                that.getlist() 
                $_monitor.scroll.bottom(window,function(){
                    that.p+=1
                    that.getlist()
                })
                
            },
            methods:{
                //获取数据函数
				getlist:function(){			
					var dataed = {};
					var _this = this;
					dataed.p= this.p;
//					dataed.id= id;
//					dataed.type= type;
					dataed.maxperpage = this.maxPerpage;
						 _this.loadingFlag=true
						$post(_this.jsonUrl + '?act=Microportal.Mywithdrawal',dataed,function(res){
								_this.settled1= res.Mywithdrawal.allmoney;
								_this.settled2= res.Mywithdrawal.kjs;
								 _this.loadingFlag=false
								//如果没有数据的话
								if(res.Mywithdrawal.page.total_pages==0){
									 _this.loadmoreFlag=false
									return false
								}
								var datas = res.Mywithdrawal.list;
								var datalength = datas.length;
								
								for(var i=0;i<datalength;i++){
									_this.datalist.push(datas[i])
								}
								
								
								 _this.p=_this.p+1
								
								//如果数据不足的话  当前页数是最后一页的话 或者是已经返回空数组回来了
								if(datalength<_this.maxPerPage &&res.Mywithdrawal.total_pages==res.Mywithdrawal.now_page || datalength==0){
									 _this.loadmoreFlag=false
									 _this.limit=true
									return false
								}
						},'json')
			    },
       		},

        
            
        })
    module.import('my-witharwal')
    
     </script>

</body>
</html>