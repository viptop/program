<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>订单详情</title>
    	<meta name="author" content="m.jd.com">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	    <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" type="text/css" href="/static/odetails/css/base2013.css" charset="gbk">
		<link rel="stylesheet" type="text/css" href="/static/odetails/css/order2014.src.css" charset="gbk">
					
				
			
		<script type="text/javascript" src="<?php echo base_url('static/odetails/js/jquery-1.6.2.min.js') ?>j"></script>
        <script type="text/javascript" src="<?php echo base_url('static/odetails/js/spin.min.js') ?>"></script><style></style>
		
		<!-- 对url处理 -->
		<script type="text/javascript" src="<?php echo base_url('static/odetails/js/ojbUrl.js') ?>"></script>
		
		<!--数据埋点-->
		<script type="text/javascript" src="<?php echo base_url('static/odetails/js/pingJS.1.0.js') ?>"></script>
		
		<!--通用头尾css js add by lizhenyou 2015-4-17-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/odetails/css/header.css') ?>" charset="utf-8">


<body id="body">
<a name="top"></a>
<header>
<?php echo site_url('homes/') ?>	
		<!-- 通用头 div -->
		<div id="m_common_header" style="min-height:45px;"><header class="jd-header">    <div class="jd-header-bar">        <div id="m_common_header_goback" class="jd-header-icon-back"><a href=""><span></span></a></div>        <div class="jd-header-title" style="font-weight: bold">订单详情</div>          </div>    <ul id="m_common_header_shortcut" class="jd-header-shortcut" style="display: none;">        <li id="m_common_header_shortcut_m_index">            <a class="J_ping" report-eventid="MCommonHead_home" report-eventparam="" page_name="" href="<?php echo site_url('homes/') ?>">                <span class="shortcut-home"></span>                <strong>首页</strong>            </a>        </li>        <li class="J_ping" report-eventid="MCommonHead_CategorySearch" report-eventparam="" page_name="" id="m_common_header_shortcut_category_search">            <a href="">                <span class="shortcut-categories"></span>                <strong>分类搜索</strong>            </a>        </li>        <li class="J_ping" report-eventid="MCommonHead_Cart" report-eventparam="" page_name="" id="m_common_header_shortcut_p_cart">            <a href="" id="html5_cart">                <span class="shortcut-cart"></span>                <strong>购物车</strong>            </a>        </li>        <li id="m_common_header_shortcut_h_home" class=" current">            <a class="J_ping" report-eventid="MCommonHead_MYJD" report-eventparam="" page_name="" href="">                <span class="shortcut-my-account"></span>                <strong>我的京东</strong>            </a>        </li>    </ul></header></div>

	</header>

<input type="hidden" id="orderId" name="orderId" value="9941788290">
<input type="hidden" id="sid" name="sid" value="">
<div class="wrap">
			<section class="order-con">
				<ul class="order-list">
				<?php foreach ($list as $v) { ?>
					<li>
						<div class="order-box">
							<div class="order-width">
								<p>订单编号：9941788290</p>
								<p>订单金额：￥69.00</p>
								<p>订单日期：2015-08-22 16:57:18</p>
							</div>
						</div>
					</li>
					<?php } ?>
					<li>
						<div class="order-box">
							<ul class="book-list">
                    									 <li class="border-bottom">
								   <a href="">
								   <div class="order-msg">
										<img src="images/556671a1Ne5e7c6c7.jpg" class="img_ware">
										<div class="order-msg">
											<p class="title">Candy Moyo膜玉糖果色指甲油套装紫红色巧克力色健康环保美甲套组</p>
											<p class="price">￥59.00 <span></span></p>
											<p class="order-data">X1</p>
										</div>
									</div>
									</a>
								</li>
                    	</ul>
						</div>
					</li>
				
	   		  		 		  					<li>
						<div class="order-box">
							<div class="order-width">
								
								<p class="border-bottom usr-name">
									Johnson丶Lee
									<span class="fr">134****1150</span>
								</p>
								<p class="usr-addr">陕西西安市新城区陕西省西安市新城区</p>
								
							</div>
						</div>
					</li>
		  		 		  		 		  		 					
				  	<li>
					<div class="order-box">
				<div class="order-width">
					<p class="border-bottom usr-name">付款方式:<span class="fr">在线支付</span></p>
					<p>商品金额:<span class="fr red">￥69.00</span></p>								
					<p>返现:<span class="fr red">￥0.00</span></p>								
					<p class="border-bottom">运费:<span class="fr red">￥0.00</span></p>									
					<p>应支付金额:<span class="fr red">￥69.00</span></p>
				</div>
					</div>
				</li>
							  				  				  		
																		<li>
				<div class="order-box">
					<div class="order-width">
																	<p class="border-bottom usr-name">配送信息<span class="fr"></span></p>
																								<p>配送方式: 普通快递</p>
																								<p>送货时间： 只工作日送货（双休日、假日不用送）</p>
																								<p>配送时间： </p>
																</div>
				</div>
			</li>
												
			<li>
						<div class="order-box">
							<div class="order-width">	
							<p class="border-bottom usr-name">发票信息<span class="fr"></span></p>
            				<p>发票类型:  不开发票</p>
							<p></p>
            				</div>
						</div>
			</li>	
			</ul>

			</section>
		</div>

<script type="text/javascript">
$(function(){
	$("#cancelOrder").click(function(){
		if (confirm("是否确定取消该订单")){
    		var can=$("#cancelOrder").index($(this));
			jQuery.get(
				"/user/cancelOrder.json",
				{"orderId":$("#orderId").val(),"sid":$("#sid").val()},
               function(data){
			        $("#cancelOrder").eq(can).html(data.message);
    				$("#cancelOrder").eq(can).unbind('click');
					var url = "/user/userAllOrderList.action";
					if(!!$('#sid').val())
						url += '?sid='+$('#sid').val();
					window.location.href = url;
				}, "json");
			}
		else
    		 {
    		   return false;
    	     }
		})

	$("#confirmGoods").click(function(){
		if(confirm("是否确认收货")){
			var can=$("#confirmGoods").index($(this));
			jQuery.get(
				"/user/confirmGoods.json",
				{"orderId":$("#orderId").val(),"sid":$("#sid").val()},
				function(data){
                    $("#confirmGoods").eq(can).html('<font color="red">'+data.message+'</font>');
					$("#confirmGoods").eq(can).unbind('click');
				},"json");
		}
		else{
			return false;
		}
	});
});
</script>		
		
	<!-- 通用尾 div -->
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

        <script type="text/javascript">
            pingJS();
        </script>
    


<script type="text/javascript">
$("#unsupport").hide();
if(!testLocalStorage()){
    if(0!=0 && !$clearCart && !$teamId){
		$("#html5_cart_num").text(0>0>0);
	}
}else{
	updateToolBar('');
}

$("#html5_cart").click(function(){

	location.href='';
});

function reSearch(){
var depCity = window.sessionStorage.getItem("airline_depCityName");
	if(testSessionStorage() && isNotBlank(depCity) && !/^\s*$/.test(depCity) && depCity!=""){
    	var airStr = '<form action="/airline/list.action" method="post" id="reseach">'
        +'<input type="hidden" name="sid"  value=""/>'
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
    	var title = "订单详情";
    	var headerArg = {hrederId : 'm_common_header', title:title, sid : '$sid', isShowShortCut : false, selectedShortCut : '4'};
    	mchb.header(headerArg);
		
		var sid = '';
    	var pin = 'dahai516802786';
    	var toPcSkipurl = '';
    	var footerPlatforms = mchb.platformEnum(toPcSkipurl,sid).enum3_1;
        var bottomArg = {bottomId : 'm_common_bottom', sid : sid, pin : pin ,footerPlatforms : footerPlatforms};
        mchb.bottom(bottomArg);	
    });
	
    </script>
	
	<script>
		var urlRemoveParam = function(url,paramName){
        	var myurl=new MJdUrl.URL(url);
        	myurl.remove(paramName);
        	return myurl.url();
        }
	</script>



</body>
</html>
