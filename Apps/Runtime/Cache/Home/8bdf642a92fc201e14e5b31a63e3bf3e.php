<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  		<title>交友中心 - <?php echo ($CONF['mallTitle']); ?></title>
  		<meta name="keywords" content="<?php echo ($CONF['mallKeywords']); ?>" />
      	<meta name="description" content="<?php echo ($CONF['mallDesc']); ?>,交友中心" />
  		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-control" content="no-cache">
		<meta http-equiv="Cache" content="no-cache">

  		<link rel="stylesheet" href="/wstmall/Apps/Home/View/default/css/common.css" />
    	<link rel="stylesheet" href="/wstmall/Apps/Home/View/default/css/shop.css">
    	<link rel="stylesheet" type="text/css" href="/wstmall/Public/plugins/webuploader/webuploader.css" />

		<?php if($umark == "recommendAtlas"): ?><link rel="stylesheet" href="/wstmall/Apps/Home/View/default/css/structure.css"><?php endif; ?>

      	<script>
		var publicurl = '/wstmall/Public/';
	</script>
        <?php echo WSTLoginTarget(0);?>
    </head>
    <body>
        <div class="wst-wrap">
          <div class='wst-header'>
			<script src="/wstmall/Public/js/jquery.min.js"></script>
<script src="/wstmall/Public/plugins/lazyload/jquery.lazyload.min.js?v=1.9.1"></script>
<script type="text/javascript">
var WST = ThinkPHP = window.Think = {
        "ROOT"   : "/wstmall",
        "APP"    : "/wstmall/index.php",
        "PUBLIC" : "/wstmall/Public",
        "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>",
        "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
        "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"],
        "DOMAIN" : "<?php echo WSTDomain();?>",
        "CITYID" : "<?php echo ($currArea['areaId']); ?>",
        "DEFAULT_IMG": "<?php echo WSTDomain();?>/<?php echo ($CONF['goodsImg']); ?>",
        "MALL_TITLE" : "<?php echo ($CONF['mallName']); ?>",
        "SMS_VERFY"  : "<?php echo ($CONF['smsVerfy']); ?>"
}
    var domainURL = "<?php echo WSTDomain();?>";
    var publicurl = "/wstmall/Public";
    var currCityId = "<?php echo ($currArea['areaId']); ?>";
    var currCityName = "<?php echo ($currArea['areaName']); ?>";
    var currDefaultImg = "<?php echo WSTDomain();?>/<?php echo ($CONF['goodsImg']); ?>";
    var wstMallName = "<?php echo ($CONF['mallName']); ?>";
    $(function() {
    	$('.lazyImg').lazyload({ effect: "fadeIn",failurelimit : 10,threshold: 200,placeholder:WST.DEFAULT_IMG});
    });
</script>
<script src="/wstmall/Public/js/think.js"></script>
<div id="wst-shortcut">
	<div class="w">
		<ul class="fl lh">
			<!--<li class="fore1 ld"><b></b><a href="javascript:addToFavorite()"-->
				<!--rel="nofollow">收藏<?php echo ($CONF['mallName']); ?></a></li><s></s>-->
			<!--<li class="fore3 ld menu" id="app-jd" data-widget="dropdown">-->
				<!--<span class="outline"></span> <span class="blank"></span> -->
				<!--<a href="#" target="_blank"><img src="/wstmall/Apps/Home/View/default/images/icon_top_02.png"/>&nbsp;<?php echo ($CONF['mallName']); ?> 手机版</a>-->
			<!--</li>-->
			<li class="fore4" id="biz-service" data-widget="dropdown" style='padding:0;'>&nbsp;<s></s>&nbsp;&nbsp;&nbsp;
				所在城市
				【<span class='wst-city'>&nbsp;<?php echo ($currArea["areaName"]); ?>&nbsp;</span>】
				<img src="/wstmall/Apps/Home/View/default/images/icon_top_03.png"/>	
				&nbsp;&nbsp;<a href="javascript:;" onclick="toChangeCity();">切换城市</a><i class="triangle"></i>
			</li>
		</ul>
	
		<ul class="fr lh" style='float:right;'>
			<li class="fore1" id="loginbar"><a href="<?php echo U('Home/Orders/queryByPage');?>"><span style='color:blue'><?php echo ($WST_USER['loginName']); ?></span></a> 欢迎您来到 <a href='<?php echo WSTDomain();?>'><?php echo ($CONF['mallName']); ?></a>！<s></s>&nbsp;
			<span>
				<?php if(!$WST_USER['userId']): ?><a href="<?php echo U('Home/Users/login');?>">[登录]</a>
				<!--<a href="<?php echo U('Home/Users/regist');?>"	class="link-regist">[免费注册]</a>--><?php endif; ?>
				<?php if($WST_USER['userId'] > 0): ?><a href="javascript:logout();">[退出]</a><?php endif; ?>
			</span>
			</li>
			<li class="fore2 ld"><s></s>
			<?php if(session('WST_USER.userId')>0){ ?>
				<?php if(session('WST_USER.userType')==0){ ?>
				    <!--<a href="<?php echo U('Home/Shops/toOpenShopByUser');?>" rel="nofollow">我要开店</a>-->
				<?php }else{ ?>
				    <?php if(session('WST_USER.loginTarget')==0){ ?>
				        <a href="<?php echo U('Home/Shops/index');?>" rel="nofollow">卖家中心</a>
				    <?php }else{ ?>
				        <a href="<?php echo U('Home/Users/index');?>" rel="nofollow">买家中心</a>
				    <?php } ?>
				<?php } ?>
                                <a href="<?php echo U('Home/Members/index');?>" rel="nofollow">交友中心</a>
			<?php }else{ ?>
			    <!--<a href="<?php echo U('Home/Shops/toOpenShop');?>" rel="nofollow">我要开店</a>-->
			<?php } ?>
			</li>
		</ul>
		<span class="clr"></span>
	</div>
</div>

			<div class='wst-user-top'>
			<div class="wst-user-top-main">
					<div class='wst-user-top-logo'>
						<a href="<?php echo WSTDomain();?>"  title='商城首页'>
						<img src="<?php echo WSTDomain();?>/<?php echo ($CONF['mallLogo']); ?>" height="132" width='1240'/>	
						</a>
					</div>
<!--					<div class='wst-user-top-search'>
						<div class="search-box">
							<input id="wst-search-type" type="hidden" value="1"/>
							<input id="keyword" class="wst-search-ipt" me="q" tabindex="9" placeholder="搜索 商品" autocomplete="off" >
							<div id="btnsch" class="wst-search-btn">搜&nbsp;索</div>
						</div>
					</div>-->
					
				</div>
			</div>
			<div class="wst-shop-nav">
				<div class="wst-nav-box">
					<li class="liselect"><a href="<?php echo U('Home/Members/index');?>" style='color:#FFFFFF;'>交友中心</a></li>
					<div class="wst-clear"></div>
				</div>
			</div>
			<div class="wst-clear;"></div>
		</div>
          <div class='wst-nav'></div>
          <div class='wst-main'>
            <div class='wst-menu'>

            	<span class='wst-menu-title' style='border-top:0px;'><span></span>团队信息</span>
          		<a href="<?php echo U('Home/Members/recommendList/');?>"><li <?php if($umark == "recommendList"): ?>class='liselect'<?php endif; ?>>我的推荐</li></a>
              	<a href="<?php echo U('Home/Members/teamList/');?>"><li <?php if($umark == "teamList"): ?>class='liselect'<?php endif; ?>>我的团队</li></a>
               	<a href="<?php echo U('Home/Members/recommendAtlas/');?>"><li <?php if($umark == "recommendAtlas" or $umark == "recommendAdd"): ?>class='liselect'<?php endif; ?>>推荐图谱</li></a>

              	<span class='wst-menu-title'><span></span>会员审核</span>
            	<a href="<?php echo U('Home/Members/auditOut/');?>"><li <?php if($umark == "auditOut"): ?>class='liselect'<?php endif; ?>>我发出的审核</li></a>
              	<a href="<?php echo U('Home/Members/auditIn/');?>"><li <?php if($umark == "auditIn"): ?>class='liselect'<?php endif; ?>>我收到的审核</li></a>

                <span class='wst-menu-title'><span></span>会员升级</span>
				<a href="<?php echo U('Home/Members/promoteOut/');?>"><li <?php if($umark == "promoteOut"): ?>class='liselect'<?php endif; ?>>我发出的升级</li></a>
				<a href="<?php echo U('Home/Members/promoteIn/');?>"><li <?php if($umark == "promoteIn"): ?>class='liselect'<?php endif; ?>>我收到的升级</li></a>
                
            </div>
            <div class='wst-content'>
            
<div>
	<div class='wst-page-header'>
		交友中心&nbsp;>&nbsp;概览
	</div>

	<div class='wst-shophome-area'>
		<div class='wst-shophome-nav'>
			<div class='header'>
				好友提示
			</div>
			<div class='main'>
				<div style="font-weight:bolder;">团队信息</div>
				<div style="color:#55AAFF;">

					<span>我推荐的好友总数（<span style="color:red;"><?php echo ($recommend_count); ?></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>我的团队成员总数（<span style="color:red;"><?php echo ($team_count); ?></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
			<div class='header'>
				推荐的好友
			</div>
			<div class='main'>
				<div style="font-weight:bolder;">您推荐的好友，还有<span style="color: red;"><?php echo (count($unrecommend_users["unApply"])); ?></span>个未向5级报单会员发起申请，需要立即处理：</div>
				<div style="color:#55AAFF;">
					<?php if(!empty($unrecommend_users['unApply'])): if(is_array($unrecommend_users['unApply'])): $i = 0; $__LIST__ = $unrecommend_users['unApply'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span>用户Id:<?php echo ($vo["userId"]); ?>（<a style="color:red;"><a href="<?php echo U('Home/Members/recommendNew/?cuid='.$vo['userId']);?>">发起申请</a></span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</div>

				<div style="font-weight:bolder;">您推荐的好友，已有<span style="color: red;"><?php echo (count($unrecommend_users["inApply"])); ?></span>正在等待5级报单会员的审核，请耐心等待：</div>
				<?php if(!empty($unrecommend_users['inApply'])): if(is_array($unrecommend_users['inApply'])): $i = 0; $__LIST__ = $unrecommend_users['inApply'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span>用户Id:<?php echo ($vo["userId"]); ?>（<span style="color:red;">耐心等待</span>）</span>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?>

			</div>

			<div class='header'>
				收到的好友审核申请
			</div>
			<div class='main'>
				<div style="font-weight:bolder;">您收到<span style="color: red;"><?php echo ($unsovled_apply); ?></span>个未处理的好友正式申请，需要立即处理：</div>
				<div style="color:#55AAFF;">
					<span><a href="<?php echo U('Home/Members/auditIn');?>"><span style="color: red;">点击去处理</span></a></span>&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>

			<div class='header'>
				会员等级
			</div>
			<div class='main'>
				<div style="font-weight:bolder;">我的等级</div>
				<div style="color:#55AAFF;">

					<span>我当前的等级: <span style="color:red;"><?php echo ($current_level); ?></span></span>&nbsp;&nbsp;&nbsp;&nbsp;
					<span>我下一个等级: <span style="color:red;"><?php echo ($next_level); ?></span></span>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php if($if_can_update == 1): ?><a href="<?php echo U('Home/Members/promoteNew');?>"><span style="color:red;">去升级</span></a><?php endif; ?>
				</div>

				<div style="font-weight:bolder;">升级请求</div>
				<div style="color:#55AAFF;">

					<?php if($unsolved_promote_count > 0): ?><a href="<?php echo U('Home/Members/promoteIn');?>"><span style="color:red;"><?php echo ($unsolved_promote_count); ?>个未处理升级请求，去处理</span></a>
					<?php else: ?> 没有未处理会员升级请求<?php endif; ?>

				</div>
			</div>
			
		</div>

		<div style="width:192px;float:left;min-height:400px;border-left:1px solid #cccccc;">
			<!--<div style="height:36px;line-height:36px;font-weight:bolder;padding-left:10px;">-->
				<!--平台联系方式-->
			<!--</div>-->
			<!--<div style="padding-left:10px;line-height:26px;">-->
				<!--<div>电话：<?php echo ($shopInfo['shop']['userPhone']); ?></div>-->
				<!--<div>邮箱：<?php echo ($shopInfo['shop']['userEmail']); ?></div>-->
				<!--<div>服务时间：<?php echo ($shopInfo['shop']['serviceStartTime']); ?>-<?php echo ($shopInfo['shop']['serviceEndTime']); ?></div>-->
			<!--</div>-->
		</div>
		<div class="wst-clear"></div>
	</div>
</div>

            </div>
          </div>
          <div style='clear:both;'></div>
          <br/>
          <div class='wst-footer'>
          	<!--<div class="wst-footer-fl-box">-->
	<!--<div class="wst-footer" >-->
		<!--<div class="wst-footer-cld-box">-->
			<!--<div class="wst-footer-fl">友情链接：</div>-->
			<!--<div style="padding-left:30px;">-->
				<!--<?php if(is_array($friendLikds)): $k = 0; $__LIST__ = $friendLikds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>-->
				<!--<div style="float:left;"><a href="<?php echo ($vo["friendlinkUrl"]); ?>" target="_blank"><?php echo ($vo["friendlinkName"]); ?></a>&nbsp;&nbsp;</div> -->
				<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
				<!--<div class="wst-clear"></div>-->
			<!--</div>-->
		<!--</div>-->
	<!--</div>-->
<!--</div>-->

<div class="wst-footer-hp-box">
	<div class="wst-footer">
		<!--<div class="wst-footer-hp-ck1">-->
			<!--<?php if(is_array($helps)): $k1 = 0; $__LIST__ = $helps;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1;?>-->
			<!--<div class="wst-footer-wz-ca">-->
				<!--<div class="wst-footer-wz-pt">-->
				    <!--<img src="/wstmall/Apps/Home/View/default/images/a<?php echo ($k1); ?>.jpg" height="18" width="18"/>-->
					<!--<span class="wst-footer-wz-pn"><?php echo ($vo1["catName"]); ?></span>-->
					<!--<div style='margin-left:30px;'>-->
						<!--<?php if(is_array($vo1['articlecats'])): $k2 = 0; $__LIST__ = $vo1['articlecats'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2;?>-->
						<!--<a href="<?php echo U('Home/Articles/index/',array('articleId'=>$vo2['articleId']));?>"><?php echo ($vo2['articleTitle']); ?></a><br/>-->
						<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
					<!--</div>-->
				<!--</div>-->
			<!--</div>-->
			<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
			<!-- -->
			<!--<div class="wst-footer-wz-clt">-->
				<!--<div style="padding-top:5px;line-height:25px;">-->
				    <!--<img src="/wstmall/Apps/Home/View/default/images/a6.jpg" height="18" width="18"/>-->
					<!--<span class="wst-footer-wz-kf">联系客服</span>-->
					<!--<div style='margin-left:30px;'>-->
						<!--<a href="#">联系电话</a><br/>-->
						<!--<?php if($CONF['phoneNo'] != ''): ?>-->
						<!--<span class="wst-footer-pno"><?php echo ($CONF['phoneNo']); ?></span><br/>-->
						<!--<?php endif; ?>-->
						<!--<?php if($CONF['qqNo'] != ''): ?>-->
						<!--<a href="tencent://message/?uin=<?php echo ($CONF['qqNo']); ?>&Site=QQ交谈&Menu=yes">-->
						<!--<img border="0" src="http://wpa.qq.com/pa?p=1:<?php echo ($CONF['qqNo']); ?>:7" alt="QQ交谈" width="71" height="24" />-->
						<!--</a><br/>-->
						<!--<?php endif; ?>-->
						<!-- -->
					<!--</div>-->
				<!--</div>-->
			<!--</div>-->
			<!--<div class="wst-clear"></div>-->
		<!--</div>-->
	    
		<!--<div class="wst-footer-hp-ck2">-->
			<!--<img src="/wstmall/Apps/Home/View/default/images/alipay.jpg" height="40" width="120"/>支付宝签约商家&nbsp;|&nbsp;-->
			<!--<span class="wst-footer-frd">正品保障</span><span >100%原产地</span>&nbsp;|&nbsp;-->
			<!--<span class="wst-footer-frd">7天退货保障</span>购物无忧&nbsp;|&nbsp;-->
			<!--<span class="wst-footer-frd">免费配送</span>满98包邮&nbsp;|&nbsp;-->
			<!--<span class="wst-footer-frd">货到付款</span>400城市送货上门-->
		<!--</div>-->
	    <div class="wst-footer-hp-ck3">
	        <div class="links"> 
	            <?php $_result=WSTNavigation(1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a rel="nofollow" <?php if($vo['isOpen'] == 1): ?>target="_blank"<?php endif; ?> href="<?php echo ($vo['navUrl']); ?>"><?php echo ($vo['navTitle']); ?></a>&nbsp;<?php if($vo['end'] == 0): ?>|&nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; ?>
	        </div>
	        
	        <div class="copyright">
	         
	         <?php if($CONF['mallFooter']!=''){ echo htmlspecialchars_decode($CONF['mallFooter']); } ?>
	      	<?php if($CONF['visitStatistics']!=''){ echo htmlspecialchars_decode($CONF['visitStatistics'])."<br/>"; } ?>
	        	<div id="wst-mallLicense" data='1' style="display:;">Copyright©2015 Powered By 消费致富</a></div>
	        </div>
	    	
	        	 
	     
	    </div>
	</div>
</div>

          </div>
        </div>
    </body>
      	<script src="/wstmall/Public/plugins/formValidator/formValidator-4.1.3.js"></script>
     	<script src="/wstmall/Public/js/common.js"></script>
      	<script src="/wstmall/Apps/Home/View/default/js/head.js"></script>
      	<script src="/wstmall/Apps/Home/View/default/js/common.js"></script>
		<script src="/wstmall/Apps/Home/View/default/js/jquery.ui.draggable.min.js"></script>
		<script src="/wstmall/Apps/Home/View/default/js/structure.js"></script>
      	<script src="/wstmall/Public/plugins/layer/layer.min.js"></script>
		<script src="/wstmall/Public/plugins/plugins/plugins.js"></script>
		<script src="/wstmall/Public/plugins/bootstrap/js/bootstrap.min.js"></script>
		<?php if($umark == "recommendAdd"): ?><script>
				$(function () {
					$.formValidator.initConfig({
						theme:'Default',mode:'AutoTip',formID:"myform",debug:true,submitOnce:true,onSuccess:function(){
						edit();
						return false;
					}});
					$("#loginName").formValidator({onShow:"",onFocus:"会员账号应该为5-16字母、数字或下划线",onCorrect:"输入正确"}).inputValidator({min:5,max:16,onError:"会员账号应该为5-16字母、数字或下划线"}).regexValidator({
					regExp:"username",dataType:"enum",onError:"会员账号格式错误"
					}).ajaxValidator({
					dataType : "json",
					async : true,
					url : "<?php echo U('Admin/Users/checkLoginKey');?>",
					success : function(data){
					var json = WST.toJson(data);
					if( json.status == "1" ) {
					return true;
					} else {
					return false;
					}
					return "该账号已被使用";
					},
					buttons: $("#dosubmit"),
					onError : "该账号已存在。",
					onWait : "请稍候..."
					}).defaultPassed();
					$("#userName").formValidator({
					onShow:"",onFocus:"请输入真实用户名"
					}).inputValidator({
					min:1,max:50,onError:"请输入正确的用户名"
					});
					$("#loginPwd").formValidator({
					onShow:"",onFocus:"登录密码长度应该为5-20位之间"
					}).inputValidator({
					min:5,max:50,onError:"登录密码长度应该为5-20位之间!!!"
					});
					$("#userPhone").formValidator({
					onShow:"",onFocus:"请输入正确的手机号"
					}).inputValidator({min:11,max:11,onError:"你输入的手机号码非法,请确认"}).regexValidator({
					regExp:"mobile",dataType:"enum",onError:"手机号码格式错误"
					}).ajaxValidator({
					dataType : "json",
					async : true,
					url : "<?php echo U('Admin/Users/checkLoginKey');?>",
					success : function(data){
					var json = WST.toJson(data);
					if( json.status == "1" ) {
					return true;
					} else {
					return false;
					}
					return "该手机号码已被使用";
					},
					buttons: $("#dosubmit"),
					onError : "该手机号码已存在。",
					onWait : "请稍候..."
					}).defaultPassed();
					$("#userIdcard").formValidator({
					onShow:"",onFocus:"请输入正确的身份证号"
					}).inputValidator({min:17,max:18,onError:"你输入的身份证号码非法,请确认"}).regexValidator({
					regExp:"idcard",dataType:"enum",onError:"身份证号码格式错误"
					}).ajaxValidator({
					dataType : "json",
					async : true,
					url : "<?php echo U('Admin/Users/checkLoginKey');?>",
					success : function(data){
					var json = WST.toJson(data);
					if( json.status == "1" ) {
					return true;
					} else {
					return false;
					}
					return "该身份证号码已被使用";
					},
					buttons: $("#dosubmit"),
					onError : "该身份证号码已存在。",
					onWait : "请稍候..."
					}).defaultPassed();
					$("#userWebchat").formValidator({
					onShow:"",onFocus:"请输入正确的微信号"
					}).inputValidator({min:1,onError:"请输入微信号"}).ajaxValidator({
					dataType : "json",
					async : true,
					url : "<?php echo U('Admin/Users/checkLoginKey');?>",
					success : function(data){
					var json = WST.toJson(data);
					if( json.status == "1" ) {
					return true;
					} else {
					return false;
					}
					return "该微信号码已被使用";
					},
					buttons: $("#dosubmit"),
					onError : "该微信号码已存在。",
					onWait : "请稍候..."
					}).defaultPassed();
					$("#userEmail").inputValidator({min:0,max:25,onError:"你输入的邮箱长度非法,请确认"}).regexValidator({
					regExp:"email",dataType:"enum",onError:"邮箱格式错误"
					}).ajaxValidator({
					dataType : "json",
					async : true,
					url : "<?php echo U('Admin/Users/checkLoginKey');?>",
					success : function(data){
					var json = WST.toJson(data);
					if( json.status == "1" ) {
					return true;
					} else {
					return false;
					}
					return "该电子邮箱已被使用";
					},
					buttons: $("#dosubmit"),
					onError : "该账号已存在。",
					onWait : "请稍候..."
					}).defaultPassed().unFormValidator(true);

					$("#userQQ").formValidator({
					empty:true,onShow:"",onFocus:"QQ号码只能是数字"
					}).regexValidator({
					regExp:"num1",dataType:"enum",onError:"QQ号码格式错误"
					});

					$("#userPhone").blur(function(){
					if($("#userPhone").val()==''){
					$("#userPhone").unFormValidator(true);
					}else{
					$("#userPhone").unFormValidator(false);
					}
					});
					$("#userEmail").blur(function(){
					if($("#userEmail").val()==''){
					$("#userEmail").unFormValidator(true);
					}else{
					$("#userEmail").unFormValidator(false);
					}
					});
				});
				function edit(){
					var params = {};
					params.loginName = $.trim($('#loginName').val());
					params.loginPwd = $.trim($('#loginPwd').val());
					params.userName = $.trim($('#userName').val());
					params.userQQ = $.trim($('#userQQ').val());
					params.userIdcard = $.trim($('#userIdcard').val());
					params.userWebchat = $.trim($('#userWebchat').val());
					params.userStatus = $('input[name="userStatus"]:checked').val();
					params.userPhone = $.trim($('#userPhone').val());
					params.userSex = $('input[name="userSex"]:checked').val();
					params.userSex = 1;
					params.userEmail = $.trim($('#userEmail').val());
					params.level = $.trim($('#level').val());
					params.bdiraction = $.trim($('#bdiraction').val());
					params.parentId = $.trim($('#parentId').val());
					params.recommendId = $.trim($('#recommendId').val());
					Plugins.waitTips({title:'信息提示',content:'正在提交数据，请稍后...'});
					$.post("<?php echo U('Home/Members/add');?>",params,function(data,textStatus){
						var json = WST.toJson(data);
						if(json.status=='1'){
							Plugins.setWaitTipsMsg({ content:'操作成功',timeout:1000,callback:function(){
								location.href='<?php echo U("Home/Members/recommendAtlas");?>';
							}});
						}else if(json.status=='-2'){
							Plugins.setWaitTipsMsg({content:'用户手机,微信号码或邮箱已存在!',timeout:1000});
						}else{
							Plugins.closeWindow();
							Plugins.Tips({title:'信息提示',icon:'error',content:'操作失败!',timeout:1000});
						}
					});
				}
			</script><?php endif; ?>
</html>