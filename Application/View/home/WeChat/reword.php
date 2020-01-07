<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title></title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT ?>Public/wechat/css/intention.css" rel="stylesheet">
    <script>
        var uoot = '<?php echo UOOT ?>';
    </script>
    <style type="text/css">
            .tipping-list {
                background: #fff;
                padding: 1rem
            }
            .tipping-title {
                font-size: 0.85rem;
                height: 2rem;
                line-height: 2rem;
                border-bottom: 1px solid #eee;
            }
            .tipping-list li {
                padding: 0.5rem 1rem 0.5rem 3rem;
                position: relative;
                border-bottom: 1px solid #eee

            }
            .tipping-list li .aver-img {
                position: absolute;
                left: 0;
                width: 2.5rem;
                height: 2.5rem;
               
            }
            .tipping-list li .aver-img img {
                max-width: 100%;
                border-radius: 50%;
            }
            .tipping-list li .aver-price {
                position: absolute;
                right: 0;
                top: 1rem;
                font-size: 1rem;
                color:red
            }
            .tipping-list li .aver-name{
                font-size: 0.8rem;
            }
            .tipping-list li .acer-time {
                font-size: 0.7rem;
                color: #999;
            }
    </style>
</head>
	<body style="background: #f5f5f5">
        <div class="tipping-list" id="tipping-list">
            <div class="tipping-title">
                总打赏收益 <font style="color: red">{{sum}}</font> 元
            </div>
            <ul>
                <li v-for="(item,index) of courseArr">
                    <div class="aver-img">
                        <img :src="item.head">
                    </div>
                    <div class="aver-txt">
                        <div class="aver-name">
                            {{item.name}}
                          
                        </div>
                        <div class="acer-time">
                             {{item.adddate}}
                        </div>
                        <div class="aver-price">
                            {{item.price}}
                        <div>
                    </div>
                </li>
            </ul>
        </div>
      
		
	</body>
   
    <script src="<?php echo UOOT ?>Public/common/js/currency/gate.js" type="text/javascript"></script>
	<script type="text/javascript">
           	module.add('tipping-list',{
                el:'#tipping-list',
                data:{
                    p:1,
                    maxperpage:5,
                    courseArr:[],
                    jsonUrl:uoot + 'Json/index.php',
                    noData:false,
                    search:'',	
                    message:'',
                    sum:0,
                    id:-1,
                    index:-1,
                    type:0,
                    livetype:-1,// 视频直播&语音直播
                    loadFlag:false,//加载状态
                    loadMoreFlag:true,//加载开关
                    courseid:-1,
                
                },
                created:function(){
                    var that = this; 
                    this.courseid = getParam('id');
                    
                    console.log(this.courseType)
                    that.getdata() 
                    $_monitor.scroll.bottom(window,function(){
                        that.getdata()
                    })
                    
                },
                methods:{
                
                    getdata:function(){
                        if(this.loadMoreFlag){
                            this.loadFlag = true;
                            var that = this;
                            var number =this.courseType;
                            var newData = {};
                            newData.infoid =this.courseid;
                            console.log(newData.type)
                            newData.courseType = this.courseType;				
                           
                    

                            $post(this.jsonUrl+'?act=Microportal.reword',newData,function(res){
                                console.log(res)
                                var dataed = res.reword;
                                var _number = Number(number)
                                that.sum = res.reword.money;
                                
                                var datas = dataed.list;
                                // console.log(res);
                                var datalength = datas.length; 
                                
                                for(var i=0;i<datalength;i++){
                                    that.courseArr.push(datas[i])
                                }
                                
                                
                                console.log(that.courseArr)
                            },'json')	
                        }
                    },
                
                
                
                },
 	
})

		module.import('tipping-list') 
	</script>
</html>