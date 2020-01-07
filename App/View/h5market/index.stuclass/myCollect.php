<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>试卷列表</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/mypaper.css" rel="stylesheet">
    <script>var uoot = '<?php echo UOOT ?>';</script>   
</head>
<body>
    <div id="myCouse-page">
<!--         <div class="top-list" ref="navlist">
            <div :class="{'active':tab==0 }" class="item" @click="options(0)"  id="i0"><span>未做</span></div>
            <div :class="{'active':tab==1 }" class="item" @click="options(1)"  id="i1"><span>未批阅</span></div>
            <div :class="{'active':tab==2 }" class="item" @click="options(2)" id="i2"><span>已批阅</sapn></div> 
        </div> -->
        <div>
           
        </div>
            <div class="items" v-html="htmldata">
                <!-- <div class="item" v-for="(item, index) in collectlist" :key="index">
                    <div class="item-info">
                        <div class="item-name">{{item.inputer}}</div>
                        <div class="item-time">{{item.options}}</div>
                    </div>
                    <a :href="item.url" class="link">{{msg}}</a> 
                </div> -->
            </div>
                    
            <div v-show='isShow' class="nodata"></div>            
            <div v-show='isShow2' class="nomore">我们是有底线的~</div>          
    </div>
    <script src="<?php echo UOOT ?>Public/common/js/vue2.5.js"></script>
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
        module.add('myCouse-page',{
            el:'#myCouse-page',
            data:{  
                collectlist:[],
                jsonUrl:uoot + 'Json/index.php',    
                maxPerpage:10,
                type:0,
                p:1,
                del:0,
                content:'',
                userid:'',
                isShow:false,
                isShow2:false,
                htmldata:'',
                arrOpt: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'],
            },
            created:function(){
                var that = this;
                that.getdata() 
                $_monitor.scroll.bottom(window,function(){
                    that.p+=1
                    that.getdata()
                })
                
            },
            methods:{
                options:function(index){
                    this.type = index;
                    this.getdata();
                    this.createhtml(this.collectlist);
                },
                getdata:function(){
                    var that = this;
                    var newData = {}
                    newData.maxPerpage = that.maxPerpage;
                    newData.p = that.p;
                    $post(that.jsonUrl+'?act=Microportal.myCollect',newData,function(res){
                        console.log(res)
                        that.collectlist = res.myCollect.list;
                        if(that.collectlist.length==0&&that.p==1){
                            that.isShow =true;
                        }else if(that.collectlist.length==0&&that.p!=1){
                            that.isShow2 =true;
                        }else{
                           var ary= that.collectlist;
                           ary.map(function(data,n){
                               if(data.tktype==1||data.tktype==6){
                                  var tmary = data.options.split('$$$');
                                  var tmtitle = tmary[0];
                                  var tmchose = tmary[1].split('|$|');
                                  var chosehtml='';
                                  tmchose.map(function(v,k){
                                      chosehtml+='<li>'+that.arrOpt[k]+'、'+v+'</li>';
                                  })
                                  that.htmldata+=' <div class="item"><div class="item-info">';
                                  that.htmldata+='<div class="item-name">'+tmtitle+'</div>';
                                  that.htmldata+='<div class="item-time">'+chosehtml+'</div>'
                                  that.htmldata+='<div class="item-time">参考答案：<span>'+data.anser+'</span></div>'
                                  if(data.analysis==''||data.analysis==null){
                                    that.htmldata+='<div class="item-time">解析：<span>暂无</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">解析：<span>'+data.analysis+'</span></div>'
                                  }
                                  if(data.sourceType==2){
                                    that.htmldata+='<div class="item-time">来源类型：<span>试卷</span></div>';
                                    that.htmldata+='<div class="item-time">来源：<span>'+data.sourceTitle+'</span></div>';
                                  }else if(data.sourceType==1){
                                    that.htmldata+='<div class="item-time">来源类型：<span>其他</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">来源类型：<span>未知</span></div>'
                                  }
                                  that.htmldata+='</div></div>';
                               }else if(data.tktype==2){
                                  var tmary = data.options;
                                  var tmtitle = tmary.replace(/{#answer}/g, "________");
                                  that.htmldata+=' <div class="item"><div class="item-info">';
                                  that.htmldata+='<div class="item-name">'+tmtitle+'</div>';
                                  that.htmldata+='<div class="item-time">参考答案：<span>'+data.anser+'</span></div>'
                                  if(data.analysis==''||data.analysis==null){
                                    that.htmldata+='<div class="item-time">解析：<span>暂无</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">解析：<span>'+data.analysis+'</span></div>'
                                  }
                                  if(data.sourceType==2){
                                    that.htmldata+='<div class="item-time">来源类型：<span>试卷</span></div>';
                                    that.htmldata+='<div class="item-time">来源：<span>'+data.sourceTitle+'</span></div>';
                                  }else if(data.sourceType==1){
                                    that.htmldata+='<div class="item-time">来源类型：<span>其他</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">来源类型：<span>未知</span></div>'
                                  }
                                  that.htmldata+='</div></div>';
                               }else if(data.tktype==3){
                                  var tmary = data.options;
                                  that.htmldata+=' <div class="item"><div class="item-info">';
                                  that.htmldata+='<div class="item-name">'+tmary+'</div>';
                                  that.htmldata+='<div class="item-time"><span>A、正确</span><span>B、错误</span></div>'
                                  that.htmldata+='<div class="item-time">参考答案：<span>'+data.anser+'</span></div>'
                                  if(data.analysis==''||data.analysis==null){
                                    that.htmldata+='<div class="item-time">解析：<span>暂无</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">解析：<span>'+data.analysis+'</span></div>'
                                  }
                                  if(data.sourceType==2){
                                    that.htmldata+='<div class="item-time">来源类型：<span>试卷</span></div>';
                                    that.htmldata+='<div class="item-time">来源：<span>'+data.sourceTitle+'</span></div>';
                                  }else if(data.sourceType==1){
                                    that.htmldata+='<div class="item-time">来源类型：<span>其他</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">来源类型：<span>未知</span></div>'
                                  }
                                  that.htmldata+='</div></div>';
                               }else if(data.tktype==4){
                                  var tmary = data.options;
                                 var answerary = data.anser.split('$$$');
                                  that.htmldata+=' <div class="item"><div class="item-info">';
                                  that.htmldata+='<div class="item-name">'+tmary+'</div>';
                                  that.htmldata+='<div class="item-time">参考答案：<span>'+answerary[0]+'</span></div>'
                                  if(data.analysis==''||data.analysis==null){
                                    that.htmldata+='<div class="item-time">解析：<span>暂无</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">解析：<span>'+data.analysis+'</span></div>'
                                  }
                                  if(data.sourceType==2){
                                    that.htmldata+='<div class="item-time">来源类型：<span>试卷</span></div>';
                                    that.htmldata+='<div class="item-time">来源：<span>'+data.sourceTitle+'</span></div>';
                                  }else if(data.sourceType==1){
                                    that.htmldata+='<div class="item-time">来源类型：<span>其他</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">来源类型：<span>未知</span></div>'
                                  }
                                  that.htmldata+='</div></div>';
                               }else if(data.tktype==5){
                                   var tmary = data.options.split('$$$');
                                  var tmtitle = tmary[0];
                                  var tmchose = tmary[1].split('|$|');
                                  var answerary = data.anser.split('|$|');
                                  var chosehtml='';
                                  var answerhtml='';
                                  tmchose.map(function(v,k){
                                      chosehtml+='<li>'+(k+1)+'、'+v+'</li>';
                                  })
                                   answerary.map(function(v,k){
                                      answerhtml+='<li>'+(k+1)+'、'+v+'</li>';
                                  })
                                  that.htmldata+=' <div class="item"><div class="item-info">';
                                  that.htmldata+='<div class="item-name">'+tmtitle+'</div>';
                                  that.htmldata+='<div class="item-time">'+chosehtml+'</div>'
                                  that.htmldata+='<div class="item-time">参考答案：<span>'+answerhtml+'</span></div>'
                                  if(data.analysis==''||data.analysis==null){
                                    that.htmldata+='<div class="item-time">解析：<span>暂无</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">解析：<span>'+data.analysis+'</span></div>'
                                  }
                                  if(data.sourceType==2){
                                    that.htmldata+='<div class="item-time">来源类型：<span>试卷</span></div>';
                                    that.htmldata+='<div class="item-time">来源：<span>'+data.sourceTitle+'</span></div>';
                                  }else if(data.sourceType==1){
                                    that.htmldata+='<div class="item-time">来源类型：<span>其他</span></div>'
                                  }else{
                                     that.htmldata+='<div class="item-time">来源类型：<span>未知</span></div>'
                                  }
                                  that.htmldata+='</div></div>';
                               }

                           })
                        }
                        
                    },'json')   
                 },
                toggele:function(){
                    this.isShow = !this.isShow;
                },
                urlClick:function(url){
                    window.location.href = url
                },
        },

        
            
        })
    module.import('myCouse-page')
    
     </script>
</body>
</html>