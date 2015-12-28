<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html lang="zh-cn">
	<head>
  		<meta charset="utf-8">
      	<meta http-equiv="X-UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
      	<title>店铺街 - <?php echo ($CONF['mallTitle']); ?></title>
      	<meta name="keywords" content="<?php echo ($CONF['mallKeywords']); ?>" />
      	<meta name="description" content="<?php echo ($CONF['mallDesc']); ?>,切换城市" />
      	<link rel="stylesheet" href="/wstmall/Apps/Home/View/default/css/common.css" />
     	<link rel="stylesheet" href="/wstmall/Apps/Home/View/default/css/base.css" />
		<link rel="stylesheet" href="/wstmall/Apps/Home/View/default/css/head.css" />
   	</head>
   	<body>
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

<div style="height:132px;">
<div id="mainsearchbox" style="text-align:center;">
	<div id="wst-search-pbox">
		<div style="float:left;width:1240px;" class="wst-header-car">
		  <a href='<?php echo WSTDomain();?>'>
			<img id="wst-logo" width='1240' height='132' src="<?php echo WSTDomain();?>/<?php echo ($CONF['mallLogo']); ?>"/>
		  </a>
		</div>
		<!--<div id="wst-search-container">-->
			<!--<div id="wst-search-type-box">-->
				<!--<input id="wst-search-type" type="hidden" value="<?php echo ($searchType); ?>"/>-->
				<!--<div id="wst-panel-goods" class="<?php if($searchType == 1): ?>wst-panel-curr<?php else: ?>wst-panel-notcurr<?php endif; ?>">商品</div>-->
				<!--<div id="wst-panel-shop" class="<?php if($searchType == 2): ?>wst-panel-curr<?php else: ?>wst-panel-notcurr<?php endif; ?>">店铺</div>-->
				<!--<div class="wst-clear"></div>-->
			<!--</div>-->
			<!--<div id="wst-searchbox">-->
				<!--<input id="keyword" class="wst-search-keyword" data="wst_key_search" onkeyup="getSearchInfo(this,event);" placeholder="<?php if($searchType == 2): ?>搜索 店铺<?php else: ?>搜索 商品<?php endif; ?>" autocomplete="off"  value="<?php echo ($keyWords); ?>">-->
				<!--<div id="btnsch" class="wst-search-button">搜&nbsp;索</div>-->
				<!--<div id="wst_key_search_list" style="position:absolute;top:38px;left:-1px;border:1px solid #b8b8b8;min-width:567px;display:none;background-color:#ffffff;z-index:1000;">dfdf</div>-->
			<!--</div>-->
			<!--<div id="wst-hotsearch-keys">-->
				<!--<?php if(is_array($CONF['hotSearchs'])): $k = 0; $__LIST__ = $CONF['hotSearchs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>-->
				<!--<a href="<?php echo U('Home/goods/getGoodsList',array('keyWords'=>$vo));?>"><?php echo ($vo); ?></a><?php if($k < count($CONF['hotSearchs'])): ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?>-->
				<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
			<!--</div>-->
		<!--</div>-->
		<!--<div id="wst-search-des-container">-->
			<!--<div class="des-box">-->
				<!--<div class='wst-reach'>-->
					<!--<img src="/wstmall/Apps/Home/View/default/images/sadn.jpg"  height="38" width="40"/>-->
					<!--<div style="float:left;position:absolute;top:0px;left:38px;"><span style="font-weight:bolder;">闪电配送</span><br/><span style="color:#e23c3d;">最快1小时送达</span></div>-->
				<!--</div>-->
				<!--<div class='wst-since'>-->
					<!--<img src="/wstmall/Apps/Home/View/default/images/sqzt.jpg"  height="38" width="40"/>-->
					<!--<div style="float:left;position:absolute;top:0px;left:38px;"><span style="font-weight:bolder;">社区自提</span><br/><span style="color:#e23c3d;">330家自提点</span></div>-->
				<!--</div>-->
			<!--</div>-->
		<!--</div>-->
	</div>
</div>
</div>
<div class="headNav">
		  <div class="navCon w1020">
		  	<div class="wst-slide-controls">
		  		<?php if(is_array($indexAds)): $k = 0; $__LIST__ = $indexAds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($k == 1): ?><span class="curr"><?php echo ($k); ?></span>
		  		  	<?php else: ?>
		  		    	<span class=""><?php echo ($k); ?></span><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
		    <div class="navCon-cate fl navCon_on" >
		      <div class="navCon-cate-title"> <a href="<?php echo U('Home/goods/getGoodsList');?>">全部商品分类</a></div>
		      
		      	<?php if($ishome == 1): ?><div class="cateMenu1" >
		      	<?php else: ?>
		      		<div class="cateMenu2" style="display:none;" ><?php endif; ?>
		        <div id="wst-nvg-cat-box" style="position:relative;">
		        	<div class="wst-nvgbk" style="diplay:none;"></div>
		        	<?php $_result=WSTGoodsCats();if(is_array($_result)): $k1 = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($k1 % 2 );++$k1; if($k1 < 7): ?><li class="wst-nvg-cat-nlt6" style="border-top: none;" >
				    	<?php else: ?>
				    	<li class="wst-nvg-cat-gt6" style="border-top: none;display:none;" ><?php endif; ?>
				    	<div>
				            <div class="cate-tag"> 
				            <div class="listModel">
				             <p > 
				            	<strong><s<?php echo ($k1); ?>></s<?php echo ($k1); ?>>&nbsp;<a style="font-weight:bold;" href="<?php echo U('Home/goods/getGoodsList',array('c1Id'=>$vo1['catId']));?>"><?php echo ($vo1["catName"]); ?></a></strong>
				             </p> 
				             </div>
				              <div class="listModel">
				                <p> 
				                <?php if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2;?><a href="<?php echo U('Home/goods/getGoodsList',array('c1Id'=>$vo1['catId'],'c2Id'=>$vo2['catId']));?>"><?php echo ($vo2["catName"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				                </p>
				              </div>
				            </div>
				            <div class="list-item hide">
				              <ul class="itemleft">
				              	<?php if(is_array($vo1['catChildren'])): $k2 = 0; $__LIST__ = $vo1['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($k2 % 2 );++$k2;?><dl>
				                  <dt><a href="<?php echo U('Home/goods/getGoodsList',array('c1Id'=>$vo1['catId'],'c2Id'=>$vo2['catId']));?>"><?php echo ($vo2["catName"]); ?></a></dt>
				                  <dd> 
				                  <?php if(is_array($vo2['catChildren'])): $k3 = 0; $__LIST__ = $vo2['catChildren'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($k3 % 2 );++$k3;?><a href="<?php echo U('Home/goods/getGoodsList',array('c1Id'=>$vo1['catId'],'c2Id'=>$vo2['catId'],'c3Id'=>$vo3['catId']));?>"><?php echo ($vo3["catName"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				                  </dd>
				                </dl>
				                <div class="fn-clear"></div><?php endforeach; endif; else: echo "" ;endif; ?>
				              </ul>
				            </div>
				            </div>
				  		</li><?php endforeach; endif; else: echo "" ;endif; ?>
		          	
		          	<li style="display:none;"></li>
		        </div>
		      </div>
		    </div>
		    
		    <div class="navCon-menu fl">
		      <ul class="fl">
		        <?php $_result=WSTNavigation(0);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li ><a href="<?php echo ($vo['navUrl']); ?>" <?php if($vo['isOpen'] == 1): ?>target="_blank"<?php endif; ?> <?php if($vo['active'] == 1): ?>class="curMenu"<?php endif; ?>>&nbsp;&nbsp;<?php echo ($vo['navTitle']); ?>&nbsp;&nbsp;</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		      </ul>
		    </div>
		    <li id="wst-nvg-cart">
		    	<div class='wst-nvg-cart-cost'>
		       		&nbsp;<span class="wst-nvg-cart-cnt">0</span>件&nbsp;|&nbsp;<span class="wst-nvg-cart-price">0.00</span>元
		       	</div>
			</li>
			<div class="wst-cart-box"><div class="wst-nvg-cart-goods">购物车中暂无商品</div></div>
		  </div>
		</div>
		<script>
		$(function(){
			checkCart();
		});
		</script>

		<!----加载商品楼层start----->
		<div class="wst-container">
			<div class="wst-shadow">
				<div class="other-main">
            <div class="hot-cities">
                <h2>进入<a href="javascript:;" onclick="changeCity(<?php echo ($area['areaId']); ?>);"><?php echo ($area["areaName"]); ?></a></h2>
                <div class="shortcut">
                
                    <span>按省份选择：</span>
                    <div class="shortcut-select shortcut-select-p">
                        <!--  div class="ss-value"><em pid="17">湖南</em><i class="triangle"></i></div> -->
                        <select id="provinceId" onchange="getCitys(this);">
                        	<?php if(is_array($provinceList)): $k = 0; $__LIST__ = $provinceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$province): $mod = ($k % 2 );++$k;?><option <?php if($province['areaId'] == $area['parentId']): ?>selected<?php endif; ?> value="<?php echo ($province['areaId']); ?>"><?php echo ($province["areaName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="shortcut-select shortcut-select-city">
                        <select id="cityId">
                        	<option>选择城市</option>
                        </select>
                    </div>    
                    <input type="button" class="button" value="确 定" onclick="changeCity();">
                </div>
                
            </div>
            <div class="citys-listbox">
                <div class="select-py">
                    <span>按拼音首字母选择：</span>
                    <a href="javascript:void(0);" onclick="letter_scroll('A')">A</a><a href="javascript:void(0);" onclick="letter_scroll('B')">B</a><a href="javascript:void(0);" onclick="letter_scroll('C')">C</a><a href="javascript:void(0);" onclick="letter_scroll('D')">D</a><a href="javascript:void(0);" onclick="letter_scroll('E')">E</a><a href="javascript:void(0);" onclick="letter_scroll('F')">F</a><a href="javascript:void(0);" onclick="letter_scroll('G')">G</a><a href="javascript:void(0);" onclick="letter_scroll('H')">H</a><a href="javascript:void(0);" onclick="letter_scroll('I')">I</a><a href="javascript:void(0);" onclick="letter_scroll('J')">J</a><a href="javascript:void(0);" onclick="letter_scroll('K')">K</a><a href="javascript:void(0);" onclick="letter_scroll('L')">L</a><a href="javascript:void(0);" onclick="letter_scroll('M')">M</a><a href="javascript:void(0);" onclick="letter_scroll('N')">N</a><a href="javascript:void(0);" onclick="letter_scroll('O')">O</a><a href="javascript:void(0);" onclick="letter_scroll('P')">P</a><a href="javascript:void(0);" onclick="letter_scroll('Q')">Q</a><a href="javascript:void(0);" onclick="letter_scroll('R')">R</a><a href="javascript:void(0);" onclick="letter_scroll('S')">S</a><a href="javascript:void(0);" onclick="letter_scroll('T')">T</a><a href="javascript:void(0);" onclick="letter_scroll('U')">U</a><a href="javascript:void(0);" onclick="letter_scroll('V')">V</a><a href="javascript:void(0);" onclick="letter_scroll('W')">W</a><a href="javascript:void(0);" onclick="letter_scroll('X')">X</a><a href="javascript:void(0);" onclick="letter_scroll('Y')">Y</a><a href="javascript:void(0);" onclick="letter_scroll('Z')">Z</a>                </div>
            <div class="citys-list">
           		<?php if(is_array($cityList)): foreach($cityList as $k=>$citys): ?><dl id="c_<?php echo ($k); ?>" onmouseover="$(this).addClass('hover')" onmouseout="$(this).removeClass('hover')" class="">
                    <dt><?php echo ($k); ?></dt>
                    <dd>
                    	<?php if(is_array($citys)): $k2 = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($k2 % 2 );++$k2;?><a href="javascript:;" onclick="changeCity(<?php echo ($city['areaId']); ?>);"><?php echo ($city["areaName"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>          
                  	</dd>
                </dl><?php endforeach; endif; ?> 
            </div>
        </div>
        </div>
			</div>
		</div>
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

		<link rel="stylesheet" type="text/css" href="/wstmall/Apps/Home/View/default/css/cart.css" />
<script src="/wstmall/Apps/Home/View/default/js/userlogin.js"></script>
<script type="text/javascript" src="/wstmall/Apps/Home/View/default/js/cart/common.js?v=725"></script>
<script type="text/javascript" src="/wstmall/Apps/Home/View/default/js/cart/quick_links.js"></script>
<!--[if lte IE 8]>
<script src="/wstmall/Apps/Home/View/default/js/cart/ieBetter.js"></script>
<![endif]-->
<script src="/wstmall/Apps/Home/View/default/js/cart/parabola.js"></script>
<!--右侧贴边导航quick_links.js控制-->
	<div id="flyItem" class="fly_item" style="display:none;">
		<p class="fly_imgbox">
		<img src="/wstmall/Apps/Home/View/default/images/item-pic.jpg"
			width="30" height="30">
		</p>
	</div>
	<div class="mui-mbar-tabs">
		<div class="quick_link_mian">
			<div class="quick_links_panel">
				<div id="quick_links" class="quick_links">
					<li><a href="#" class="my_qlinks" style="margin-top: 5px;"><i class="setting"></i></a>
						<div class="ibar_login_box status_login">
							<?php if($WST_USER['userId'] > 0): ?><div class="avatar_box">
								<p class="avatar_imgbox">
									<img
										src="/wstmall/Apps/Home/View/default/images/no-img_mid_.jpg" />
								</p>
								<?php if($WST_USER['userId'] > 0): ?><ul class="user_info">
									<li>用户名：<?php echo ($WST_USER['loginName']); ?></li>
									<li>级&nbsp;别：普通会员</li>
								</ul><?php endif; ?>
							</div>
							
							<div class="ibar_recharge-btn">
								<input type="button" value="我的订单" onclick="getMyOrders();"/>
							</div>
							<i class="icon_arrow_white"></i>
						</div> <?php else: ?>
							<div style="margin: 0 auto;padding: 15px 0; width: 220px;">
							<div class="ibar_recharge-field">
								<label>帐号</label>
								<div class="ibar_recharge-fl">
									<div class="ibar_recharge-iwrapper">
										<input id="loginName" name="loginName" value="<?php echo ($loginName); ?>" type="text" name="19" placeholder="用户名/手机号/邮箱" />
									</div>
									<i class="ibar_username-contact"></i>
								</div>
							</div>
							<div class="ibar_recharge-field">
								<label>密码</label>
								<div class="ibar_recharge-fl">
									<div class="ibar_recharge-iwrapper">
										<input id="loginPwd" name="loginPwd" type="password" name="19" placeholder="密码" />
									</div>
									<i class="ibar_password-contact"></i>
								</div>
							</div>
							<div class="ibar_recharge-field">
								<label>验证码</label>
								<div class="ibar_recharge-fl" style="width:80px;">
									<div class="ibar_recharge-iwrapper">
										<input id="verify" style="ime-mode:disabled;width:80px;" name="verify" class="text text-1" tabindex="6" autocomplete="off" maxlength="6" type="text" placeholder="验证码"/>
									</div>
								</div>
								<label class="img" onclick="javascript:getVerify()">
				                	<img style='vertical-align:middle;cursor:pointer;height:30px;width:93px;' class='verifyImg' src='/wstmall/Apps/Home/View/default/images/clickForVerify.png' title='刷新验证码' onclick='javascript:getVerify()'/> 
								</label>
							</div>
							<div class="ibar_recharge-btn">
								<input type="button" value="登录" onclick="checkLoginInfo();"/>
							</div>
							</div><?php endif; ?></li>
					<li id="shopCart"><a href="#" class="message_list"><i class="message"></i>
					<div class="span">购物车</div> <span class="cart_num">0</span></a></li>
					<!--<?php if($CONF['qqNo'] != ''): ?>-->
					<!--<li>-->
						<!--<a href="tencent://message/?uin=<?php echo ($CONF['qqNo']); ?>&Site=QQ交谈&Menu=yes" style="padding-top:5px;padding-bottom:5px;margin-bottom: 5px;">-->
						<!--<img src="/wstmall/Apps/Home/View/default/images/qq.jpg"  height="38" width="40" />-->
						<!--</a>-->
					<!--</li>-->
					<!--<?php endif; ?>-->
					
				</div>
				<!--<div class="quick_toggle">-->
					<!--<li><a href="#none"><i class="mpbtn_qrcode"></i></a>-->
						<!--<div class="mp_qrcode" style="display: none;">-->
							<!--<img-->
								<!--src="/wstmall/Apps/Home/View/default/images/wstmall_weixin.png"-->
								<!--width="148"  /><i class="icon_arrow_white"></i>-->
						<!--</div>-->
					<!--</li>-->
					<!-- -->
					<!--<li><a href="#top" class="return_top"><i class="top"></i></a></li>-->
				<!--</div>-->
			</div>
			<div id="quick_links_pop" class="quick_links_pop hide"></div>
		</div>
	</div>
	<script type="text/javascript">
	var numberItem = <?php echo WSTCartNum();?>;
	$('.cart_num').html(numberItem);
	$(".quick_links_panel li").mouseenter(function() {
		getVerify();
		$(this).children(".mp_tooltip").animate({
			left : -92,
			queue : true
		});
		$(this).children(".mp_tooltip").css("visibility", "visible");
		$(this).children(".ibar_login_box").css("display", "block");
	});
	$(".quick_links_panel li").mouseleave(function() {
		$(this).children(".mp_tooltip").css("visibility", "hidden");
		$(this).children(".mp_tooltip").animate({
			left : -121,
			queue : true
		});
		$(this).children(".ibar_login_box").css("display", "none");
	});
	$(".quick_toggle li").mouseover(function() {
		$(this).children(".mp_qrcode").show();
	});
	$(".quick_toggle li").mouseleave(function() {
		$(this).children(".mp_qrcode").hide();
	});

	// 元素以及其他一些变量
	var eleFlyElement = document.querySelector("#flyItem"), eleShopCart = document
			.querySelector("#shopCart");
	eleFlyElement.style.visibility = "hidden";
	
	var numberItem = 0;
	// 抛物线运动
	var myParabola = funParabola(eleFlyElement, eleShopCart, {
		speed : 100, //抛物线速度
		curvature : 0.0012, //控制抛物线弧度
		complete : function() {
			eleFlyElement.style.visibility = "hidden";
			jQuery.post(domainURL +"/index.php/Home/Cart/getCartGoodCnt/" ,{"axm":1},function(data) {
				var cart = WST.toJson(data);
				eleShopCart.querySelector("span").innerHTML = cart.goodscnt;
			});
			
		}
	});
	// 绑定点击事件
	if (eleFlyElement && eleShopCart) {
		[].slice
				.call(document.getElementsByClassName("btnCart"))
				.forEach(
						function(button) {
							button
									.addEventListener(
											"click",
											function(event) {
												// 滚动大小
												var scrollLeft = document.documentElement.scrollLeft
														|| document.body.scrollLeft
														|| 0, scrollTop = document.documentElement.scrollTop
														|| document.body.scrollTop
														|| 0;
												eleFlyElement.style.left = event.clientX
														+ scrollLeft + "px";
												eleFlyElement.style.top = event.clientY
														+ scrollTop + "px";
												eleFlyElement.style.visibility = "visible";
												$(eleFlyElement).show();
												// 需要重定位
												myParabola.position().move();
											});
						});
	}

	function getMyOrders(){
		document.location.href = "<?php echo U('Home/Orders/queryByPage/');?>";
	}
</script>
   	</body>
   	
   	<script src="/wstmall/Apps/Home/View/default/js/shopstreet.js"></script>
	<script src="/wstmall/Public/js/common.js"></script>
	<script src="/wstmall/Apps/Home/View/default/js/head.js" type="text/javascript"></script>
	<script src="/wstmall/Apps/Home/View/default/js/common.js" type="text/javascript"></script>

	<script type="text/javascript">
	    var changecity_cityinfo;
	    var cities = new Array();
	    var city_pinyins = new Array();
	    var city_first_chart=[["a","b","c","d"],["e","f","g","h","i","j"],["k","l","m","n"],["o","p","q","r","s","t"],["u","v","w","x","y","z"]];
	    $(document).ready(function () {
	    	getCitys();
	    	$(window).unbind('scroll');
	    });
	    function getCitys(){
	    	var provinceId = $("#provinceId").val();
	    	jQuery.post("<?php echo U('Home/Areas/getCityListByProvince/');?>",{provinceId:provinceId},function(rsp) {
	    		var json = WST.toJson(rsp);
	    		var citys = new Array();
	    		
	    		for(var i=0;i<json.length;i++){
	    			var city = json[i];
	    			if(city.areaId=='<?php echo ($areaId2); ?>'){
	    				citys.push("<option value='"+city.areaId+"' selected>"+city.areaName+"</option>");
	    			}else{
	    				citys.push("<option value='"+city.areaId+"'>"+city.areaName+"</option>");
	    			}
	    		}
	    		if(!json.length){
	    			citys.push("<option>选择城市</option>");
	    		}
	    		$("#cityId").html(citys.join(""));
	    	});
	    }
	    
	    
	    /**
	    * 字母页面内链
	    */
	    function letter_scroll(letter) {
	        var obj = $("#c_" + letter);
	        if(obj && obj.offset()){
	       		$('html,body').animate({ scrollTop: obj.offset().top }, 500);
	        }
	    }
	
	</script>
	   	
</html>