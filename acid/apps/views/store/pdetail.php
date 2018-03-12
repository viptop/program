<!DOCTYPE html>
<html class="">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>产品详情</title>
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="application-name" content="">
	    <meta name="description" content="">
	    <meta name="keywords" content="">
	    <meta name="author" content="">
    <meta name="version" content="ddtouch">
    <meta http-equiv="Cache-Control" content="must-revalidate,no-cache">
    <link rel="stylesheet" href="<?php echo base_url('static/pdetails/css/common.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('static/pdetails/css/product.css') ?>">
    <script src='http://apps.bdimg.com/libs/jquery/1.8.3/jquery.js'></script>
<script>var sid="d256b1d537fe186e53c0444399341c24";</script>
</head>

<body class="defwidth">
<header class="header">
    <a href="javascript:history.back();" class="back"></a>
    <h1><em>商品详情</em></h1>
    <nav class="t-nav">
    <ul>
        <li><a href="" class="home">首页</a></li>
        <li><a href="" class="search">搜索</a></li>
        <li><a href="" class="category">分类</a></li>
        <li><a href="" class="cart">购物车</a></li>
        <li><a href="" class="user">我的商城</a></li>
    </ul>
</nav>
</header>
<!-- 轮播开始 -->
<div id="bigpic">
<?php include 'yeld.php'; ?>
<div id="cell">
<section class="turn">
  <section id="slider">
    <ul class="top-slider" style="width: 200%; -webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(0px, 0px) translateZ(0px);">
      <li style="width:50%">
      <a>
        <img src="/uploadfile/store/<?php echo $one[0]->pimg ?>">
      </a>
      </li>
      <li style="width:50%">
      <a>
        <img class="" src="<?php echo base_url('static/pdetails/images/1100604422-2_e_1.jpg') ?>">
      </a>
      </li>
    </ul>
    <div class="dot">
    <ul>
        <li class="on"></li>
        <li class=""></li>
    </ul>
    </div>
  </section>
</section>
</div>
</div>
<!-- 轮播结束 -->

<!-- 详情区域开始 -->
<form method="post" id="fids" action="<?php echo site_url('homes/modify/'.$h.$one[0]->id) ?>" >
<section class="detail">
	
	<div class="left">
		<b>￥<span id="main_price"><?php echo $one[0]->pice ?></span></b>
		<del style="display:none">￥ <?php echo $one[0]->pice ?></del>
		<aside><input type="hidden" name="asided" value="<?php echo $one[0]->id ?>" /></aside>
	</div>
	<div class="right">
		<ul>
			<li class="fav"><a>库存：<?php echo $one[0]->stock ?></a></li>
		</ul>
	</div>
	<article><?php echo $one[0]->pnina ?></article>
	<p><input type="hidden" name="stpid" value="<?php echo $one[0]->pice ?>" /></p>
				
				
	<!-- 保障区域开始  如果是电子书没有保障区域-->
	        
		<!-- 保障区域结束 -->
</section>
<!-- 详情区域结束 -->

<!-- 税费 只有海外购有税费 -->
<!-- 税费结束 -->


<!-- 加载促销信息模板开始 -->
	<!-- 单品级促销有附加商品 -->
	
	<!-- 店铺级促销没有附加商品 -->
<!-- 				
			<section class="promotion">
				<a href="javascript:void(0)" class="arrow_con">
					<div class="label">
					<div class="table">
						<div class="cell">
							<span class="purple">店铺满额减</span>
						</div>
					</div>
				</div>
					<div class="info">
							<p>满￥99.00减￥20.00,满￥199.00减￥60.00</p>
					</div>
				</a>
			</section> 
-->
		<!-- 店铺级促销没有附加商品  -->


<!-- 加载促销信息模板结束 -->

<!--  
<section class="detail book_detail">
	<a href="#"><div class="title"><div class="right"><span class="icon"></span></div>商品简介</div></a>
	<p><span>产&nbsp;&nbsp;&nbsp;&nbsp;品：</span>姗蔻无毒指甲油包邮环保裸色指甲油儿童孕妇持久无毒指甲油快干</p>
	<p><span>净含量：</span>7.5</p>
	<p><span>上市时间：</span>2013-06-18</p>
	<p><span>颜色分类：</span>颜色分类: 湖水蓝 裸粉色 透明亮片 玫红色 珠光红</p>
	<p><span>肤&nbsp;&nbsp;&nbsp;&nbsp;质：</span>任何肤质</p>
	<p><span>产&nbsp;&nbsp;&nbsp;&nbsp;地：</span>中国</p>
</section>
-->
<!-- 配送开始 
	<section class="select_box">
		<section class="title">
			<a class="back">返回</a>
			<span class="title">选择配送地区</span>
			<a class="close">关闭</a>
		</section>
		<div id="regionScroller">
		<section style="-webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(0px, 0px) translateZ(0px);">
		<dl class="content"></dl>
		</section>
		</div>
	</section>
-->
<!-- 配送结束 -->
<!-- 选项开始 -->
<!-- 数量开始 -->
<section class="quantity">
	<h4>选择数量：</h4>
	<div class="number_con">
		<span class="minus">-</span>
		<div class="input"><input id="buy_num" name="buy_num" type="text" value="1"></div>
		<span class="plus on">+</span>
	</div>
</section>
</form>
<!-- <section class="review_area"><section class="jump">
	<a href="" class="arrow_con">
		<div class="arrow">
			<h4>商品评论（254）</h4>
			<em>好评率92.9%</em>

		</div>
		<div style="line-height: 30px;">
			&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight: bold;font-size: 12px">Johnson丶Lee</span><br>
			<div style="padding-left: 14px;line-height: 1.5;font-size: 10px;">卖家服务态度很好，随商品也有附赠的小赠品，感觉买这家的商品很舒服。快递也非常快，接到东西的时候还感到有些意外：怎么这么快？！        <div style="float: right;padding-right: 7px;font-weight: bold">2015-09-16</div>
			</div>
		</div>
	</a>
</section>
</section> -->
<!-- 商品评论结束 -->

<!-- 店铺评价开始 -->
<!-- <section class="shop">
	<div class="shop_btn">
		<span><a id="collect_shop">点击购买</a></span>
		<span><a href="">进店逛逛</a></span>
	</div>
</section> -->
<!-- 店铺评价结束 -->

<!-- 猜你喜欢开始 -->
<!-- <section class="J_guess">
<section class="guess">
<div class="title_con"><span class="title">猜你喜欢</span><div class="line"></div></div>
<ul>

<li>

<a href="">

<aside><img class="" src="images/1477078008-1_b.jpg"></aside>
<span>【包邮】珍视明冰敷眼罩 冷热敷双功效 缓解眼疲劳 满108赠礼 买就赠眼贴</span>
<em>￥45.00</em>
</a>
</li>

<li>

<a href="">

<aside><img class="" src="images/1273687641-1_b.jpg"></aside>
<span>女神新妆彩妆套装 现在买送 大礼包 BB霜+眼线液笔+ 加妆前乳+新款口红+睫毛</span>
<em>￥128.00</em>
</a>
</li>



<li>

<a href="">

<aside><img class="" src="images/1426474506-1_b.jpg"></aside>
<span>韩熙贞  丝滑细腻埃及粉饼 控油防汗修容 清爽服帖 补妆 全网抢购中</span>
<em>￥39.00</em>
</a>
</li>





<li>

<a href="">

<aside><img class="" src="images/1206438229-1_b.jpg"></aside>
<span>珍视明 薰衣草蒸汽眼罩 芳香蒸汽热敷 遮光安神助眠 买就赠眼贴！买3赠大礼包</span>
<em>￥49.00</em>
</a>
</li>



</ul>
</section>
</section> -->
<!-- 猜你喜欢结束 -->
<!-- 购物车开始 -->
<section class="shopping_cart">
	<div class="btn_con">
		<button class="add" dd_name="加入购物车">加入购物车</button><button class="buy J_buy" onclick="froms()" dd_name="直接购买">立即购买</button>		
	</div>
	<a href="" class="cart" dd_name="查看购物车">
		<span>购物车<i></i></span>
	</a>
</section>
<!-- 购物车结束 -->
<form id="product_form" action="" method="post">
        <input type="hidden" value="touch" name="user_client">
        <input type="hidden" value="1.0" name="client_version">
        <input type="hidden" value="get_order_flow" name="action">
        <input type="hidden" value="" name="union_id">
        <input type="hidden" value="20151007171938214237638454188786121" name="permanent_id">
        <input type="hidden" value="0" name="shop_id">
        <input type="hidden" value="d256b1d537fe186e53c0444399341c24" name="udid">
        <input type="hidden" value="1444442002" name="timestamp">
        <input type="hidden" value="659ac7e360252f81fe946a0c662d7e7b" name="time_code">
        <input type="hidden" value="ddapp_h5|" name="order_follow_source">
    </form>
<!-- loading开始 -->
<!-- <section class="loading"></section> -->
<!-- loading结束 -->
<!-- 遮罩开始 -->
<section class="mask"></section>
<!-- 遮罩结束 -->
<!-- popup开始 -->
<section class="popup">
	<div class="box">
		<p class="cell">
			<span class="con">
				<span class="title">温馨提示</span>
				<span class="info"></span>
				<a href="javascript:void(0);" class="btn determine" ontouchstart=""><em>确定</em></a>
				<a href="javascript:void(0);" class="btn cancel" ontouchstart=""><em>取消</em></a>
				<a href="javascript:void(0);" class="btn ok" ontouchstart=""><em>确定</em></a>
			</span>
		</p>
	</div>
</section><script type="text/javascript">
	var prd_info = {"product_info_new":{"brand":"Sweet City","product_id":"1100604422","original_price":"69.00","sale_price":"69.00","discount":"34.8485","mobile_exclusive_price":{"exclusive_price":"","exclusive_price_max":"","exclusive_begin_date":"","exclusive_end_date":""},"is_vip_discount":"0","product_points":"345","product_points_gold":"345","product_points_diamond":"345","vip_price_1":"69.00","vip_price_2":"69.00","vip_price_3":"69.00","product_name":"Sweet City\/\u90fd\u5e02\u751c\u5fc3\u6cb9\u6027\u6307\u7532\u6cb9\u7f8e\u7532\u5957\u88c5 \u9b45\u5f71OL\u88f8\u8272\u7cfb\u52177+1\u793c\u76d2 TC03","display_status":"0","is_direct_buy":"0","main_product_id":"0","shop_id":"6860","product_medium":"12","product_type":"0","category_id":"4004105","is_catalog_product":"0","has_ebook":"","subname":"","support_seven_days":"0","activity_type":"0","tax_rate":"0.5","is_overseas":"0","publish_info":{"publisher":"","author_name":"","product_size":"","print_copy":"","paper_quality":"","publish_date":"1970-01-01","number_of_pages":"","number_of_words":"","version_num":"","singer":"","director":"","actors":"","prod_length":"","effective_period":"","subtitle_language":"","binding":"","manufacture_format":"TC03","author_arr":[],"standard_id":""},"promo_model":[],"stock_info":{"stock_status":"1"},"pre_sale":"0","category_info":{"category_id":"4004105","category_path":"58.31.03.16.03.00","path_name":"\u7532\u6cb9","has_sub_path":"0","refund_expire_days":"","confirm_refund_expire_days":"","exchange_expire_days":"","confirm_exchange_expire_days":"","category_orderno":"1","category_fullpath":"","guan_id":"4000005","catid_path":"-4002074-4002077-4002661-4004105-","full_categorys":[{"category_id":"4002074","path_name":"\u65f6\u5c1a\u7f8e\u5986","category_path":"58.31.00.00.00.00"},{"category_id":"4002077","path_name":"\u7f24\u7eb7\u5f69\u5986","category_path":"58.31.03.00.00.00"},{"category_id":"4002661","path_name":"\u7f8e\u7532","category_path":"58.31.03.16.00.00"},{"category_id":"4004105","path_name":"\u7532\u6cb9","category_path":"58.31.03.16.03.00"}]},"comm_info":{"total_review_count":"254","total_like_count":"15","total_dislike_count":"4","average_score":"5","total_buyer_review_count":"254","items":[{"review_id":"61303375","customer_id":"35094701","creation_date":"2013-12-11 15:08:04","last_changed_date":"2013-12-11 16:07:01","title_filtered":"","body_filtered":"\u6307\u7532\u6cb9\u5f88\u4e0d\u9519\uff0c\u6d82\u4e0a\u5f88\u6f02\u4eae\uff0c\u663e\u624b\u767d","body2_filtered":"","total_feedback_num":"0","total_vote_count":"0","total_helpful_count":"0","creation_ip_addr":"119.98.37.157","score":"1","body3":"","device_type":"0"},{"review_id":"61260178","customer_id":"120512395","creation_date":"2013-12-11 09:34:33","last_changed_date":"2013-12-11 15:52:10","title_filtered":"","body_filtered":"\u4e1c\u4e1c\u5f88\u597d\uff0c\u4e0b\u6b21\u8fd8\u4f1a\u6765","body2_filtered":"","total_feedback_num":"0","total_vote_count":"0","total_helpful_count":"0","creation_ip_addr":"1.85.1.34","score":"1","body3":"","device_type":"0"},{"review_id":"61244950","customer_id":"42701848","creation_date":"2013-12-10 22:45:05","last_changed_date":"2013-12-11 10:14:37","title_filtered":"","body_filtered":"\u989c\u8272\u6709\u70b9\u900f\u54e6 \u603b\u7684\u6765\u8bf4\u8fd8\u53ef\u4ee5\u5427","body2_filtered":"","total_feedback_num":"0","total_vote_count":"0","total_helpful_count":"0","creation_ip_addr":"14.112.65.179","score":"1","body3":"","device_type":"0"},{"review_id":"61208860","customer_id":"119469236","creation_date":"2013-12-10 16:58:39","last_changed_date":"2013-12-10 19:00:37","title_filtered":"","body_filtered":"sweetcity\u90fd\u5e02\u751c\u5fc3\u6307\u7532\u6cb9 \u54c1\u724c\u5c31\u662f\u4e0d\u4e00\u6837\u989d\u6309\u7167\u5546\u5bb6\u8bf4\u7684\u6b65\u9aa4 \u6d82\u4e0a\u7532\u6cb9\u9500\u91cf\u8fd9\u7684\u662f\u6bd4\u6211\u4eec\u4e4b\u524d\u4e0d\u61c2\u7684\u8981\u597d\u7684\u591a\uff0c\u4eca\u540e\u5c31\u8ba4\u5b9a\u4f60\u4eec\u5bb6\u4e86 \u6709\u670b\u53cb\u559c\u6b22\u7684 \u4f1a\u4ecb\u7ecd\u6765\u4f60\u4eec\u5bb6 \u4e0b\u6b21\u51fa\u65b0\u54c1\u4e86 \u8bb0\u5f97\u901a\u77e5\u4e0b\u989a  \u8fd9\u4e2a\u5957\u88c5\u91cc\u9762\u57fa\u672c\u4e0a\u662f\u4ec0\u4e48\u90fd\u6709 \u5e95\u6cb9 \u4eae\u6cb9 \u6307\u7532\u6cb9","body2_filtered":"","total_feedback_num":"0","total_vote_count":"0","total_helpful_count":"0","creation_ip_addr":"119.98.37.157","score":"1","body3":"","device_type":"0"},{"review_id":"61006143","customer_id":"21719997","creation_date":"2013-12-08 16:02:03","last_changed_date":"2013-12-08 19:55:10","title_filtered":"","body_filtered":"\u989c\u8272\u5f88\u6f02\u4eae\uff0c\u5e72\u7684\u4e5f\u5feb\u3002","body2_filtered":"","total_feedback_num":"0","total_vote_count":"0","total_helpful_count":"0","creation_ip_addr":"10.4.13.104","score":"1","body3":"","device_type":"0"},[]]},"collection_num":"288","total_review_count":"254","is_ebook":0,"abstract":"","images":["http:\/\/\/38\/17\/","http:\/\/\/38\/17\/"],"images_big":["http:\/\/\/38\/17\/","http:\/\/\/38\/17\/"],"stars":{"full_star":5,"has_half_star":false,"star_html":"<img src=\"images\/\" alt=\"\" width=\"12\" height=\"11\" \/><img src=\"images\/\" alt=\"\" width=\"12\" height=\"11\" \/><img src=\"images\/\" alt=\"\" width=\"12\" height=\"11\" \/><img src=\"images\/\" alt=\"\" width=\"12\" height=\"11\" \/><img src=\"images\/\" alt=\"\" width=\"12\" height=\"11\" \/>"},"is_pub_product":0,"ebook_info":{"read_ebook_at_h5":false},"is_yb_product":false,"is_show_arrive":0,"share_url":"http:\/\/\/","spuinfo":"","show_price_name":"sale_price","template_id":"0","is_support_mobile_buying":1,"show_dangdangsale":0,"in_wishlist":0,"page_template":{"code":"3","name":"\u767e\u8d27\uff08\u975e\u670d\u88c5\u7c7b\u7684\u767e\u8d27\uff09"},"platform_banner":[],"bang_rank":null},"shop_info":{"is_support_360image":"0","ebusiness_company_name":"","logo_image_url":"","location":"3","shop_is_cod":"1","treasure":"","shop_type":"0","is_self_cod":"0","ebusiness_company_code":"","delivery_address":"\u4e0a\u6d77","shop_id":"6860","shop_name":"Sweet city\u7f8e\u7532\u5b98\u65b9\u65d7\u8230\u5e97","is_self_online":"1","delivery":"","delivery_fee_least":"","customs_declare_code":"","promo_msg":"","status":"1","contact":"<p style=\"text-align: left;\"><strong><span style=\n\"font-size: 14pt;\">QQ:778231920<\/span><\/strong><\/p>\n<p style=\"text-align: left;\"><strong><span style=\n\"font-size: 14pt;\">TEL:18040586078<\/span><\/strong><\/p>\n<p style=\"text-align: left;\"><strong><span style=\n\"font-size: 14pt;\">\u5c0a\u656c\u7684\u987e\u5ba2\uff0c\u60a8\u597d\uff1a<\/span><\/strong><br \/>\n<strong><span style=\n\"font-size: 14pt;\">\u4e3a\u7ed9\u60a8\u63d0\u4f9b\u66f4\u4fbf\u6377\u7684\u670d\u52a1\uff0c\u8bf7\u60a8\u5728\u62cd\u4e0b\u8ba2\u5355\u540e\u7559\u8a00\u6240\u9700\u5feb\u9012\uff0c\u6211\u4eec\u4f1a\u6309\u7167\u60a8\u7559\u8a00\u7684\u5feb\u9012\u53bb\u53d1\u8d27\uff0c\u672c\u5e97\u53ea\u53d1\u5706\u901a\uff0cEMS\uff0c\u56e0\u4e3a\u6307\u7532\u6cb9\u662f\u6613\u71c3\u4ea7\u54c1\uff0c\u4e0d\u80fd\u8d70\u822a\u7a7a\u8def\u7ebf\uff0c\u6240\u4ee5\u5feb\u9012\u4e0d\u5230\u7684\u53ea\u80fd\u53d1EMS\uff0c\u65f6\u95f4\u53ef\u80fd\u4f1a\u6bd4\u5176\u4ed6\u5feb\u9012\u665a1-3\u5929\uff0c\u8fd8\u8bf7\u4eb2\u89c1\u8c05\uff01<\/span><\/strong><\/p>\n<p style=\"text-align: left;\"><strong><span style=\n\"font-size: 14pt;\">\u8425\u4e1a\u65f6\u95f4\u5b89\u6392\u5982\u4e0b\uff1a<\/span><\/strong><br \/>\n<strong><span style=\n\"font-size: 14pt;\">1\u3001\u552e\u524d\/\u552e\u540e\u65f6\u95f4:9:00-17:00\uff08<strong><span>\u5468\u65e5\u4f11<\/span><\/strong>\uff09<\/span><\/strong><br \/>\n\n<strong><span style=\n\"font-size: 14pt;\">2\u3001&nbsp;\u8ba2\u5355\u53d1\u8d27\u65f6\u95f4:16:00\uff08<strong><span>\u5468\u65e5\u4f11<\/span><\/strong>\uff09<\/span><\/strong><br \/>\n\n<strong><span style=\n\"font-size: 14pt;\">3\u3001&nbsp;\u9000\u6362\u8d27\u76f8\u5173\u95ee\u9898:9:00-17:00\uff08\u5468\u65e5\u4f11\uff09<\/span><\/strong><\/p>\n<p style=\"text-align: left;\"><span style=\n\"font-size: 14pt;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\u611f\u8c22\u60a8\u5bf9\u6211\u4eec\u7684\u652f\u6301\uff01\u795d\u60a8\u8d2d\u7269\u6109\u5feb\uff01<\/span><\/p>\n<p style=\"text-align: left;\"><span style=\n\"font-size: 14pt;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\u53e6\u5916\u672c\u5e97\u4e0d\u5b9a\u65f6\u6709\u65b0\u54c1\u4e0a\u5e02\uff0c\u7ed9\u529b\u4f18\u60e0\uff0c\u656c\u8bf7\u5173\u6ce8\uff01<\/span><\/p>\n","domain":"\/6860","account_declare_code":"","charter_start_time":"","zip":"1","shop_logo":"http:\/\/\/imgother\/201111\/18_0\/2011111810580945.jpg","is_collected":false},"shop_promo":{"promotion_id":"1469820","price1":"99.00","discount_amount1":"20.00","price2":"199.00","discount_amount2":"60.00","price3":"","discount_amount3":"","price4":"","discount_amount4":"","shop_id":"6860","promotion_type":"14","promotion_name":"\u6ee1\uffe599.00\u51cf\uffe520.00,\u6ee1\uffe5199.00\u51cf\uffe560.00","promo_start_date":"2015-09-02 10:40:00","promo_end_date":"2016-01-01 10:40:00","select_product":"","promo_prefix1":"","min_order_price1":"","promo_prefix2":"","min_order_price2":"","promo_prefix3":"","min_order_price3":"","coupon_value":"","total_quantity":"","gift_min_order_price":"","gift_product_type":"","gift_product_medium":"","gift_product_id":"","gift_product_name":"","gift_original_price":"","gift_sale_price":"","gift_min_order_price2":"","gift_product_type2":"","gift_product_medium2":"","gift_product_id2":"","gift_product_name2":"","gift_original_price2":"","gift_sale_price2":"","gift_min_order_price3":"","gift_product_type3":"","gift_product_medium3":"","gift_product_id3":"","gift_product_name3":"","gift_original_price3":"","gift_sale_price3":"","gift_min_order_price4":"","gift_product_type4":"","gift_product_medium4":"","gift_product_id4":"","gift_product_name4":"","gift_original_price4":"","gift_sale_price4":"","order_qualify_amount":"","enjoy_discount":"","order_qualify_amount2":"","enjoy_discount2":"","order_qualify_amount3":"","enjoy_discount3":"","order_qualify_amount4":"","enjoy_discount4":""},"product_attr":{"mainproduct":null},"product_desc":{"content":"\u54c1\u724c\uff1aSweet City\u578b\u53f7\uff1aTC03\u4fdd\u8d28\u671f\uff1a\u6309\u5546\u54c1\u5305\u88c5\u5b9e\u9645\u63cf\u8ff0\u4e3a\u51c6\u5546\u54c1\u7c7b\u522b\uff1a\u7532\u6cb9\u5957\u88c5\u5546\u54c1\u529f\u6548\uff1a\u901f\u5e72\n\n\u8be6\u60c5\n\n\u7279\u522b\u8bf4\u660e\uff1a\n\nTC03 \u9b45\u5f71OL\u88f8\u8272\u7cfb\u52177+1\u793c\u76d2\u88c5\u5305\u542b\u8272\u53f7\uff086ml\/\u74f6\u6307\u7532\u6cb9\u00d77\u74f6+20ml\/\u74f6\u6d17\u7532\u6c34\u00d71\u74f6\uff09\uff1a\n\n\u663e\u767d\u88f8\u7c89\u8272MM114\u3001\u767e\u642d\u73e0\u5149\u767dMM109\u3001\u679c\u51bb\u6a31\u6843\u7c89MM121\u3001\u70ab\u5f69\u94f6\u767dMM103\u3001\u8bf1\u4eba\u679c\u51bb\u7c89MM097\u3001\u725b\u6cb9\u679c\u5e95\u6cb9MT05\u3001\u5feb\u5e72\u4eae\u6cb9MT01\u3001\u871c\u6843\u6d17\u7532\u6c3420ML\uff08\u8be6\u60c5\u89c1\u6587\u63cf\uff09","abstract":"","authorintro":"","catalog":"","extract":""},"product_desc_sorted":[],"also_buys":null,"yb_buy_info":null};
	var is_weixin = false;
	var prd_cfg = {};
	prd_cfg.review_url = "";

</script>
<footer class="footer new">
    <section class="status-bar">
        <div class="actions-wrap">
            <!-- <a class="nickname" href="">名称</a> -->
            <!-- <a href="">退出</a> -->
        </div>
        <a class="top" href="javascript:scrollTo(0,0);">TOP</a>
    </section>
    <nav class="b-nav">
        <p>
            <a href="" ontouchstart="">提建议</a>
            <a class="red" href="" ontouchstart="">触屏版</a>
            <a href="" ontouchstart="">电脑版</a>
            <a href="" ontouchstart="">帮&nbsp;&nbsp;助</a>
        </p>
    </nav>
    <section class="copyright">
        <p>Copyright @ 2017</p>
    </section>
</footer>
<!-- 购物车占位开始 -->
<section class="space"></section>
<!-- 购物车占位结束 -->
<script type="text/javascript">
	function froms(){
		document.getElementById('fids').submit();
	}
</script>
<script src="<?php echo base_url('static/pdetails/js/zepto.min.js') ?>"></script>
<script src="<?php echo base_url('static/pdetails/js/underscore.min.js') ?>"></script>
<script src="<?php echo base_url('static/pdetails/js/iscroll5.min.js') ?>"></script> 
<script src="<?php echo base_url('static/pdetails/js/fastclick.min.js') ?>"></script>
<script src="<?php echo base_url('static/pdetails/js/common.min.js') ?>"></script>
<script src="<?php echo base_url('static/pdetails/js/product.min.js') ?>"></script>
<script src="<?php echo base_url('static/pdetails/js/js_tracker.js') ?>"></script>


</body>
</html>
