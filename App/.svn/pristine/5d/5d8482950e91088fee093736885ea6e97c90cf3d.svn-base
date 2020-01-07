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
        <h3 class="ks-head-title">朋友圈动态
            <div class="fr">
                <a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>,isopen:'1'})"><i class="iconfont icon-setting" ></i></a>
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
                        <option value="1" <?php if($keytype==1) echo "selected"; ?>>动态内容</option>
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
                        <a class="ks-heade-button ks-head-primary"  onclick="top.KTJ_RouteJump('/friedscircle')">	<i class="iconfont icon-jiahao"></i>新增动态</a>
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
                    <th style="text-align: left;width: 50%;">朋友圈动态内容</th>
                    <th>发表人</th>
                    <th>发表时间</th>
                    <th>点赞</th>
                    <th>评论</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($values as $k=>$v){ ?>
                    <tr>
                        <td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
                        <td style="text-align: left;"><?php echo Field(urldecode($v['json']['content']));?>&nbsp;&nbsp;
                            <?php
                            if ($v['json']['type']==1){
                                ?><img style="width: 20px;height: 20px;vertical-align: middle;" src="/Images/home/pic.png"/><?php
                            }elseif ($v['json']['type']==2){
                                ?><img style="width: 20px;height: 20px;vertical-align: middle;" src="/Images/home/video.png"/><?php
                            }elseif ($v['json']['type']==3){
                                ?><img style="width: 20px;height: 20px;vertical-align: middle;" src="/Images/home/audio.png"/><?php
                            }
                            ?></td>
                        <td><?php echo Field($v['name']);?></td>
                        <td><?php echo date('Y-m-d H:i:s',$v['adddate']);?></td>
                        <td><?php echo $v['zan_num'];?></td>
                        <td><?php echo $v['reply_num'];?></td>
                        <td class="ks-head-el">
                            <i onClick="choiceClick(this)" class="iconfont icon-more"></i>
                            <div class="ks-head-content ks-head-content-pc w100">
                                <ul class="opeart">
                                    <li>
                                        <a onclick="top.KTJ_RouteJump('/friendsdet/<?php echo $v['id'];?>')">查看</a>
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
<!--				<button type="button" class="ks-heade-button mr10" onClick="submitform(2)">批量审核</button>-->
<!--				<button type="button" class="ks-heade-button " onClick="submitform(3)">取消审核</button>-->
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