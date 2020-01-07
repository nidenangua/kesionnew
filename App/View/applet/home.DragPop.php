<html>
	<head>
	  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/dragxcx/css/kesion_bse.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/dragxcx/css/style.css"/>
		<title>首页</title>
		
	<style type="text/css">
		.form-group .inner-img{
			width: 95px;
			height:120px;
			text-align: center;
			box-sizing: border-box;
			float: left;
			margin-right: 20px;
			overflow: hidden;
			     
			
		}
		.form-group .inner-img.active{
			border: 1px solid #dc332d;
		}
		.form-group .inner-img p{
			margin-top: 5px;
		}
		.form-group .inner-img img{
			width: 95px;
			height:95px ;
			
		}
	</style>
	</head>
	<body>
	<div class="form-group">
								<label class="control-label col-sm-2">查询条数：</label>
								<div class="col-sm-8">
									<div class="w100 fl">
										<input type="text" name="" id="" value="" class="form-control"/>
									</div>
									<label class="control-label fl" style="padding-left: 10px;">条</label>
									
									
								</div>
							</div>
							<div class="line">
								
							</div>
							<div class="form-group">
									<label class="control-label col-sm-2">排序方式：</label>
									<div class="w150 fl">
					                <select class="form-control" id="Order">
					                     <option value="I.InfoID desc">信息ID降序</option>
					                     <option value="I.InfoID asc">信息ID升序</option>
					                     <option value="I.adddate desc">更新时间降序</option>
					                     <option value="I.adddate asc">更新时间升序</option>
					                     <option value="i.commentnum desc">总评论数降序</option>
					                     <option value="i.commentnum asc">总评论数升序</option>
					                     <option value="i.hits desc">总浏览数降序</option>
					                     <option value="i.hits asc">总浏览数升序</option>
					                     <option value="i.hitsbymonth desc">月浏览数降序</option>
					                     <option value="i.hitsbymonth asc">月浏览数升序</option>
					                     <option value="i.hitsbyweek desc">周浏览数降序</option>
					                     <option value="i.hitsbyweek asc">周浏览数升序</option>
					                     <option value="i.hitsbyday desc">日浏览数降序</option>
					                     <option value="i.hitsbyday asc">日浏览数升序</option>
					                     <option value="i.goodnum asc">点赞数升序</option>
					                     <option value="i.goodnum desc">点赞数降序</option>
					                     <option value="i.favnum asc">收藏数升序</option>
					                     <option value="i.favnum desc">收藏数降序</option>
					                     <option value="i.sharenum asc">分享数升序</option>
					                     <option value="i.sharenum desc">分享数降序</option>
					                     <option value="newid()">随机显示</option>
					                </select>
				                </div>
							</div>
							<div class="line">
								
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">属性控制：</label>
								<div class="fl mt9">
									<div class="checkbox checkbox-inline" style="padding-left: 0;">
										<input type="checkbox" name="" id="hot" value="" />
										<label for="hot">是否热门</label>
									</div>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="" id="hot" value="" />
										<label for="hot">允许评论</label>
									</div>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="" id="hot" value="" />
										<label for="hot">是否滚动</label>
									</div>
									<div class="checkbox checkbox-inline">
										<input type="checkbox" name="" id="hot" value="" />
										<label for="hot">是否推荐</label>
									</div>
								</div>
							</div>
							<div class="line">
								
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">选择版式：</label>
								<div class="col-sm-10">
									<div class="fl">
										<div class="inner-img">
											<input type="hidden" value="Wx-popFormat1" />
											<img src="<?php echo UOOT;?>Public/dragxcx/images/banshi.jpg"/>
											<p>版式1</p>
										</div>
										<div class="inner-img">
											<input type="hidden" value="Wx-popFormat2" />
											<img src="<?php echo UOOT;?>Public/dragxcx/images/banshi.jpg"/>
											<p>版式2</p>
										</div>
										<div class="inner-img">
											<input type="hidden" value="Wx-popFormat3" />
											<img src="<?php echo UOOT;?>Public/dragxcx/images/banshi.jpg"/>
											<p>版式3</p>
										</div>
										<div class="inner-img">
											<input type="hidden" value="Wx-popFormat4" />
											<img src="<?php echo UOOT;?>Public/dragxcx/images/banshi.jpg"/>
											<p>版式4</p>
										</div>
										<div class="inner-img">
											<input type="hidden" value="Wx-popFormat5" />
											<img src="<?php echo UOOT;?>Public/dragxcx/images/banshi.jpg"/>
											<p>版式5</p>
										</div>
										
									</div>
								</div>
							</div>
							<div class="line">
								
							</div>
							<div class="popsave-wrap">
								
								<div class="popsave-confirm popsave-btn" onclick="popAdd()">
									确认添加
								</div>
								<div class="popsave-cancel popsave-btn" onclick="frame.close()">
									取消
								</div>
							</div>	
		
	</body>
</html>