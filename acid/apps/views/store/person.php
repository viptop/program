<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
    	<meta name="author" content="m.jd.com">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	    <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/persons/css/base2013.css') ?>" charset="gbk">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/persons/css/myhome1.01.css') ?>" charset="gbk">
		<script type="text/javascript" src="<?php echo base_url('static/persons/js/jquery-1.6.2.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('static/persons/js/spin.min.js') ?>"></script><style></style>
		
		<!-- 对url处理 -->
		<script type="text/javascript" src="<?php echo base_url('static/persons/js/ojbUrl.js') ?>"></script>
		
		<!--数据埋点-->
		<script type="text/javascript" src="<?php echo base_url('static/persons/js/pingJS.1.0.js') ?>"></script>
		
		<!--通用头尾css js add by lizhenyou 2015-4-17-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/persons/css/header.css') ?>" charset="utf-8">

	<script type="text/javascript" src="<?php echo base_url('static/persons/js/m_common.js') ?>"></script>
	<link rel="stylesheet" type="text/css" charset="utf-8" href="<?php echo base_url('static/persons/css/header(1).css') ?>">
	<script type="text/javascript" src="<?php echo base_url('static/persons/js/downloadAppPlugIn.js') ?>"></script></head>

<body id="body">
<a name="top"></a>
<header>
		
		<!-- 通用头 div -->
		<div id="m_common_header" style="min-height:45px;"><header class="jd-header">    <div class="jd-header-bar">        <div id="m_common_header_goback" class="jd-header-icon-back"><a href="javascript:history.back()"><span>  </span></a></div>        <div class="jd-header-title">个人中心</div>           </div>    <ul id="m_common_header_shortcut" class="jd-header-shortcut" style="display: none;">        <li id="m_common_header_shortcut_m_index">            <a class="J_ping" report-eventid="MCommonHead_home" report-eventparam="" page_name="" href="">                <span class="shortcut-home"></span>                <strong>首页</strong>            </a>        </li>        <li class="J_ping" report-eventid="MCommonHead_CategorySearch" report-eventparam="" page_name="" id="m_common_header_shortcut_category_search">            <a href="">                <span class="shortcut-categories"></span>                <strong>分类搜索</strong>            </a>        </li>        <li class="J_ping" report-eventid="MCommonHead_Cart" report-eventparam="" page_name="" id="m_common_header_shortcut_p_cart">            <a href="" id="html5_cart">                <span class="shortcut-cart"></span>                <strong>购物车</strong>            </a>        </li>        <li id="m_common_header_shortcut_h_home" class=" current">            <a class="J_ping" report-eventid="MCommonHead_MYJD" report-eventparam="" page_name="" href="">                <span class="shortcut-my-account"></span>                <strong>我的商城</strong>            </a>        </li>    </ul></header></div>

	</header>

<style type="text/css">
	.current-half-width li{width:50% !important;}
</style>

<div class="common-wrapper">

	    <div class="head-img">
			<!-- <span class="my-img" style="background-image:url('images/defaul.png')"></span> -->
			<img class="my-img" src="<?php echo $one[0]->headimg ?>" />
            <p class="p-black"> <?php echo $one[0]->nina ?> </p>
    		<p class="p-black">会员积分：<?php echo $ticket ?></p>
    	</div>
		
<!-- 	    <ul class="padding-list current-half-width">
    		<li>
    			<a id="waite4Payment" href="">
    				<p id="waite4PaymentSum">0</p>
    				<p>待付款</p>
    			</a>
    		</li>
    		<li>
    			<a id="waitDeliveryOrderList" href="">
    				<p id="waitDeliveryOrderListSum">0</p>
    				<p>待确认收货</p>
    			</a>
    		</li>
		</ul> -->
	
<!-- 	    	        	<ul class="menu-list">
        			    <li>
                			<a id="quanbudingdan" href="">
        						<img src="images/547bc6b5Ncc52a3b8.png" alt="">
                				<p>全部订单</p>
                			</a>
                		</li>
        				
        			    <li>
                			<a id="wodeqianbao" href="">
        						<img src="images/547bc6dbN3dabf32a.png" alt="">
                				<p>我的账户</p>
                			</a>
                		</li>
        				
        			    <li>
                			<a id="liulanjilu" href="">
        						<img src="images/547bc70aNf7e3462a.png" alt="">
                				<p>浏览记录</p>
                			</a>
                		</li>
        				
        			    <li>
                			<a id="wodeguanzhu" href="">
        						<img src="images/547bc6eaN6c97383c.png" alt="">
                				<p>我的关注</p>
                			</a>
                		</li> -->
        				
        			    <!--<li>-->
                			<!--<a id="fuwuguanjia" href="">-->
        						<!--<img src="images/547bc727Nde7da59c.png" alt="">-->
                				<!--<p>服务管家</p>-->
                			<!--</a>-->
                		<!--</li>-->
        				<!---->
        			        				<!--<li>-->
                			<!--<a id="zhanghuguanli" href="">-->
        						<!--<img src="images/547bc742N95a14876.png" alt="">-->
                				<!--<p>账户管理</p>-->
                			<!--</a>-->
                		<!--</li>-->
        				<!---->
        			        				<!--<li>-->
                			<!--<a id="wodeyuyue" href="">-->
        						<!--<img src="images/547bc75fNc5c6209c.png" alt="">-->
                				<!--<p>我的预约</p>-->
                			<!--</a>-->
                		<!--</li>-->
        				<!---->
        			        				<!--<li>-->
                			<!--<a id="yingyongtuijian" href="">-->
        						<!--<img src="images/547bc772Nbdf299f1.png" alt="">-->
                				<!--<p>应用推荐</p>-->
                			<!--</a>-->
                		<!--</li>-->
        				<!---->
        			        	<!-- </ul> -->
			

            <ul class="couponIn-list">
    			    <li>
    					<a id="" href="<?php echo site_url('homes/orders') ?>">
                            <div class="couponIn-item">
                                <div class="couponIn-icon"><img src="<?php echo base_url('static/persons/images/55546b06Nbd7a17eb.png') ?>"></div>
                                <div class="couponIn-item-info">
                                    <span class="info-title">查看订单</span>
                                    <span class="info-hint"></span>
                                </div>
                            </div>
						</a><hr/>

						<a id="" href="<?php echo site_url('homes/records') ?>">
							<div class="couponIn-item">
								<div class="couponIn-icon"><img src="<?php echo base_url('static/persons/images/55546b06Nbd7a17eb.png') ?>"></div>
								<div class="couponIn-item-info">
									<span class="info-title">订单记录</span>
									<span class="info-hint"></span>
								</div>
							</div>
						</a><hr/>

						<a id="" href="<?php echo site_url('homes/addList') ?>">
							<div class="couponIn-item">
								<div class="couponIn-icon"><img src="<?php echo base_url('static/persons/images/55546b06Nbd7a17eb.png') ?>"></div>
								<div class="couponIn-item-info">
									<span class="info-title">我的收货地址</span>
									<span class="info-hint"></span>
								</div>
							</div>
						</a>
                    </li>
    		</ul>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/persons/css/guessing.css') ?>" charset="utf-8">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/persons/css/list.css') ?>" charset="utf-8">

<script type="text/javascript" src="<?php echo base_url('static/persons/js/jdslider.src.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('static/persons/js/news1.0.js') ?>"></script>

<script type="text/javascript">

$(document).ready(function(){
	showHeadInfo();

    $('#guessing').jdSlider({
        lineNum:2,
        fitToScreen:true
    });
	
});

//显示头信息
var showHeadInfo = function(){
	var t = (new Date()).valueOf();
	
	jQuery.get('/myJd/showHeadInfo.json?t=' + t,
		{},
        function(data){
			if(data){
    			var waite4PaymentSum = data.waite4PaymentSum;
    			var waitDeliveryOrderListSum = data.waitDeliveryOrderListSum;
    			var infoCount = data.infoCount;
				
				$('#waite4PaymentSum').html(waite4PaymentSum);
				$('#waitDeliveryOrderListSum').html(waitDeliveryOrderListSum);
				$('#infoCount').html(infoCount);
				
				/*
				if(infoCount > 0){
					$('#unread-msg-point').addClass('unread-msg');
				}else{
					$('#unread-msg-point').removeClass('unread-msg');
				}
				*/
				
			}
	 },'json');
}

//显示商品详情
var showProductDetail = function(wareId,sid,clk,meObj){
	
	//alert('MMyJD_GuessYouLike' + " | " + wareId + " | " + urlRemoveParam(meObj.href,'sid'));
	pingClick(true, 'MMyJD_GuessYouLike', wareId, urlRemoveParam(meObj.href,'sid'), '');

	//埋点 猜猜你喜欢
	//可能网络原因 ajax 访问服务器的时间过长或者是网络问题，可能引起跳转失败,所以现在是 a标签上 增加onclick方式.
	jQuery.get('/myJd/loveProductDetail.json',
		{ 'wareId': wareId , 'sid' : sid, 'clk' : clk},
        function(data){

	});
	
}

$(document).ready(function(){
	//埋点
	var pingObject = [
	{
		id:'waite4Payment',
		eventId:'MMyJD_Ordersnotpay'
	},{
		id:'waitDeliveryOrderList',
		eventId:'MMyJD_Ordersnotreceiving'
	},{
		id:'myMessage',
		eventId:'MMyJD_MyMessages'
	},{
		id:'quanbudingdan',
		eventId:'MMyJD_AllOrders'
	},{
		id:'wodeqianbao',
		eventId:'MMyJD_MyPurse'
	},{
		id:'wodeguanzhu',
		eventId:'MMyJD_MyFollows'
	},{
		id:'liulanjilu',
		eventId:'MMyJD_BrowserHistory'
	},{
		id:'fuwuguanjia',
		eventId:'MMyJD_ServiceManager'
	},{
		id:'zhanghuguanli',
		eventId:'MMyJD_AccountManager'
	},{
		id:'wodeyuyue',
		eventId:'MMyJD_MyAppointment'
	},{
		id:'yingyongtuijian',
		eventId:'MMyJD_ApplicationRecommend'
	},{
		id:'wodebigouma',
		eventId:'MMyJD_JCode'
	}];
	
  	jQuery.each(pingObject, function(i,n){      
	  
		var jObj = $("#" + n.id);
	
	  	jObj.bind("click",function(){
			var href = jObj.attr("href").trim();
			//alert(n.eventId + " | " + urlRemoveParam(href,'sid'));
	  		pingClick(true, n.eventId, '', urlRemoveParam(href,'sid'), '');
		
      	});
  	});

});

</script>

    
	<!-- 通用尾 div -->
	<div id="m_common_bottom" style="min-height:170px;"><footer id="m_common_bottom_jd_footer" class="jd-footer">	<div class="jd-1px-line-up"></div>    <ul class="jd-footer-links">        <li class=""><a class="J_ping" report-eventid="MCommonHTail_Account" report-eventparam="" page_name="" rel="nofollow" href=""> query </a></li>        <li><a class="J_ping" report-eventid="MCommonHTail_Exit" report-eventparam="" page_name="" rel="nofollow" href="">退出</a></li>        <li><a class="J_ping" report-eventid="MCommonHTail_Feedback" report-eventparam="" page_name="" rel="nofollow" href="">反馈</a></li>        <li><a class="J_ping" report-eventid="MCommonHTail_ToTop" report-eventparam="" page_name="" rel="nofollow" href="javascript:scrollTo(0,0);">回到顶部</a></li>    </ul><div class="jd-1px-line-up"></div>    <ul class="jd-footer-platforms"><li id="m_common_bottom_apps" class="jd-footer-icon-apps"><a class="badge" "="" report-eventid="MCommonHTail_ClientApp" report-eventparam="" page_name="">客户端</a></li><li id="m_common_bottom_touchscreen" class="jd-footer-icon-touchscreen current"><a class="J_ping" report-eventid="MCommonHTail_TouchEdition" report-eventparam="" page_name="">触屏版</a></li><li id="m_common_bottom_pc" class="jd-footer-icon-pc"><a class="J_ping" report-eventid="MCommonHTail_PCEdition" report-eventparam="" page_name="">电脑版</a></li>    </ul><div class="jd-1px-line-up"></div><div class="jd-footer-copyright">Copyright © 2017 版权所有 </div></footer></div>



    <div style="display:none;">
        </div>

<script type="text/javascript">
var jap = {
    siteId : 'MO-J2011-1',
    topic: 'traffic-jdm',
    account : '',
    skuid: '',
    shopid: '',
    orderid: '',
    adsCookieName: 'mt_subsite',
    jumpAppEnable : 1,
    __cookie_jda: '__tra',
    __cookie_jdb: '__trb',
    __cookie_jdc: '__trc',
    __cookie_jdu: '__tru',
    __cookie_jdv: '__trv'
};

</script>

    <script type="text/javascript" src="<?php echo base_url('static/persons/js/pingJS.1.0.js') ?>"></script>
    <script type="text/javascript">
        pingJS();
    </script>
    


<script type="text/javascript">
$("#unsupport").hide();
if(!testLocalStorage()){ //not support html5
    if(0!=0 && !$clearCart && !$teamId){
		$("#html5_cart_num").text(0>0>0);
	}
}else{
	updateToolBar('');
}

$("#html5_cart").click(function(){
//	syncCart('afddc2234d03b7e6974b75f6e79e0fd1',true);
	location.href='';
});

function reSearch(){
var depCity = window.sessionStorage.getItem("airline_depCityName");
	if(testSessionStorage() && isNotBlank(depCity) && !/^\s*$/.test(depCity) && depCity!=""){
    	var airStr = '<form action="/airline/list.action" method="post" id="reseach">'
        +'<input type="hidden" name="sid"  value="afddc2234d03b7e6974b75f6e79e0fd1"/>'
        +'<input type="hidden" name="depCity" value="'+ window.sessionStorage.getItem("airline_depCityName") +'"/>'
        +'<input type="hidden" name="arrCity" value="'+ window.sessionStorage.getItem("airline_arrCityName") +'"/>'
        +'<input type="hidden" name="depDate" value="'+ window.sessionStorage.getItem("airline_depDate") +'"/>'
        +'<input type="hidden" name="depTime" value="'+ window.sessionStorage.getItem("airline_depTime") +'"/>'
        +'<input type="hidden" name="classNo" value="'+ window.sessionStorage.getItem("airline_classNo") +'"/>'
        +'</form>';
    	$("body").append(airStr);
    	$("#reseach").submit();
	}else{
    	window.location.href='';
	}
}
 //banner 关闭点击
    $('.div_banner_close').click(function(){
        $('#div_banner_header').unbind('click');
        jQuery.post('/index/addClientCookieVal.json',function(d){
              $('#div_banner_header').slideUp(500);
        });
    });
    //banner 下载点击
    $('.div_banner_download').click(function(){
         var downloadUrl = $(this).attr('url');
         jQuery.post('',function(d){
               window.location.href=downloadUrl;
        });
    });




	
</script>

<!--通用头脚本  add by lizhenyou 2015-3-30 -->
<script>
    $(document).ready(function(){
		var mchb = new MCommonHeaderBottom();
    	var title = "";
    	var headerArg = {hrederId : 'm_common_header', title:title, sid : 'afddc2234d03b7e6974b75f6e79e0fd1', isShowShortCut : false, selectedShortCut : '4'};
    	mchb.header(headerArg);
		
		var sid = 'afddc2234d03b7e6974b75f6e79e0fd1';
    	var pin = 'dahai516802786';
    	var toPcSkipurl = ''; //跳转电脑版url
    	var footerPlatforms = mchb.platformEnum(toPcSkipurl,sid).enum3_1;
        var bottomArg = {bottomId : 'm_common_bottom', sid : sid, pin : pin ,footerPlatforms : footerPlatforms};
        mchb.bottom(bottomArg);	
    });
	
    </script>
	
	<script>
		var urlRemoveParam = function(url,paramName){
        	var myurl=new MJdUrl.URL(url);
        	myurl.remove(paramName); //删除了 paramName 
        	return myurl.url();
        }
	</script>

</body>
</html>
