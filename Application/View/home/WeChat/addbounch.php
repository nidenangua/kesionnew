
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title><?php $id = ChkClng(KS_G('request.id'));if(!empty($id)){echo '编辑';}else{echo '添加';}?>点播</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/model.css?<?php echo time();?>" rel="stylesheet">
    <!-- <link href="<?php echo UOOT;?>Public/common/css/jquery.Jcrop.min.css" rel="stylesheet"> -->
    <script>
        var uoot = '<?php echo UOOT ?>';
        var id= <?php echo $id;?>	
        var wxid =<?php echo $this->wxid; ?>
    </script> 	
   
  
</head>
<body style="background-color:#fff" >
   <div class="add-mode-box" id="addgraphic" v-cloak>
        <div class="addaudio add-po" style="min-height:3rem;" id="container">

        <div id="selectfiles"></div>

        <div class="add-name">
                点播封面
        </div>  
        <div class="add-input" >
           <div class="loadings-groop" v-show="loadings">正在上传中...</div>
            <div class="imgSrc" :style="{backgroundImage:'url('+defaultpic+')'}">
            </div>
            </div>
        </div>    
        <div class="addaudio add-po" >
                <div class="add-name">
                    点播标题
                </div>  
                <div class="add-input">
                    <input class="add-title2" type="text"  placeholder="请输入点播标题" style="padding-right: 40px;" v-model="title" ref="count" > 
                     <div  class="number1"><font  v-html="number1"></font>/ 20</div>		
                </div>
        </div>    
		<div class="addaudio">
            <div class="add-name">收费方式</div>  
            <div class="add-input">
                <select class="add-select" v-model="chargetype">
                    <option value="1">收费</option>
                    <option value="2">打赏</option>
                    <option value="0">免费</option>
                </select>
            </div>
                
        </div> 
        <div class="addaudio add-po" v-show="chargetype == 1">
                <div class="add-name">点播售价</div>  
                <div class="add-input">
                    <input style="width:90%" type="number" v-model="coursePrice" placeholder="点击填写价格，0为免费" > 
                </div>
        </div>   
		 <div class="addaudio add-po" v-show="chargetype == 1">
                <div class="add-name">划线价格</div>  
                <div class="add-input">
                    <input style="width:90%" type="number" v-model="price_market" placeholder="点击填写价格，0为免费" > 
                </div>
        </div>  
        <div class="addaudio add-po">
           <div class="add-name">
                点播简介
            </div>  
           <div class="add-input">
               <input type="text"   placeholder="选填 " v-model="intro"  ref="count" style="padding-right: 50px;">
               	 <div  class="number1"><font  v-html="number2"></font>/ 45</div>	
           </div>
       </div>   
       <div class="upload-btn">
             <input type="file" id="file"  >
             <label for="file"  id="addAudio">上传视频</label>
           
       </div>
         <div class="addaudio-txt">
                 <span id="file_Name" >{{filename}}</span>
             </div>
       <div class="add-btn-box">
            <button class="add-btn" @click="save" >保存</button>
       </div>
       <div class="ui-progress-container" v-show="progress.flag">
            <div class="ui-progress-inner">
                <div class="ui-progress" :style="{width:progress.percentage}"></div>
                <div class="ui-progress-bar"></div>
                <div class="state" v-text="progress.state"></div>
            </div>
        </div>
    </div>    
    </body>
    <script src="<?php echo UOOT ?>Public/common/js/currency/gate.js?252525111" type="text/javascript"></script>
    <script >
            module.add('addgraphic',{
	            el:'#addgraphic',
                data:{
                    coursePrice:0,
                    jsonUrl:uoot+'Json/index.php',
                    title:'',
                    content:'',
                    newData:[],
					chargetype:null,
					price_market:null, 
                    progress:{
                        state:'上传中...',
                        percentage:'0%',
                        flag:false
                    },
                    intro:'',
                    fileUrl:'http://ks.ketangjie.cn/Public/uploads/vedio.mp4', 
                    defaultpic:'https://store.kesion.com/Public/app/images/classIcon/cover_default.png',
                    width:0,
                    filename:'',
                    fileurl:'',
                    number1:'0',
                    number2:'0',
                    message:'',
                    vdoname:'',
                    loadings:false
                },
                 watch:{
              	 
               		title:{
	                    handler:function(title){
	                        var _this = this;
	                      //console.log(_this.$refs)
	                        var _sum = 20;
	                        _this.$refs.count.setAttribute("maxlength",_sum);
	                        _this.number1= _this.title.length;
	                    },
	                    deep:true
                	},
                	intro:{
                		handler:function(intro){
	                        var _this = this;
	                      //console.log(_this.$refs)
	                        var _sum = 45; 
	                        _this.$refs.count.setAttribute("maxlength",_sum);
	                        _this.number2= _this.intro.length;
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
                               that.defaultpic = data.defaultpic
                               that.loadings = false
	                       }
                        })   
                    });
                    loadAliyunJs(function(){
	                    uploadFileByAliyun('file',{
	                        wxid:wxid,
	                        fileQueued:function(){
	                            that.progress.flag = true
	                        },
	                        onUploadProgress:function(percentage){
	
	                            that.progress.percentage = percentage+'%'
	                        },
	                        success:function(name,mediaId){
	                            that.vod(name,mediaId);
	                            that.progress.state = '上传成功'
	                        }
	                    });
                	},'video')
                    if(id!=0){this.getdata(id);}
                },
                methods:{
       
                    getdata:function(id){
                        var newData = {};
                        var that = this 
                        newData.id=id;
                        $post(this.jsonUrl+'?act=Microportal.getCourseDetail',newData,function(res){
                            console.log(res)
                            if(res.getCourseDetail){
                                that.title = res.getCourseDetail.title;
                                that.intro = res.getCourseDetail.intro;
                                that.coursePrice = res.getCourseDetail.price;
                                that.defaultpic = res.getCourseDetail.defaultpic;
                                that.filename =res.getCourseDetail.vdoName;
								that.chargetype = res.getCourseDetail.chargetype;
							    that.price_market = res.getCourseDetail.price_market;
							    
							    that.number1 = that.title.length;
							    that.number2 = that.intro.length;
                            }else{
                              toast2({
                                content: '连载课程请前去电脑端修改',
                                callback: function callback() {
                                  console.log(1);
                                  window.history.back(-1);
                                }
                              });
                            }
                           
                        },'json')
                    },
                    vod:function(__name,__src){
                       this.filename= __name;
                       this.fileurl =__src;
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
                        var newData = {};
                        var that = this 
                        newData.courseType=1;
                        newData.title= this.title;
                        newData.intro = this.intro;
                        newData.price = this.coursePrice;  
                        newData.defaultpic = this.defaultpic;
                        //newData.fileurl =this.filename;
                        newData.fileurl =this.fileurl;
						newData.chargetype = this.chargetype;
						newData.price_market = this.price_market;
                        if(id!=0){
                             newData.id =id;
                        }
                        if(  Number(this.coursePrice) < 0 ){
                            console.log()
                            alert(' 请不要输入小于0的值');
                            return
                            this.coursePrice = null;
                        
                         }
                        $post(this.jsonUrl+'?act=Microportal.doaddcourse',newData,function(res){
                            if(res.doaddcourse.error==20000){
                                toast2({
                                content: '保存成功',
                                callback: function callback() {
                                  window.history.back(-1);
                                }
                              });
                                
                            }else {
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