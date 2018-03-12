<!DOCTYPE html>
<html class="mdd-index" style="font-size: 40px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>首页</title>
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="application-name" content="">
    <title>首页</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="version" content="ddtouch">
    <meta http-equiv="Cache-Control" content="must-revalidate,no-cache">
    <link rel="stylesheet" href="<?php echo base_url('static/list/css/common.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('static/list/css/app.css?v=20150605') ?>"/>
 
    <!-- <link rel="stylesheet" href="/static/list/css/app.css?v=20150605"> -->
</head>

<body onload="checkse()">
<script type="text/javascript">
     var proxyAssets = "/h5touchassets";
     var index_url = "";
</script>
<script type="text/javascript"> var appUrlConfig = [{"download_img_url":"http:\/\/\/upload_img\/00528\/111111\/H5-0714.jpg","android_url":"http:\/\/\/","iphone_url":"http:\/\/\/cn\/app\/id445573854?mt=8","app_url":":\/\/"},{"download_img_url":"http:\/\/\/upload_img\/00528\/987\/and-0902.png","android_url":"http:\/\/\/block_mobileClient_download.htm?channel=30153","iphone_url":"http:\/\/\/us\/app\/id488202082","app_url":"ddreader:\/\/"}] </script>
<?php include 'yeld.php'; ?> 
<header id="search" dd_name="首页搜索区">
    <div class="dd-logo">
    <a href="#" dd_name="logo跳转"></a>
    </div>
    <div class="search_box">
        <div class="search">
            <form id="index_search_form" method="get" action="" target="_parent" onsubmit="return submit_search();">
                <div class="text_box">
                    <input id="keyword" name="keyword" type="text" placeholder="请输入商品" class="keyword text" onkeydown="this.style.color=&#39;#404040&#39;" autocomplete="off">
                </div>
                <input type="submit" value="" class="submit" dd_name="搜索">
                <input type="hidden" value="d256b1d537fe186e53c0444399341c24" name="sid">
            </form>
        </div>
      </div>
    <div class="header-category"><a href="/homes/plist/" dd_name="跳转分类"><em>分类</em></a></div>
    <div class="search_list"></div>
</header>
<section id="wrapper">
<section class="top-slider-wrapper" dd_name="首页焦点轮播区">
  <section data-widget="topSlider" class="J_top_slider index-slider">
    <ul class="top-slider" style="width: 500%; -webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(-2588px, 0px) translateZ(0px);">

      <li style="width:20%"><a href="" dd_name="焦点轮播图1"><img src="<?php echo base_url('static/list/images/lxqj-0929-700-270.jpg') ?>" alt="预留"></a></li>


      <li style="width:20%">
      <a href="" dd_name="焦点轮播图2">
          <img class="" alt="预留" src="<?php echo base_url('static/list/images/108-700-270.jpg') ?>">
      </a>
      </li>
          <li style="width:20%">
      <a href="" dd_name="焦点轮播图3">
                        <img class="" alt="预留" src="<?php echo base_url('static/list/images/nbewxj-1008-700x270.jpg') ?>">
                </a>
      </li>
          <li style="width:20%">
      <a href="" dd_name="焦点轮播图4">
                        <img class="" alt="预留" src="<?php echo base_url('static/list/images/700270jinse922.jpg') ?>">
                </a>
      </li>
      <li style="width:20%">
      <a href="" dd_name="焦点轮播图5">
        <img class="" alt="预留" src="<?php echo base_url('static/list/images/700-270-0801.jpg') ?>">
      </a>
      </li> 

        </ul>
    <div class="top-slider-indicator">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot on"></span>
    </div>
  </section>

</section>
	<ul class="index-nav" dd_name="首页功能区">
			<li><a href="homes/plist/" dd_name="分类"><img class="" src="<?php echo base_url('static/list/images/fenlei.png') ?>"><span>分类</span></a></li>
			<!-- <li><a href="" dd_name="立减5元"><img class="" src="<?php echo base_url('static/list/images/xiazai-0605.png') ?>"><span>立减5元</span></a></li> -->
			<li><a href="#" dd_name="购物车"><img class="" src="<?php echo base_url('static/list/images/gouwuche.png') ?>"><span>购物车</span></a></li>
			<li><a href="/homes/personal" dd_name=""><img class="" src="<?php echo base_url('static/list/images/wodedangdang-h5.png') ?>"><span>个人信息</span></a></li>
			<!-- <li><a href="" dd_name="好书榜"><img class="" src="<?php echo base_url('static/list/images/haoshubang.png') ?>"><span>热卖榜</span></a></li> -->
			<!-- <li><a href="" dd_name="童书榜"><img class="" src="<?php echo base_url('static/list/images/tognshubang-0604.png') ?>"><span>促销榜</span></a></li> -->
			<!-- <li><a href="" dd_name="9块9"><img class="" src="<?php echo base_url('static/list/images/9.9.png') ?>"><span>优惠商品</span></a></li> -->
			<li><a href="" dd_name="more"><img class="" src="<?php echo base_url('static/list/images/dianzihsu.png') ?>"><span>更多商品</span></a></li>
		</ul>

    <section class="seckilling" style="text-align: center;background:#c8bbe2;" dd_name="tips">商城兑换物品与苹果公司无关</section>
    <!-- <section class="simple_block"></section> -->
    <section class="seckilling" dd_name="首页秒杀区">
        <div class="seckilling-box"> 
            <div class="seckilling-title">
            <span class="seckilling-name">PRODUCTS</span>
            <span class="seckilling-icon"></span> 
            <div class="seckilling-content" data-widget="countdown" data-end-time="1444381201" data-left-time="12191" data-is-begin="0">

            </div> 
        </div> 
        <div class="seckilling-con" id="seckill_index"> 
            <ul class="clearfix">

            <?php foreach ($list as $value) { ?>
                  <li>
                        <a href="<?php echo site_url('homes/shop/'.$h.$value->id) ?>" dd_name="秒杀品">
                            <p class="pic"><img class="" src="/uploadfile/store/<?php echo $value->pimg ?>"></p>
                            <p class="price">
                                <span class="rob">
                                    <span class="sign">¥</span>
                                    <span class="num"><?php echo $value->pice ?></span>
                                    <span class="tail"><?php echo $value->note ?></span>
                                </span>
                            </p>
                         </a>
                  </li>
            <?php } ?>

            </ul>
        </div>
        </div>
    </section>
    <section class="banner" dd_name="推荐区">
      <section data-widget="bannerSlider" class="J_banner_slider banner-slider" id="bannerSlider_99659" dd_name="轮播推荐区">
        <ul class="banner-slider" style="width: 200%; -webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(-647px, 0px) translateZ(0px);">
            <li style="width:50%">
            <!-- <a href="" dd_name="轮播推荐1"><img class="" src=""></a> -->
            </li>
            <li style="width:50%">
            <!-- <a href="" dd_name="轮播推荐2"><img class="" src=""></a> -->
            </li>
        </ul>
        <div class="banner-slider-indicator">
          <span class="dot"></span>
          <span class="dot on"></span>
        </div>
      </section>
    </section>
    <section class="floor" dd_name="">
    <h2>
        <a class="title">推荐商品</a>
        <a href="" class="more" dd_name="更多">更多</a>
    </h2>
	<dl>
<!-- 		    	    <dt><a href="" dd_name=""><img class="" src="images/DHC-h51.jpg"></a></dt>
	    
		    	    <dd><a href=""><img class="" src="images/liangpinpuzih53.jpg"></a></dd>
	    
		    	    <dd><a href=""><img class="" src="images/doujiangjih52.jpg"></a></dd> -->
	    
	 </dl>
	</section>
    <section class="floor" dd_name="">
    <h2>
         <a class="title">优惠商品</a>
                  <a href="" class="more" dd_name="更多">更多</a>
             </h2>
	     <dl>
<!-- 		    	    <dt><a href=""><img class="" src="images/h5-k1-1008-nbewxj2015.jpg"></a></dt>
	    
		    	    <dd><a href=""><img class="" src="images/h5-k3-1008-xsqxk.jpg"></a></dd>
	    
		    	    <dd><a href=""><img class="" src="images/h5-k2-1008-slbdmj.jpg"></a></dd> -->
	    
	    </dl>
	</section>
    <section class="floor" dd_name="">
    <h2>
         <a class="title">热卖商品</a>
                  <a href="" class="more" dd_name="更多">更多</a>
             </h2>
	<dl>
<!-- 		    	    <dt><a href="" dd_name=""><img class="" src="images/310x449ts929.jpg"></a></dt>
	    
		    	    <dd><a href=""><img class="" src="images/309x224ts0929_01.jpg"></a></dd>

		    	    <dd><a href=""><img class="" src="images/309x224ts0929_02.jpg"></a></dd> -->

	 </dl>
	</section>




    <section class="floor" dd_name="">
    <h2>
         <a class="title">最新商品</a>
                  <a href="" class="more" dd_name="更多">更多</a>
    </h2>
	   <dl>
<!-- 		    	    <dt><a href="" dd_name=""><img class="" src="images/h5-w1-1009.jpg"></a></dt>
	    
		    	    <dd><a href=""><img class="" src="images/ww_h5_9.30.jpg"></a></dd>
	    
		    	    <dd><a href=""><img class="" src="images/88590011636295_y.jpg"></a></dd> -->
	    </dl>
	</section>

</section>


<div class="fixed_box" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1); display: none;">
    <a href="javascript:scrollTo(0,0)" class="btn_back" id="backtop"><img style="width:2rem" src="<?php echo base_url('static/list/images/go-top.png') ?>"></a>
</div>
<footer class="footer new">
    <section class="status-bar">
        <div class="actions-wrap">
            <a href="">登录</a>
            <a href="">注册</a>
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
        <p>Copyright</p>
    </section>
</footer>
<?php include 'stor-footer.php'; ?>
