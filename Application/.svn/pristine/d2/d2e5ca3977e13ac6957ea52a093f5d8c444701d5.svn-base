<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<style type="text/css">
	#show{
		padding: 0.3rem;
		
	}
	#show li{background: #fff;margin-bottom: 0.5rem;padding: 0.5rem;}

</style>

<body class="sign-wrap">
	<ul id="show">
		<li>
			<span class="ime-blue"></span>ime-blue
			<span class="ime-orange"></span>ime-blue
			<span class="ime-red"></span>ime-blue
		</li>
		
		<li>
			<p><i class="ion-tearcher"></i>ion-tearcher</p>
			<p><i class="ion-face"></i>ion-face</p>
			<p><i class="ion-boy"></i>ion-boy</p>
			<p><i class="ion-girl"></i>ion-girl</p>
			<p><i class="ion-clock"></i>ion-clock</p>
			<p><i class="ion-map"></i>ion-map</p>
			<p><i class="ion-playonline"></i>ion-playonline</p>
			<p><i class="ion-add"></i>ion-add</p>
			<p><i class="ion-redu"></i>ion-redu</p>
			<p><i class="ion-search"></i>ion-search</p>
			<p><i class="ion-screen"></i>ion-screen</p>
		</li>
		
		<li>
			<button class="r-btnBlue">r-btnBlue</button>
			<button class="r-btnGray">r-btnGray</button>
		</li>
		
		<li>
			<button class="o-btnBlue">o-btnBlue</button>
			<button class="o-btnOrag">o-btnOrag</button>
		</li>
		
		<li>
			<button class="x-btnBlue">x-btnBlue</button>
			<button class="x-btnGray">x-btnGray</button>
		</li>
		<li>
			<div class="btnSwitch" staus='false'>
		        <div class="sonSwitch"></div>
		        <input type="hidden" name="SwitchVal" id="SwitchVal" value="false" />
		    </div>
		</li>
		
		<li>
			<div class="search-seaBox1">
				<form action="" onsubmit="">
				<input type="search" value="" id="todayinput" placeholder="请复制这个结构"> 
				<i class="ion-search" onclick="signin.toDay.search(this)"></i> 
				</form>
			</div>
			<textarea style="width: 100%;margin-top: 1rem;height:8rem;">
				<div class="search-seaBox1">
					<form action="" onsubmit="">
					<input type="search" value="" id="todayinput" placeholder="请复制这个结构"> 
					<i class="ion-search" onclick="signin.toDay.search(this)"></i> 
					</form>
				</div>
			</textarea>
		</li>
		
		<li>
			<div class="search-seaBox2">
				<form action="" onsubmit="">
				<input type="search" value="" id="todayinput" placeholder="请复制这个结构"> 
				<i class="ion-search" onclick="signin.toDay.search(this)"></i> 
				</form>
			</div>
			<textarea style="width: 100%;margin-top: 1rem;height:8rem;">
				<div class="search-seaBox2">
					<form action="" onsubmit="">
					<input type="search" value="" id="todayinput" placeholder="请复制这个结构"> 
					<i class="ion-search" onclick="signin.toDay.search(this)"></i> 
					</form>
				</div>
			</textarea>
		</li>
		 
	</ul>
	
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js" type="text/javascript"></script>
	<script type="text/javascript">
		
	$_class('btnSwitch').map(function(swbtn){
		var staus = swbtn.getAttribute("staus");
		if(staus=='true'){
			swbtn.style.background = '#37A7ED';
			swbtn.findClass('sonSwitch')[0].style.left='';
			swbtn.findClass('sonSwitch')[0].style.left='1.45rem';
		}else{
			swbtn.style.background = '';
			swbtn.findClass('sonSwitch')[0].style.right='';
			swbtn.findClass('sonSwitch')[0].style.left='0rem';
		}
	
		if(swbtn.findTag('input')[0]){
			swbtn.findTag('input')[0].value = staus;
		}
		swbtn.onclick=function(callback){
			var staus = this.getAttribute("staus");
			if(staus=='true'){
				this.setAttribute("staus",'false');
				staus = 'false';
				this.style.background = '#FFF';
				this.findClass('sonSwitch')[0].style.left='0rem';
			}else{
				this.setAttribute("staus",'true');
				staus = 'true';
				this.style.background = '#37A7ED';
				this.findClass('sonSwitch')[0].style.left='1.45rem';
			}
			
			if(this.findTag('input')[0]){
				this.findTag('input')[0].value = staus;
			}
			
		}
		
		
	})


		/*window.onload=function(){
	        var div2=document.getElementById("div2");
	        var div1=document.getElementById("div1");
	        div2.onclick=function(){
	          div1.className=(div1.className=="close1")?"open1":"close1";
	          div2.className=(div2.className=="close2")?"open2":"close2";
	        }
	    }*/



	</script>
</body>
</html>