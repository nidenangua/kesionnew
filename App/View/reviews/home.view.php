	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问题详情页</title>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/common/css/public.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/common/css/wenda.css"/>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
html{background-color:#f2f2f2;}
::-webkit-textarea-placeholder { /* WebKit browsers */ 
	font-size:14px;color:#c5c5c5;
	} 
	:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ 
	font-size:14px;color:#c5c5c5;
	} 
	::-moz-placeholder { /* Mozilla Firefox 19+ */ 
	font-size:14px;color:#c5c5c5;
	} 
	:-ms-textarea-placeholder { /* Internet Explorer 10+ */ 
	font-size:14px;color:#c5c5c5;
	}
	::-webkit-input-placeholder { /* WebKit browsers */ 
	font-size:14px;
	} 
	:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ 
	font-size:14px;
	} 
	::-moz-placeholder { /* Mozilla Firefox 19+ */ 
	font-size:14px;
	} 
	:-ms-input-placeholder { /* Internet Explorer 10+ */ 
	font-size:14px;
	}
	.content_bleft_t1{font-size: 18px;font-weight: 700;line-height: 25px; text-align:center;}
	.content_bix_wrp{padding: 40px 34px 30px;}
	.went_list{width:100%; height:40px; line-height:40px;}
	.went_list_t1{float:left; font-size:15px;}
	.went_list_t2{float:right; color:#a3a3a3;font-size:13px;}
	.huifu_li{ min-height:50px; line-height:50px}
	.huifu_li_header{line-height:26px; font-size:14px; margin-bottom:15px; width:100%; height:40px; position:relative;}
	.huifu_li_header a{float:left;}
	.huifu_li_header a img{border-radius:50%; height:35px; width:35px;}
	.huifu_li_header span{color:#09F; margin-left:10px; float:left; margin-top:5px;}
	.huifu_li_atr{line-height:26px; font-size:14px; margin-bottom:15px; padding-left:30px; padding-right:30px;}
	.huifu_li_lie{text-align:right;}
	.huifu_li_s1{margin-left:10px; margin-right:10px;}
	.huifu_li_s2{margin-left:10px;}
	.jiejue{width:200px; height:50px; float:right; position:relative; z-index:100; text-align:right;}
	.jiejue a{font-size:16px; text-decoration:none; color:black;}
.Layer{
		width:100%;
		height:500px;
		margin-top:200px;
		z-index: 200;
		display: none;
		position: fixed;
		
}
.bangzhong{height: 250px;width: 450px;background-color: #FFF; margin:0px auto; }
.win_top {
    height: 30px;
    width: 450px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #999;
    line-height: 30px;
	font-size:16px;
    color: #666;
    font-family: "微软雅黑", Verdana, sans-serif, "宋体";
    font-weight: bold;
    text-indent: 1em;
}
.win_top a {
    float: right;
    margin-right: 5px;
}
#shade {
    background-color:#000;
    position: fixed;
    z-index:120;
    display:none;
    width:100%;
    height:100%;
    opacity:0.6;
    filter: alpha(opacity=60);
    -moz-opacity: 0.6;
    margin: 0px;
    left: 0px;
    top: 0px;
    right: 0px;
    bottom: 0px;
}
.content {
    margin-top: 5px;
    margin-right: 30px;
    margin-left: 30px;
}
	.bt_yel{ display:block; width:80px; height:26px;line-height:26px; background-color:#FC0; text-align:center; color:white; float:right; cursor:pointer;}
	.bt_red{ display:block; width:80px; height:26px;line-height:26px; background-color:red; text-align:center; color:white; float:right; cursor:pointer;}
	
	.caozuo{text-align:right; position:absolute; right:0px; top:6px;}
	.caozuo a{ color:#09F; margin-left:15px; text-decoration:none;}
</style>
<body>

<div id="shade"></div>
<div id="Layer1" class="Layer">
	<div class="bangzhong">
      <div class="win_top">无满意答案<a href="#" onClick="shade.style.display='none';Layer1.style.display='none'">关闭</a></div>
      <br />
      <div class="content" style="text-align:center">
      	<h2>如果没有满意的回答，请点击下面的“关闭问题”按钮直接结束提问！ </h2>
        <div >
        	<br/>
        	<p>出于保护回答者利益的考虑，问题的悬赏分将不再返还。</p>
        	<p>如果因此造成您的积分损失，我们希望能得到您的理解。</p>
            <br>
        </div> 
		<div>
        	<a href="<?php echo M_URL($this->AppName.'/Index','delQuestion',$id,GP('')); ?>"><input type="button" value="确认删除"></a>&nbsp;&nbsp;&nbsp;&nbsp;
        	<input type="button" onClick="shade.style.display='none';Layer1.style.display='none'" value="还是再等等吧">
        </div>
      </div>

    </div>
</div>
<div id="Layer2" class="Layer">
	<div class="bangzhong">
      <div class="win_top">提高悬赏<a href="#" onClick="shade.style.display='none';Layer2.style.display='none'">关闭</a></div>
      <br />
      <div class="content">
      <form action="{=M_URL(question,addpoints)}&id={KS:$id}" method="post" target="hidframe">
			<div style="font-size:14px;">问题： 让我们一起跟随镜头走进阿白的内心世界</div>
            <div style="font-size:14px;">增加悬赏分，可以提高问题的关注度。</div>
            <div style="font-size:14px;">增加悬赏分：
            <select name="addintegral">
            	<option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">100</option>

            </select>您当前的积分是{KS:$field['integral']}分 ，请设置您要增加的悬赏分</div>
            <input type="submit"  value="提 交">
      </form>
      
      </div>

    </div>
</div>


<div class="content"  style=" background-color:#f2f2f2; overflow:auto;">
	<div class="content_bix"  style="padding-top:10px; padding-bottom:10px; overflow:auto;">
    	<div style=" height:1000px; overflow:auto; width:675px; float:left;">
        	<div class="content_bix_wrp"  style="background-color:white;" >
            	<div class="content_bleft_t1"><?php if(isset($value))echo $value['problem']; ?></div>
                <div class="jiejue" >
                 <span class="bt_red" onClick="shade.style.display='block';Layer1.style.display='block'">删除问题</span>
                </div> 
               
               <div style=" height:50px; line-height:50px">
                    <span style="font-size:15px; float:left; font-weight: bold">问题描述：</span>
                </div>
                <div class="miaoshu" style="line-height:26px; font-size:14px; margin-bottom:15px;">
                	<p><?php if(isset($value))echo $value['describe']; ?></p>
                
                </div>
                
                <div class="miaoshu" style="line-height:26px; font-size:14px; margin-bottom:15px;">
                	<a style="float:left;"><img src="<?php echo UOOT ?>Public/uploads/images/t1.jpg" style="border-radius:50%; height:35px; width:35px;"></a>
                    <span style="color:#09F; margin-left:10px;"><?php if(isset($value))echo $value['username']; ?></span><span style=" margin-left:10px; margin-right:10px;"><?php if(isset($value))echo $value['click']; ?>次浏览</span>|<span style=" margin-left:10px;"> <?php echo date('Y-m-d H:i:s',$value['adddate']) ?></span>
                	<div style="float:right; width:120px; height:80px;">
                    	<img src="<?php echo UOOT ?>Public/uploads/images/askjj<?php if(isset($value))echo $value['issolve']; ?>.jpg"><!--改图片名字最后的数字 0-2 -->
                    </div>
                </div>
                <div style="width:100%; margin-top:30px; border-top:1px solid #f2f2f2; padding-top:20px;">
                <?php if(isset($values))foreach($values as $k=>$v){ ?>
                    <div class="huifu_li">
                        <div class="huifu_li_header">
                            <a ><img src="<?php echo UOOT ?>Public/uploads/images/t1.jpg" ></a>
                            <span><?php if($v['anonymous']==1) echo '****';else{ echo $v['username'];} ?></span>
                             <div class="caozuo">
                          
                             <a href="<?php echo M_URL($this->AppName.'/Index','delAnswer',$v['answerid'],GP('questionid-'.$value['id'])); ?>">删除</a>
                           
                              <?php if($value['issolve']==0){ ?>
                              <a href="<?php echo M_URL($this->AppName.'/Index','bestAnswer',$v['answerid'],GP('questionid-'.$value['id'])); ?>">采纳</a>
                              <?php } ?>
                              </div>
                        </div>
                        <div class="huifu_li_atr">
                            <p><?php echo $v['answer'] ?></p>
                        </div>
                        <div class="huifu_li_lie" >
                            <span class="huifu_li_s1"><?php echo date('Y-m-d H:i:s',$v['adddate']) ?></span>
                        </div>
                        
                    </div>
                 <?php } ?>  
                    
                   
                
                </div>
                <form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','doaddanswer',$value['id'],GP('')); ?>"  id="myform">
                <input type="hidden" name="id" value="{KS:$id}" />
                <div style=" margin-top:20px;">
                	<textarea placeholder="请填写您的回答" style="resize:none;border-radius:3px; border:1px solid #C5C5C5;text-indent: 10px; font-weight: 400; height: 110px; line-height: 22px; width: 100%;" cols="30"  rows="3" name="answer" ></textarea>
                
                </div>
                <div style="font-size: 15px;  width:100%; height:80px; margin-top:10px;">
                	<input type="checkbox" style="background-color:white; width:16px; height:16px; float:left; margin-top:20px;" value="1" name="anonymous">
                    <span style="font-size:14px; float:left; margin-top:18px; margin-left:8px">匿名</span>
                	<input type="button" onClick="do_reg()" style="background-color:#337eff; border:none;height:30px; width:80px; font-size:14px; color:white; float:right;" value="提 交">
                </div>
               </form>


            </div>
            <!--<div class="content_bix_wrp"  style="background-color:white; margin-top:10px;">
               <div style=" width:100%; height:30px;">
                    <span style="font-size:18px; float:left; font-weight: bold">相关问题</span>
                </div>
                <div class="went_list"><a href="#">
                	<span class="went_list_t1">请问:输血科质量考核方案</span>
                	<span class="went_list_t2">2014-04-17</span>
                	</a>
                </div>
                <div class="went_list"><a href="#">
                	<span class="went_list_t1">请问:输血科质量考核方案</span>
                	<span class="went_list_t2">2014-04-17</span>
                	</a>
                </div>
                <div class="went_list"><a href="#">
                	<span class="went_list_t1">请问:输血科质量考核方案</span>
                	<span class="went_list_t2">2014-04-17</span>
                	</a>
                </div>
                <div class="went_list"><a href="#">
                	<span class="went_list_t1">请问:输血科质量考核方案</span>
                	<span class="went_list_t2">2014-04-17</span>
                	</a>
                </div>
                <div class="went_list"><a href="#">
                	<span class="went_list_t1">请问:输血科质量考核方案</span>
                	<span class="went_list_t2">2014-04-17</span>
                	</a>
                </div>
                
                



            </div>-->
        </div>
        <div style="width:315px; float:right;background-color:white; min-height:300px; padding-bottom:20px;">
        	<div style="padding: 18px 20px 24px;">
            	<div style="text-align: center; font-size: 16px; line-height: 24px; font-weight: 700; padding-bottom: 18px; border-bottom: 1px solid #f0f0f0;">提问的正确姿势</div>
            	<div style="width:100%;line-height: 22px;color: #a3a3a3;font-size:14px; margin-top:20px;"><span>① </span>问题要具体、语句通顺，不寻求模糊空洞的答案。广告等违反社区规则的提问将被删除并给予处罚。</div>
            	<div style="width:100%;line-height: 22px;color: #a3a3a3;font-size:14px; margin-top:20px;"><span>② </span>句式、标点符号使用严谨，问题尽量不含有与问题本身无关的词语（如：跪求大神，急急急）。</div>
            	<div style="width:100%;line-height: 22px;color: #a3a3a3;font-size:14px; margin-top:20px;"><span>③ </span>打上正确的标签、添加悬赏将有助于更快地获得满意回答。</div>
            </div>
        </div>
    </div>	
</div>
{KS_问答尾部标签}
</body>
</html>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    function do_reg()
{
	
	var answer = $("textarea[name='answer']").val();

	if(answer==''){
		Alert('回答不能为空');
		return false;	
    }	
	
	
	$("#myform").submit();	
 } 
</script>
