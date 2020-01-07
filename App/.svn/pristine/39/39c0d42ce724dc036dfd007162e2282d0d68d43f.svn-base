<?php
// +----------------------------------------------------------------------
// | 科汛教育微门户
// +----------------------------------------------------------------------
// | Copyright (C) 2017-2019 kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



use Kesion\Controller;
class AjaxController extends CommonController
{
	
	public function getHideAction(){
	
		 $userid = ChkClng(KS_G('post.userid')); 
		 
		 $html = '';
		 $html .= '<div class="console-hide" id="Hide_'.$userid.'">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active" onclick="des(this,'.$userid.');"><a href="#">基本信息</a></li>
                    <li onclick="des(this,'.$userid.');"><a href="#">登记记录</a></li>
                    <li onclick="des(this,'.$userid.');"><a href="#">购买应用</a></li>
                </ul>
                <div class="tap-content">
                    <div class="tab-pane tabpane'.$userid.'" style="display: block">
                        <div class="panel-body">
                            <div class="console-box">
                                <div class="hide-left">
                                    <div class="hide-picture">
                                        <img src="../Public/admin/images/a5.jpg" class="con-img">
                                    </div>
                                </div>
                                <div class="hide-right">
                                    <h3>陈海华（陈赤赤）</h3>
                                    <p class="hide-txt">
                                        教师职称：<label class="hide-label">教授</label>
                                    </p>
                                    <p class="hide-txt">
                                        联系电话：<label class="hide-label">15528564856</label>
                                    </p>
                                    <p class="hide-txt">
                                       联系QQ：<label class="hide-label">1203526512</label>
                                    </p>
                                    <p class="hide-txt">
                                        联系微信：<label class="hide-label">cgh1225</label>
                                    </p>
                                    <p class="hide-txt">
                                        注册时间：<label class="hide-label">2017/2/4 &nbsp 14:21:00</label>
                                    </p>
                                    <p class="hide-txt">
                                       购买应用：<label class="hide-label">6个</label>
                                    </p>
                                    <p class="hide-txt">
                                        联系微信：<label class="hide-label">cgh1225</label>
                                    </p>
                                    <p class="hide-txt">
                                        账户余额：<label class="hide-label">256元</label>
                                    </p>
                                    <p class="hide-txt">
                                        学员个数：<label class="hide-label">25687</label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane tabpane'.$userid.'" >
                        <div class="panel-body">
                            <div class="console-box">
                                <div class="panel-body" style="padding: 40px">
                            <table class="table" >
                                <thead>
                                <tr>
                                    <th>登入设备</th>
                                    <th>用户名</th>
                                    <th>登入时间</th>
                                    <th>登入IP</th>
                                    <th>备注说明</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>PC端</td>
                                    <td>Carrie</td>
                                    <td>2017/2/1 15:21:10</td>
                                    <td>127.0.0.1</td>
                                    <td>重复登入账户退出</td>
                                </tr>
                                <tr>
                                    <td>PC端</td>
                                    <td>Carrie</td>
                                    <td>2017/2/1 15:21:10</td>
                                    <td>127.0.0.1</td>
                                    <td>重复登入账户退出</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane tabpane'.$userid.'" >
                        <div class="panel-body">
                               <div class="banner-pd clearfix">
                        <div id="carousel">
                            <div class="carousel-scroll">
                                <ul class="banner-content">
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="../Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">
                                                    您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="../Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">
                                                    您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="../Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">
                                                    您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="../Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">
                                                    您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                              
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
			

        </div>';
		
		header('Content-type: application/json');
		
        echo json_encode($html);
	 }
}