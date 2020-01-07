<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>提现申请</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    	 <link href="<?php echo UOOT ?>Public/wechat/css/cash.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/editcampus.css"/>
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	
    </script>
	<style type="text/css">
		[v-cloak]{
			display: none;
		}
	</style>
</head>
<body>
	<div id="page" v-cloak>
		<form id="form" action="<?php echo M_URL('WeChat','savewithdraw')?>" method='post'>
			<div class="p-mode" v-show="tab==0">
				<div class="p-mode-name">
					选择提现方式
				</div>
				<div class="p-mode-list">
					<!--<div class="p-mode-item" @click="withdrawClick(1,0)">
						<div class="p-mode-icon">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/cash_icon_CCB.png">
							<span>银行卡</span>	
						</div>
						<div class="p-mode-cir">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/pmode-cir.png">
						</div>
					</div>
					<div class="p-mode-item">
						<div class="p-mode-icon" @click="withdrawClick(1,1)">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/cash_icon_alipay.png">
							<span>支付宝</span>	
						</div>
						<div class="p-mode-cir">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/pmode-cir.png">
						</div>
					</div>-->
					<div class="p-mode-item">
						<div class="p-mode-icon" @click="withdrawClick(1,2)">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/cash_icon_wechat.png">
							<span>微信</span>	
						</div>
						<div class="p-mode-cir">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/pmode-cir.png">
						</div>
					</div>
				</div>
			</div>
			
			<!--遮罩层-->
			<div class="p-mode" v-show="tab==1">
				<div class="p-mode-list">
					<div class="p-mode-item" v-if='campusArr.length>0'>
						<div class="p-mode-icon p-mode-icon1" > 
							<img :src="bankimg">
							<span>{{bank}}</span>
							<span>{{bankstr}}</span>	  
						</div>
						<div class="p-mode-cir" @click="withdrawClick(3)">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/pmode-cir.png">
						</div>
						
					</div>
					<div class="p-mode-item" v-if='campusArr.length<1'>
							<div class="p-mode-icon" @click="withdrawClick(2)" > 
								<img :src="bankimg">
								<span>点击添加{{bankname}}</span>	
							</div>
							
							<div class="p-mode-cir" >
								<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/pmode-cir.png">
							</div>
							
					</div>
				</div>
				
				<div class="p-mode-content">
					<div class="p-title">提现金额</div>
					<div class="p-mode-input">
						<span class="p-mode-sign">￥</span>
						<input class="p-mode-text p-mode-line p-mode-text1" type="number"  v-model="changeMode"/>
						<p>可提现金额{{withdrawmoney}}元</p>
					</div>
				</div>
				<div class="p-mode-bbox">
					<button class="p-mode-btn" type="button" v-bind:class="{active:classObject}"  @click="submints()">{{tips}}</button>
				</div>
			</div> 
			<!---->
			<div class="p-mode" v-show="tab==2" id="p-mode2">
				<div class="p-mode-input">
						<span>{{title1}}</span>
						<input class="p-mode-text" type="text" v-model="bank" readonly="" />
						<!--<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/pmode-cir.png">-->						
				</div>
				<div class="p-mode-input">
						<span>{{title2}}</span>
						<input class="p-mode-text " v-if="zyinput" type="number"   placeholder="请输入号码" v-model="banknum"/>
						<input class="p-mode-text " v-if="!zyinput" type="text" placeholder="请输入号码" v-model="banknum"/>						
				</div>
				<div class="p-mode-input">
						<span>{{title3}}</span>
						<input class="p-mode-text" type="text" placeholder="请输入对应信息" v-model="name"/>						
				</div>
				<div class="p-mode-bbox" >
					<button type="button" class="p-mode-btn" :class="{active:bankFlag}"  @click="adddata()" >确认添加</button>
				</div>
			</div>
			<!--遮罩-->
			<!--添加银行卡-->
			<div class="p-mode" v-show="tab==3">
				<div class="p-mode-list" v-for="(item,index) of campusArr" :key="item.id">
					<div class="p-mode-item"  @click="clicked(index)">
						<div class="p-mode-icon">
							<img :src="bankimg">
							<span>{{item.bankname}}</span>	
							<span>{{item.banknum}}</span>
						</div>
						<div class="p-mode-cir" v-if="item.defaultlist == 1">
							<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/right.png">
						</div>
					</div>	
				</div>
				<div class="p-mode-bbox" >
					<button type="button" class="p-mode-btn p-mode-addbtn" @click="withdrawClick(2)" >添加{{bank}}</button>
				</div>
			</div>
			<!--提现成功-->
			<div class="p-mode p-mode-success" v-show="tab==4">
				<div class="p-mode-sicon">
					<img src="<?php echo UOOT ?>Public/wechat/images/bankmode/success.png">
				</div>
				<div class="p-mode-stit">申请提现成功</div>
				<div class="p-mode-sinfo">我们将在三个工作日内处理您的提现申请</div>
				<div class="p-mode-bbox">
					<button class="p-mode-btn p-btn-success" type="button"  onclick="window.location='<?php echo M_URL('WeChat','withdraw') ?>'">完成</button>
				</div>
			</div>
			<!---->
		</form>
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/currency/campus.js" type="text/javascript"></script>
	<script type="text/javascript">
	var _data;
function _defineProperty(obj, key, value) { 
if (key in obj) { 
     Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } 
	 return obj; 
}
module.add('dowithdraw', {
	el: '#page',
	data: (_data = {
		withdraw: true, //银联
		bankimg: '//xiaoyu.kesion.com/Public/wechat/images/bankmode/p-mod1.png',
		tab: 0,
		campusArr: [],
		jsonUrl: uoot + 'Json/index.php',
		paytype: 0,
		bankname: '银行卡',
		bank: '中国建设银行',
		title1: '开户银行',
		title2: '银行卡号',
		title3: '持卡人',
		title4: 10
	}, 
	_defineProperty(_data, 'bankname', ''), 
	_defineProperty(_data, 'banknum', ''), 
	_defineProperty(_data, 'name', ''), 
	_defineProperty(_data, 'bankstr', "尾号9603储蓄号"), 
	_defineProperty(_data, 'classObject', false), 
	_defineProperty(_data, 'bankFlag', false), 
	_defineProperty(_data, 'zyinput', true), 
	_defineProperty(_data, 'changeMode', null), 
	_defineProperty(_data, 'withdrawmoney', _data.title4), 
	_defineProperty(_data, 'tips', '申请提现'),
	_data),
	created:function(){
		var that = this;
		that.getwithdrawmoney();
	},
	watch: {
		changeMode: function changeMode(e) {
			if (e > Number(this.withdrawmoney)) {
				this.tips = '请勿超过您的可提现金额';
				this.classObject = false;
			} else {
				this.classObject = e.length ? true : false;
				this.tips = '申请提现';
			}
		},
		banknum: function banknum() {
			this.bankFlag = this.banknum.length && this.name.length ? true : false;
			console.log(this.banknum, this.name);
		},
		name: function name() {
			this.bankFlag = this.banknum.length && this.name.length ? true : false;
			console.log(this.banknum, this.name);
		}
	},
	methods: {
		withdrawClick: function withdrawClick(i) {
			var i2   = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : -1;
			this.tab = i;
			if (i2 >= 0) {
				this.paytype = i2;
			}
			if (i2 == 0) {
				this.bankname = '银行卡';
				this.bankimg = "//xiaoyu.kesion.com/Public/wechat/images/bankmode/cash_icon_CCB.png";
				this.bank = '中国建设银行';
				this.title1 = '开户银行';
				this.title2 = '银行卡号';
				this.title3 = '持卡人';
				this.zyinput = true;
			} else if (i2 == 1) {
				this.bankname = '支付宝';
				this.bankimg = "//xiaoyu.kesion.com/Public/wechat/images/bankmode/cash_icon_alipay.png";
				this.bank = '支付宝';
				this.title1 = '转账类型';
				this.title2 = '支付宝号';
				this.title3 = '姓名';
				this.zyinput = false;
			} else if (i2 == 2) {
				this.bankname = '微信';
				this.bankimg = "//xiaoyu.kesion.com/Public/wechat/images/bankmode/cash_icon_wechat.png";
				this.bank = '微信号';
				this.title1 = '转账类型';
				this.title2 = '微信号';
				this.title3 = '微信昵称';
				this.zyinput = false;
			}
			if (this.tab == 1) {
				this.getdata(i2);
			}
			if (this.tab == 2) {
				this.banknum = '';
				this.name = '';
			}
			if (i2 == -2) {
				this.getdata(i2);
			}
		},
		getdata: function getdata(i) {
			var that = this;
			var newData = {};
			newData.paytype = this.paytype;
			$post(this.jsonUrl + '?act=WeChat.paymentlist', newData, function (res) {
				//如果没有数据的话
				that.campusArr = [];
				var datas = res.paymentlist;
				var datalength = datas.length;
				for (var i = 0; i < datalength; i++) {
					that.campusArr.push(datas[i]);
					if (i == 0) {
						datas[i].defaultlist = 1;
						if (datas[i].paytype == 0) {
							var j = datas[i].banknum;
							if (datas[i].banknum.length > 4) {
								var j = datas[i].banknum.substr(datas[i].banknum.length - 4);
							}
							that.bankstr = '尾号' + j + '储蓄号';
						} else if (datas[i].paytype == 2) {
							that.bankstr = datas[i].banknum;
						} else if (datas[i].paytype == 1) {
							that.bankstr = datas[i].banknum;
						}
						that.banknum = datas[i].banknum;
						that.name = datas[i].name;
					} else {
						datas[i].defaultlist = 0;
					}
				}
				console.log(that.campusArr);
			}, 'json');
		},
		getwithdrawmoney:function(){
		 	var that    = this;
			var newData = {};
			$post(this.jsonUrl+'?act=WeChat.getwithdrawmoney',newData,function(res){
			 	that.withdrawmoney = res.getwithdrawmoney;
			},'json')	
		},
		adddata: function adddata(i) {
			var that = this;
			var newData = {};
			newData.paytype = this.paytype;
			newData.bankname = this.bank;
			newData.banknum = this.banknum;
			newData.name = this.name;
			console.log(newData.paytype, newData.banknum);
			if (newData.paytype == 0) {
				console.log(newData.banknum.length);
				if (newData.banknum.length < 16 || newData.banknum.length > 19) {
					alert('请输入正确卡号');
					return false;
				}
			}
			$post(this.jsonUrl + '?act=WeChat.addpayment ', newData, function (res) {
				if (res.addpayment) {
					alert('添加成功');
					that.withdrawClick(3, -2);
				} else {
					alert('请输入正确的账号');
					return false;
				}
			}, 'json');
		},
		clicked: function clicked(i) {
			var datas = this.campusArr;
			if (datas[i].paytype == 0) {
				var j = datas[i].banknum;
				if (datas[i].banknum.length > 4) {
					var j = datas[i].banknum.substr(datas[i].banknum.length - 4);
				}
				this.bankstr = '尾号' + j + '储蓄号';
			} else if (datas[i].paytype == 2) {
				this.bankstr = datas[i].banknum;
			} else if (datas[i].paytype == 1) {
				this.bankstr = datas[i].banknum;
			}
			for (var j = 0; j < datas.length; j++) {
				datas[j].defaultlist = 0;
			}
			this.banknum = datas[i].banknum;
			this.name = datas[i].name;
			datas[i].defaultlist = 1;
			this.tab = 1;
		},
		submints: function submints() {
			if (this.classObject) {
				var that = this;
				var newData = {};
				newData.paytype = that.paytype;
				newData.bankname = that.bank;
				newData.banknum = that.banknum;
				newData.name = that.name;
				newData.withdrawmoney = that.changeMode;
				$post(this.jsonUrl + '?act=WeChat.savewithdraw ', newData, function (res) {
					if (res.savewithdraw.errcode == '404') {
						alert(res.savewithdraw.msg);
					} else {
						that.tab = 4;
					}
				}, 'json');
			}
		}
	}
});
module.import('dowithdraw');
		</script>
	</body>
</html>