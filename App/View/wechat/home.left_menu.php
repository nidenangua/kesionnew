<div class="ks-head-tab">
	<ul class="clearfix">
       	<li  class="<?php  if(ACTION=='count' || ACTION=='index'){echo 'curr' ;};?>"> <a title="公众号统计" href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" target="main"> <p>首&nbsp;&nbsp;页</p> </a> </li>
    	<li  class="<?php  if(ACTION=='reply'){echo 'curr' ;};?>"> <a title="关注回复"  href="<?php echo M_URL($this->AppName.'/Index','reply','',GP('')); ?>"> <p>关注回复</p> </a> </li>
    	<li  class="<?php  if(ACTION=='wechatMenus'){echo 'curr' ;};?>"> <a title="自定义菜单"  href="<?php echo M_URL($this->AppName.'/test','wechatMenus','',GP('')); ?>"> <p>自定义菜单</p> </a> </li>
		<li  class="<?php  if(ACTION=='fansList'){echo 'curr' ;};?>"> <a title="粉丝列表"   href="<?php echo M_URL($this->AppName.'/Index','fansList','',GP('')); ?>"> 粉丝列表 </a> </li>
		<li  class="<?php  if(ACTION=='infoManage'){echo 'curr' ;};?>"> <a title="消息管理"  href="<?php echo M_URL($this->AppName.'/Index','infoManage','',GP('')); ?>"> <p>消息管理</p>  </a> </li>
	    <li  class="<?php  if(ACTION=='materialManage'){echo 'curr' ;};?>"> <a title="素材管理"  href="<?php echo M_URL($this->AppName.'/Index','materialManage','',GP('')); ?>"> <p>素材管理</p> </a> </li>
	    <li  class="<?php  if(ACTION=='groupMessage'){echo 'curr' ;};?>"> <a title="群发功能" href="<?php echo M_URL($this->AppName.'/Index','groupMessage','',GP('')); ?>"> <p>群发功能</p> </a> </li>
	    <li  class="<?php  if(ACTION=='templateManage'){echo 'curr' ;};?>"> <a title="消息模板管理"  href="<?php echo M_URL($this->AppName.'/test','templateManage','',GP('')); ?>"> <p>消息模板管理</p> </a> </li>
	</ul>
	
</div>
