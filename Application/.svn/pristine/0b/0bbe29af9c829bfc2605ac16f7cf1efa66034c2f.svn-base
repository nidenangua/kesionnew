
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title><?php $id = ChkClng(KS_G('request.id'));if(!empty($id)){echo '编辑';}else{echo '添加';}?>图文</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/model.css?<?php echo time();?>" rel="stylesheet">
    <!-- <link href="<?php echo UOOT;?>Public/common/css/jquery.Jcrop.min.css" rel="stylesheet"> -->
    <script>
        var uoot = '<?php echo UOOT ?>';	
        var id= '<?php echo $id;?>';
    </script> 	
    <style>
    
        #selectfiles{ position: absolute;width: 100%; height: 100%; left: 0;top:0; z-index: 1;}

          .loadings-groop {
            z-index: 99;
            background: rgba(0,0,0,0.3);
            color: #fff;
            font-size: 0.7rem;
            width: 3rem;
            line-height: 2rem;
            height: 2rem;
            position: absolute;
            text-align: center;
            right: 0;
            top: 0.5rem;
            border-radius: 0.2rem;
            margin-left: -1.5rem;
        }
        .number1 {
        	position: absolute;
        	right: 0;
        	bottom:17px;
        	font-size: 15px;
        	color:#999;
        }
        .switch {
        	display: inline-block;
        	margin-left: 10px;
        	position: relative;
        	top: 10px;
        }
        
        .edit-txt  {
        	overflow: hidden;
        }
        .edit-txt p , .edit-txt span{
			    font-size: 0.7rem !important;
			    width:100%!important;
			    line-height: 1.8!important;
			    text-indent: 0;
			    margin-left: 0!important;
			    padding-left: 0!important;
			}
			.edit-txt img {
			    max-width: 100% !important;
			    display: block;
			    margin: 0 auto;
			   
			}
			
		.item-time, input[type="text"],input[type="number"],.add-input select,textarea[name="textContent"]{
		   -webkit-appearance: none;
		   background-color: #fff;
		   background-image: none;
		   border-radius: 4px;
		   border: 1px solid #eee;
		   border-width:0 0 1px 0;
		   box-sizing: border-box;
		   color: #606266;
		   display: inline-block;
		   font-size: inherit;
		  
		   line-height: 0.75rem;
		   outline: none;
		   padding: 1.125rem 0.7rem 1.125rem 0;
		   
		   transition: border-color .2s cubic-bezier(.645,.045,.355,1);
		   width: 100%;
		   font-size: 0.7rem;
		   
		 } 	
        input[type=radio]{width: 18px;height:18px;border: 0px;background: url('<?php echo UOOT ?>Public/app/images/check.png') no-repeat -18px 0;-webkit-appearance: none;outline: none;cursor: pointer;position: relative;float:left;margin:5px 5px 0 0;}
		input[type=radio]:checked {background: url('<?php echo UOOT ?>Public/app/images/check.png') no-repeat;}
		.add-input .add-select {border: 1px solid #e6e6e6;padding: 0.2rem 0 0.2rem 0.5rem;height: 2rem;box-sizing: border-box;}
		.radioLabel {margin-right: 35px;line-height: 28px;float: left;}
        </style>
</head>
	<body style="background-color:#fff;">
    	<div class="add-mode-box" id="addgraphic" v-cloak style="padding-bottom: 2rem;padding-top: 0;">
		
		 <div class="addaudio add-po" style="min-height:3rem;" id="container">

            <div id="selectfiles"></div>
     
            <div class="add-name" style="line-height: 3rem;top:0">
                  	  图文封面
            </div>  
            <div class="add-input" >
                  <div class="loadings-groop" v-show="loadings">正在上传中...</div>
                <div class="imgSrc" :style="{backgroundImage:'url('+defaultpic+')'}">
                  
                </div>
                
   
           </div>
                
        </div>  
		

           <div class="addaudio add-po" >
                <div class="add-name" >
                    	图文标题
                </div>  
              
                <div class="add-input">
                     <input type="text"  class="add-title2"  placeholder="请图文输入标题" v-model="title" ref="count" style="padding-right: 50px;">
                    <div  class="number1"><font  v-html="number1"></font>/ 30</div>	
                </div>
                
        	</div>    
        
 
          <div class="addaudio">
                <div class="add-name">
               		 图文内容 
                </div>
                <div class="add-input add-bo">
                        <div class="add-input edit-txt" id="content" contentEditable="true" @keyup="setContent(1)" @focus="focus" @blur="blur" v-html="content" style="min"> </div>
                </div>
                <div id="container1">
                	
               		 <button  id="selectfiles1" class="add-btn" style="margin-top: 0.5rem;background: none;border:1px solid #37a7ed;color:#37a7ed">增加图片</button>
                </div>
            </div>   
      
		<div class="addaudio">
            <div class="add-name">收费方式 </div>  
          
            	<div class="add-input clearfix">
	               <select class="add-select"   v-model="chargetype" id="charge">
	               		<option v-for="item of couponList" :value="item.value">{{item.name}}</option>
	               </select> 
	            </div>      
        </div> 
        <div class="addaudio add-po" v-show="chargetype == 1">
                <div class="add-name">课程售价</div>  
                <div class="add-input">
                    <input type="text" v-model="coursePrice" placeholder="点击填写价格，0为免费" > 
                </div>
        </div>   
		 <div class="addaudio add-po" v-show="chargetype == 1">
                <div class="add-name">原价格</div>  
                <div class="add-input">
                    <input type="text" v-model="price_market" placeholder="点击填写价格，0为免费" > 
                </div>
        </div>
        <div class="addaudio" v-show="chargetype == 1">
                <div class="add-name">
                 	   试看内容
                </div>
                <div class="add-input add-bo">
                        <div class="add-input edit-txt" id="announce" contentEditable="true" @keyup="setContent(2)" @focus="focus1" @blur="blur1" v-html="announce" style="min-height: 3rem;">
                  
                        </div>
                </div>
        </div>   
      
        <div class="add-btn-box">
            <button id="save" class="add-btn" @click="save" >保存</button>
        </div>
    </div>    
    </body>
    <script src="<?php echo UOOT ?>Public/common/js/currency/gate.js?201894" type="text/javascript"></script>
    <script >

            	module.add('addgraphic',{
	            el:'#addgraphic',
                data:{
                    coursePrice:null,
                    jsonUrl:uoot+'Json/index.php',
                    title:'',
                    content:'<span style="color:#ddd">请输入图文内容</span>',
                    _content:null,
                    announce:'<span style="color:#ddd">请输入试看内容</span>',
                    number1:0,
					chargetype:null,
					price_market:null,
                    newData:[],
                    fileUrl:'', 
                    guigeon:false,
                    defaultpic:'https://ketangjiecom.oss-cn-beijing.aliyuncs.com/Images/school/2/201808/02u8cbicgv.jpg',
                    isShow:false,
                    sss:null,
                    loadings:false,
                    chargeType:null,
                    Arr:[],
			        couponList:[
			        {
			　　　　　　value:0,
					   name:'免费'
			　　　　},
					{
			　　　　　　value:1,
					   name:'收费'
			
			　　　　},
					{  value:2,
			　　　　　　name: '打赏'
			　　　　 }
					],
                 },
                
            
                mounted:function() { 
                 
                   
                	var that = this;
                
                	
                    loadAliyunJs(function(){
                      
                		ossWebUpload({
	                       wxid:'<?php echo $this->wxid; ?>',
                           selectId:'selectfiles',
                           containerId:'container',
                           FilesAdded:function(){
                          
                             that.loadings = true
                           },
	                       FileUploaded:function(data){
                               that.defaultpic = data.defaultpic;
                               that.loadings = false
                               
	                       }
	                    });               	                 
                	
                		ossWebUpload({
	                       wxid:'<?php echo $this->wxid; ?>',
                           selectId:'selectfiles1',
                           containerId:'container1',
                           FilesAdded:function(){
                          
                           
                           },
	                       FileUploaded:function(data){
	                       	 console.log(content)
	                       	  if(content.innerHTML=='<span style="color:#ddd">请输入图文内容</span>'){
	                       	  	 content.innerHTML='';
	                       	  }
                                var imgbox = document.createElement("img");
           						imgbox.setAttribute('src', data.defaultpic);  
                                content.appendChild(imgbox)
	                       }
	                    });               	                 
                	})
					
                    if(id!=0){
                        this.getdata(id);
                      
                    }else if(id==0){
                    	this.chargetype = this.couponList[0].value
                    }
                   
                },
              
               	  watch:{
              	 
               		title:{
	                    handler:function(title){
	                        var _this = this;
	                        //console.log(_this.$refs)
	                        var _sum = 30;
	                        _this.$refs.count.setAttribute("maxlength",_sum);
	                        _this.number1= _this.title.length;
	                        console.log( _this.number1)
	                    },
	                    deep:true
                	},
                	coursePrice: function(v){
                		this.jud(v,'coursePrice')
                	},
                	price_market:function(v){
                		this.jud(v,'price_market')
                	}
                	
                	
               },
                methods:{
                	
                
                	
                 	setContent:function(number){    
                 			
         			 	if(number==1) {
         			 		var newContent = content.innerHTML.replace(/style=["]?[^"]+"/g,'');                 		
	                 		
	                 		if(content.innerHTML !== newContent){
	                 			this.content = newContent
	                 		}
         			 	}else{
         			 		var newContent1 = announce.innerHTML.replace(/style=["]?[^"]+"/g,'');                 		
	                 	
	                 		if(content.innerHTML !== newContent1){
	                 			this.announce = newContent
	                 		}
         			 	}
         			 	
                 },
                 	focus:function(){

                 		if(content.innerHTML=='<span style="color:#ddd">请输入图文内容</span>'){
                 			this.content = '';
                 		}
                 	},
                 	blur:function(){
                 		
                 		if(content.innerHTML==''){
                 			
                 			this.content = '<span style="color:#ddd">请输入图文内容</span>';
                 		}
                 	},
                 		
                 	focus1:function(){
                 		
                 		if(announce.innerHTML=='<span style="color:#ddd">请输入试看内容</span>'){
                 			this.announce = '';
                 		}
                 	},
                 	blur1:function(){
                 		
                 		if(announce.innerHTML==''){
                 			
                 			this.announce = '<span style="color:#ddd">请输入试看内容</span>';
                 		}
                 	},
                    getdata:function(id){
                        var newData = {};
                        var that = this; 
                        newData.id=id;
                        $post(this.jsonUrl+'?act=Microportal.getCourseDetail',newData,function(res){
                        	
                            if(res.getCourseDetail){
                              that.title = res.getCourseDetail.title;                            
                              that.coursePrice = res.getCourseDetail.price;
                              that.defaultpic = res.getCourseDetail.defaultpic;
                              that.content = res.getCourseDetail.content;
                              that.announce = res.getCourseDetail.announce;
							  that.chargetype = res.getCourseDetail.chargetype;
							  that.price_market = res.getCourseDetail.price_market;
							  that.number1 = that.title.length;
							 
                            }else{
                               toast2({
                                content: '连载课程请前去电脑端修改',
                                duration:2000,
                                callback: function callback() {
                                  console.log(1);
                                  window.history.back(-1);
                                }
                              });
                            }
                           
                        },'json')
                    },    
                    
                  changeChargeType:function(){
                  	
                  
                  	
                  	  this.guigeon = !this.guigeon;
                  	  if( this.guigeon==false){
                  	  	this.Arr==0
                  	  	
                  	  }
                  },
               		jud:function(val,key){
               			
               			var reg = val.match(/[0-9\.]+/g);
               			var __value = '';
               			if(reg){
               			               			
							for(var i=0;i<reg.length;i++){
								reg[i] && (__value += reg[i])
							}
						}	
						if(__value.indexOf('.')!==-1){
							var v = __value.split('.');
							__value = v[0];
							__value += '.'+v[1].match(/\d{0,2}/)[0]
							
						}
						
						
						this[key] = __value
						
               		},
                    save:function (){
                 
                       save.disabled=true;
                        var newData = {};
                        var that = this;
                        var __value = this.coursePrice;
                        if(id!=0){
                          newData.id=id;
                        }

                         
                        if(  Number(this.coursePrice) < 0 ){

                             toast2({
                                content: '请不要输入小于0的值',
                                
                              });
                            return
                            this.coursePrice = null;
                        
                         }
                        newData.courseType=4;
                        newData.title=this.title;
                        newData.content = content.innerHTML;
                        newData.announce = announce.innerHTML;
                        newData.price = this.coursePrice; 
                        newData.defaultpic=this.defaultpic;
						newData.chargetype = this.chargetype;
						newData.price_market = this.price_market;
                        $post(this.jsonUrl+'?act=Microportal.doaddcourse',newData,function(res){        
                                          
                            if(res.doaddcourse.error==20000){
                                
                                toast2({
                                content: '保存成功',
                                callback: function callback() {                                  
                                
                               window.history.back(-1);
                                  
                                }
                              });
                            }else{
                            	 save.disabled=false;
                                toast2({
                                content: res.doaddcourse.msg,
                              });
                            }
                        },'json')
                    },
                },  
              
                 
                })

		    module.import('addgraphic')
        </script>
    
	
</html>