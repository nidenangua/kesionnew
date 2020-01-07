
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title><?php $id = ChkClng(KS_G('request.id'));if(!empty($id)){echo '编辑';}else{echo '添加';}?><?php $coursetype = ChkClng(KS_G('request.courseType'));if($coursetype==3){echo '音频';}elseif($coursetype==1){echo '点播';}?>
    	
    </title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/model.css?<?php echo time();?>" rel="stylesheet">
    <!-- <link href="<?php echo UOOT;?>Public/common/css/jquery.Jcrop.min.css" rel="stylesheet"> -->
    <script src="https://store.kesion.com/Public/common/js/aliyun/alioss/lib/plupload-2.1.2/js/plupload.full.min.js"></script>
    <script src="https://store.kesion.com/Public/common/js/aliyun/alioss/upload.js?<?php echo time();?>"></script>
    <script>
        var uoot = '<?php echo UOOT ?>';
        var id= <?php echo $id;?>;	
        
		var u = navigator.userAgent;

     	var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
     	console.log(isiOS)
    </script> 	
    <style>
        #vader {
            display:none
        }
        .stylename  input[type="file"]{
        	display: none;
        }
        .confirm .title {
			height: 8rem;
			display: table-cell;
			vertical-align: middle;
			text-align: center;
			padding: 1rem;
			font-size: 0.7rem;
		}
		.confirm .title  a{
			display: block;
			color: #37a7ed;
			font-size: 0.75rem;
		}
		.confirm {
		    position: fixed;
		    top: 20%;
		    left: 7.5%;
		    overflow: hidden;
		    width: 85%;
		    border-radius: 3px;
		    box-shadow: 0 0px 6px rgba(25,25,25,.4);
		    background: #fff;
		    z-index: 150;
		}
		.confirm .item-b {
		    position: absolute;
		    bottom: 0;
		    left: 0;
		    display: flex;
		    height: 2rem;
		    line-height: 2rem;
		    width: 100%;
		    font-size: 14px;
		}
		.confirm .item-b .item-inner {
		    flex: 1;
		    text-align: center;
		    color: #f28550;
		}
    </style>
</head>
<body style="background-color:#fff" >
		
		
    	<div class="add-mode-box" id="addgraphic" v-cloak>
            
        <div class="addaudio add-po" style="min-height:3rem;"  id="container">

            
			<a id="selectfiles" href="javascript:void(0);"></a>
            <div class="add-name"  v-if="courseType==3">
                 	音频封面
            </div>  
              <div class="add-name"  v-if="courseType==1">
                 	点播封面
            </div> 
            <div class="add-input" >
            <div class="loadings-groop" v-show="loadings">正在上传中...</div>
            <div class="imgSrc" :style="{backgroundImage:'url('+defaultpic+')'}"> </div>
            </div>
                
        </div>    
    
      
        <div class="addaudio add-po" >
                <div class="add-name"  v-if="courseType==3">
                    	音频标题
                </div>  
                 <div class="add-name"  v-else="courseType==1">
                 	
                    	点播标题
                </div> 
                <div class="add-input">
                     <input type="text"  class="add-title2"  placeholder="请输入标题" v-model="title" ref="count" style="padding-right: 50px;">
                    <div  class="number1"><font  v-html="number1"></font>/ 30</div>	
                </div>
                
        </div>    

      
        <div class="addaudio">
           <div class="add-name" v-if="courseType==3">
              	  音频简介
            </div>  
             <div class="add-name" v-else="courseType==1">
              	  点播简介
            </div>  
           <div class="add-input">
               <textarea class="edit-txt" type="text"   placeholder="选填 " v-model="intro"  ></textarea>
               
           </div>
               
       </div>    
      
      
       <div class="addaudio-prograss"  >
       		<!--音频添加按钮-->
       		<div class="add-name" style="text-align: left;">
              	 音频文件
            </div>  
             <div id="audioContainer" @click="judment" v-show="courseType==3">
             	<button class="add-btn add-pur"  id="addAudio">上传音频</button>  
             
             </div>
             <!--视频添加按钮-->
               <div class="upload-btn" v-show="courseType==1" >
		             <input type="file" id="file"  >
		             <label for="file"  id="addAudio">上传视频</label>
		           
		      </div>
		     <!--显示视频进度--> 
		    <div class="addaudio-txt" v-show="courseType==1">
                 <span id="file_Name" >{{filename}}</span>
          	</div>  
	        <div class="ui-progress-container" v-show="progress.flag" v-if="courseType==1">
	            <div class="ui-progress-inner">
	                <div class="ui-progress" :style="{width:progress.percentage}"></div>
	                <div class="ui-progress-bar"></div>
	                <div class="state" v-text="progress.state"></div>
	            </div>
	        </div>
	        
        	<!--显示音频进度-->
             <div class="addaudio-txt" v-show="courseType==3">
                 <span id="file_Name">  {{ filename }}</span>
                 <div class="barContro_space"><span class="vader" v-show="vader"   v-bind:style="{ width: width + '%' }"></span></div>
                 <span class="addaudio-upload" v-show="addaudioUpload">{{message}} </span>
             </div>
       </div>
       
    
        <div class="add-input clearfix">
               <select class="add-select"   v-model="chargetype" id="charge">
               		<option v-for="item of couponList" :value="item.value">{{item.name}}</option>
               </select> 
	     </div> 
          <div class="addaudio add-po" v-show="chargetype == 1">
                <div class="add-name">课程售价</div>  
                <div class="add-input">
                    <input  type="text" v-model="coursePrice" placeholder="点击填写价格，0为免费" > 
                </div>
        </div>   
		 <div class="addaudio add-po" v-show="chargetype == 1">
                <div class="add-name">原价格</div>  
                <div class="add-input">
                    <input   type="text" v-model="price_market" placeholder="点击填写价格，0为免费" > 
                </div>
        </div>
        
        
      
        
        <div class="add-btn-box">
            <button class="add-btn" @click="save" >保存</button>
        </div>
        
             <div class="mask" v-show="del==1" style="display: block;"></div>

			<div class="confirm" id="confirm" v-show="del==1" style="display: block;" >
				<div class="title">
										
						添加音频商品需用电脑登录科汛V名师管理后台（store.kesion.com）进行操作。
						<a href="https://store.kesion.com/home/help#anchor105">如何创建商品</a>

				</div>										
				<div class="item-b">
					<div class="item-inner" @click="openLink" >知道了</div>
					
				</div>
			</div>
		</div> 

    </div>    
    
    
  
    </body>

    <script src="<?php echo UOOT ?>Public/common/js/currency/gate.js?201896" type="text/javascript"></script>
    <script >
    	
            	module.add('addgraphic',{
	            el:'#addgraphic',
                data:{
                    coursePrice:null,
                    jsonUrl:uoot+'Json/index.php',
                    title:'',
                    chargetype:null,
                    courseType:-1,
					price_market:null,
                    newData:[],
                    intro:'',
                    fileurl:'', 
                    number1:0,
                  	id:-1,
                    defaultpic:'/Public/app/images/classIcon/cover_default.png',
                    isShow:false,
                    width:0,
                    filename:'',
                    addaudioUpload:true,
                    vader:false,
                    message:'',
                    del:0,
                    loadings:false,
                     progress:{
                        state:'上传中...',
                        percentage:'0%',
                        flag:false
                    },
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
               created:function(){				
					this.courseType = getParam('courseType');  
					this.id = getParam('id'); 		
				 },
                  mounted:function() {   
                    var that = this;
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
                    });        
                    ossWebUpload({
                       wxid:'<?php echo $this->wxid; ?>',
                       selectId:'addAudio',
                       containerId:'audioContainer',
                       type:3,
                       UploadProgress:function(file){
                            that.width = file.percent;
                            that.message ='上传中';                 
                            that.vader = true;
                            
                    
                       },
                       FileUploaded:function(data){
                         

                            that.fileurl = data.defaultpic;
                           // console.log(data)
                            that.filename= data.fileName
                            that.vader = false;
                            that.addaudioUpload = false; 
                           
                       },
                       

                    });  
                     loadAliyunJs(function(){
	                    uploadFileByAliyun('file',{
	                        wxid:<?php echo $this->wxid; ?>,
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
	                    
                        // ossWebUpload({
                        // multi:true,
                        // wxid:'<?php echo $this->wxid; ?>',
                        // selectId:'addAudio',
                        // type:3,
                        // progress:function(a){
                           
                        //     that.width = a;
                        //     that.message ='上传中';                 
                        //     document.getElementById("vader").style.display="block";
                        // },
                        // success:function(src,file){
                          
                            
                        //     that.fileurl = src;
                        //     that.filename= file.name
                        //     that.message ='上传成功';
                          
                        //     document.getElementById("vader").style.display="none";  
                        //     document.getElementById("addaudio-upload").style.display="none";                        
                        // }
                    //});
                    //console.log(id)
                    console.log(this.id,this.courseType,isiOS)
                    if(this.id!=0 && this.courseType==3 && isiOS == true ){
                       		audioContainer.setAttribute("class",'stylename');
                    	}
                    if(that.id!=0){
                    	this.getdata(id);
                    }else if(id==0){
                    	this.chargetype = this.couponList[0].value
                    }
                },
                methods:{
                    showImg:function(){
                        this.isShow = ! this.isShow
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
               		judment:function(){
               			 if(this.id!=0 && this.courseType==3 && isiOS == true ){
 
                       		
                       		this.del=1	
                       		audioContainer.setAttribute("class",'stylename');
                    	}
               		},
               		openLink:function(){
               			this.del=0	
               		},
               		 vod:function(__name,__src){
                       this.filename= __name;
                       this.fileurl =__src;
                    },
                    getdata:function(id){
                        var newData = {};
                        var that    = this 
                        newData.id  = id;
                        $post(this.jsonUrl+'?act=Microportal.getCourseDetail',newData,function(res){
                            if(res.getCourseDetail){
                               that.title = res.getCourseDetail.title;
                               that.intro = res.getCourseDetail.intro;
                               that.coursePrice = res.getCourseDetail.price;
                               that.defaultpic = res.getCourseDetail.defaultpic;
                               that.fileurl=res.getCourseDetail.fileurl;
							   that.chargetype = res.getCourseDetail.chargetype;
							   that.price_market = res.getCourseDetail.price_market;
							    that.filename = res.getCourseDetail.vdoName;
							    
							   that.number1 = that.title.length;
							   that.number2 = that.intro.length;
							   console.log(res)
                           }else{
                            toast2({
                                content: '连载课程请前去电脑端修改',
                                duration:2000,
                                callback: function callback() {
                                  console.log(1);
                                  window.history.back(-1);
                                }
                            })
                           }
                        },'json')
                    },
                    save:function (){
                        var newData = {};
                        var that = this 
                        newData.courseType=this.courseType;
                        newData.title= this.title;
                        newData.intro = this.intro;
                        newData.price = this.coursePrice;  
                        newData.defaultpic = this.defaultpic;
                        newData.fileurl =this.fileurl;
                        //newData.filename=this.filename;
                        newData.chargetype = this.chargetype;
						newData.price_market = this.price_market;
                        if( this.courseType==1){
                           	   if( that.fileurl == '')   {
                           	   	   toast2({
		                                content: '视频不能为空',		                               
		                            })
                           	   		 return
                           	   	
                           	   }                
                         }
                         
                        if(id!=0){
                             newData.id =id;
                        }
                     /*   if(this.fileurl==''){
                        	 toast2({content: '请到pc端添加音频',})
                        	return
                        }*/
                        $post(this.jsonUrl+'?act=Microportal.doaddcourse',newData,function(res){
                            if(res.doaddcourse.error==20000){
                                toast2({
                                    content: '保存成功',
                                    callback: function callback() {
                                     	
                                      window.history.back(-1);
                                    }
                                }) 
                                
                            }else {
                                toast2({
                                    content: res.doaddcourse.msg,
                                })
                            }
                        },'json')
                        
                    },
                },  
                 
                })

		    module.import('addgraphic')
        </script>
        
       <!-- <script src="//cdn.jsdelivr.net/npm/eruda"></script>
<script>

eruda.init();

console.log('控制台打印信息');

</script>-->
</html>