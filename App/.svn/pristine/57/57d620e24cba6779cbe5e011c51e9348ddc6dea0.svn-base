<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台"/>
    <meta name="Description" content="kesion教育平台" />
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">

<div class="ks-wbox bRadius10">
    <!--header-->
    <div class="ks-head-box clearfix">
        <h3 class="ks-head-title">答疑中心
            <div class="fr">
                <a class="ks-setting-icon fl ml10"onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>,isopen:'1'})"><i class="iconfont icon-setting" ></i></a>
                <a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor110"><i class="iconfont icon-qm" ></i></a>
            </div>
        </h3>
    </div>
    <!--header-->
        <!--widget-->
        <div class="ks-head-widget clearfix">
            <div class="fl">
                <form target="hidframe">
                    <div class="ks-search-box">

                        <select class="w150 inputText bRadius5 fl" id="keytype">
                            <option value="1" <?php if($keytype==1) echo "selected"; ?>>问题标题</option>
                        </select>
                        <div class="ks-top-search fl" >
                            <input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>"> 		<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
                        </div>

                    </div>

                </form>



            </div>


            <div class="fr">
                <ul class="ks-head-choice">
                    <li>
                        <div class="ks-head-el">
                            <button class="ks-heade-button ks-head-primary" type="button" onClick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
                            <div class="ks-head-content ks-head-content-pr w400">
                                <ul class="screen">
                                    <li>
                                        <span>审核状态：</span>
                                        <div>
                                            <a class="<?php if($status==2) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-2,appid-$this->appid",true)); ?>">全部</a>
                                            <a class="<?php if($status==1) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>">已审核</a>
                                            <a class="<?php if($status==0) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>">未审核</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span style="margin-left: -28px">前台是否展示：</span>
                                        <div>
                                            <a class="<?php if($show==2) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("show-2,appid-$this->appid",true)); ?>">全部</a>
                                            <a class="<?php if($show==1) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("show-1,appid-$this->appid",true)); ?>">展示</a>
                                            <a class="<?php if($show==0) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("show-0,appid-$this->appid",true)); ?>">不展示</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>回复状态：</span>
                                        <div>
                                            <a class="<?php if($reply==2) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("reply-2,appid-$this->appid",true)); ?>">全部</a>
                                            <a class="<?php if($reply==1) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("reply-1,appid-$this->appid",true)); ?>">已回复</a>
                                            <a class="<?php if($reply==0) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("reply-0,appid-$this->appid",true)); ?>">未回复</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span style="margin-left: -28px">回答是否公开：</span>
                                        <div>
                                            <a class="<?php if($open==2) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("open-2,appid-$this->appid",true)); ?>">全部</a>
                                            <a class="<?php if($open==1) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("open-1,appid-$this->appid",true)); ?>">公开</a>
                                            <a class="<?php if($open==0) echo "active" ;?>" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("open-0,appid-$this->appid",true)); ?>">私密</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!--/widget-->

        <form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post">
            <!--table-->

            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" >
                <thead>
                <tr>
                    <th>选择</th>
                    <th style="text-align: left;">问题标题</th>
                    <th>提问者</th>
                    <th>提问时间</th>
                    <th>审核状态</th>
                    <th>前台是否展示</th>
                    <th>回复状态</th>
                    <th>回答是否公开</th>
                    <th>围观者</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($values as $k=>$v){
                    ?>
                    <tr>
                        <td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
                        <td style="text-align: left;"><?php echo Field($v['title']);?>&nbsp;&nbsp;
                            <?php
                            if ($v['so_type']==1){
                                ?><img style="width: 20px;height: 20px;vertical-align: middle;" src="/Images/home/pic.png"/><?php
                            }elseif ($v['so_type']==2){
                                ?><img style="width: 20px;height: 20px;vertical-align: middle;" src="/Images/home/video.png"/><?php
                            }elseif ($v['so_type']==3){
                                ?><img style="width: 20px;height: 20px;vertical-align: middle;" src="/Images/home/audio.png"/><?php
                            }
                            ?>

                        </td>
                        <td><?php echo Field($v['inputer']);?></td>
                        <td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
                        <td>
                            <span class="link-switch<?php if($v["status"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['id'],GP('')); ?>"><i></i></span>
                        </td>
                        <td>
                            <span class="link-switch<?php if($v["is_show"]==1){ echo ' open'; }?>" data-off="<?php echo M_URL($this->AppName.'/Index','updateshow',$v['id'],GP('')); ?>" data-open="<?php echo M_URL($this->AppName.'/Index','updateshow',$v['id'],GP('')); ?>"><i></i></span>
                        </td>
                        <td>
                           <?php if ($v['is_reply']==1){echo "已回复";}else{echo '<span style="color: red">未回复</span>';}?>
                        </td>
                        <td>
                            <?php if ($v['is_open']==1){echo "公开";}else{echo '私密';}?>
                        </td>
                        <td><?php echo $v['reply_num'];?></php></td>
                        <td class="ks-head-el">
                            <i onClick="choiceClick(this)" class="iconfont icon-more"></i>
                            <div class="ks-head-content ks-head-content-pc w100">
                                <ul class="opeart">
                                    <li>
                                        <a href="javascript:;" onclick="top.KTJ_RouteJump('/answerAdd?id=<?php echo $v['id']; ?>')">查看</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" onclick='Confirm("是否删除？该操作不可逆","<?php echo M_URL($this->AppName.'/Index','delete',$v['id'],GP(''));?>")'>删除</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <input type="hidden" name="batch" id="batch1" />
        </form>

        <!--/table-->
        <?php echo NoC($values);?>
        <?php if(!empty($values)){?>

            <div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button type="button" class="ks-heade-button mr10" onClick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
				<button type="button" class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>
				<button type="button" class="ks-heade-button " onClick="submitform(3)">取消审核</button>
			</span>
                <div class="fr"><?php echo $page->show(3); ?></div>

            </div>
        <?php }?>
</div>
<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
    module.require(['$','backstage'],function(){

        $('.link-switch').each(function(){
            setLinkSwitch(this)
        })
    })
    function submitform(type){
        inspectionCheckBox('check[]',function(){
            $('#batch1').val(type);
            if(type===1){
                top.popup.confirm('确认要删除所选项吗？',{
                    determine:function(){
                        $('#myform').submit();
                    }
                })
            }else{
                $('#myform').submit();
            }
        })
    };
    function attributeSelect(url){
        window.location.href=''+url;
    }
</script>
</body>
</html>