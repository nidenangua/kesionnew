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
    <div id="paper" v-cloak>
        <div class="top-list" ref="navlist">
			<div :class="{'active':tab==0 }" class="item" @click="options(0)"  id="i0"><span>未做</span></div>
			<div :class="{'active':tab==1 }" class="item" @click="options(1)"  id="i1"><span>未批阅</span></div>
			<div :class="{'active':tab==2 }" class="item" @click="options(2)" id="i2"><span>已批阅</sapn></div> 
        </div>
        <template v-if="renderFlag">
             <template v-if="datalist[tab].length>0">
                    <div class="items">
                        <div class="item" v-for="(item, index) in datalist[tab]" :key="index">
                            <div class="item-info">
                                <div class="item-name">{{item.Title}}</div>
                                <div class="item-time">{{item.adddate}}</div>
                            </div>
                            <a :href="item.url" class="link">{{msg}}</a> 
                        </div>
                    </div>
                    
             </template>
             <template v-else><div class="nodata"></div></template>   
			<div class="nomore" v-show="limit[tab]">我们是有底线的~</div>
			<div class="loadings" v-show="loadingFlag[tab]"></div>			
        </template>
    </div>
    <script src="<?php echo UOOT ?>Public/common/js/vue2.5.js"></script>
     <script src="<?php echo UOOT ?>Public/wechat/js/paper.js"></script>
</body>
</html>