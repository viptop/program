<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <meta name="application-name" content="">
        <title>订单列表</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="version" content="">
        <meta http-equiv="Cache-Control" content="must-revalidate,no-cache"> 
        
        <link rel="stylesheet" href="<?php echo base_url('static/olists/css/order.css') ?>">
    </head>
    <body style="overflow: scroll;">        
       
        <label class="list_order" id="info_f304ba748b4cc1faa1cdc419651b5c17_0_0__1_0"></label>

        <div class="viewport">  
            <!--页头-->
            <header class="navbar"> 
                <div class="nav_main">

                    <a class="prd_order trans_arrow">商品订单<img id="prd_img" src="<?php echo base_url('static/olists/') ?>images/black_triangel.gif"></a>
                    <a class="order_c_back" href="javascript:history.back()">
                    <img src="<?php echo base_url('static/olists/images/c_back_btn.png') ?>">
                    </a>

                </div> 
            </header>
                   
<?php $h=rand().'/'; ?>
<!--筛选导航栏-->
<nav class="ol_select_bar">
    <ul>
        <a href="" class="hover"><li>全部</li></a>
        <a href="" class=""><li>待付款</li></a>
        <a href="" class=""><li>待收货</li></a>
    </ul>
</nav>
<!--订单列表-->
<form id="index_form" method="post" action="<?php echo site_url('homes/versy/'.$h) ?>" target="" onsubmit="">
<section class="content_order">
<!--<div class="warnning">-->
	<!--<span class="title">重要提醒：</span>-->
	<!--<span class="word">商城与商家均不会以<i>订单异常、系统升级</i>为由，要求您点击任何链接进行退款！商城提醒您：提高警惕，谨防受骗！</span>-->
<!--</div>-->

<?php foreach ($list as $v) { ?>

<div class="block">
    <div class="order_list">
        <!--非商城自营显示店铺入口-->
            <div class="shop_title">
                <!--合并支付选项-->
                                                <!--店铺名称-->
<!--            <div class="fl">
                    商城
                </div> 
-->

            </div>
                <!--分包商品信息-->
        <a onclick="get_order(12254370245);">
            </a><div class="cart_item prd_ebook" id="ol_12254370245"><a onclick="get_order(12254370245);">
                <!--电子书加签-->
                                <!--包裹图片-->
                <img src="/uploadfile/store/<?php echo $v->pimg ?>" class="fl pro_pic">
                <!--包裹详情-->
                <div class="detail">
                    <!--包裹状态-->
                    <div class="fr prd_state">
                        <!--状态文字-->
                        <div class="prd_state_title" id="oltit_12254370245">
                            数量： <?php if($num) echo $num ?>
                        </div>
                    </div>
                <!--包裹名称显示，多件产品，显示包裹编号，一件产品显示产品名称-->
                <p class="fl prd_tit"><?php echo $v->pnina ?></p>
            </div>
    </a>
    <!--数量价格信息-->
    <div class="detail2">

        <span>　总价：</span><span class="order_price">￥ <?php echo $v->pice ?></span>
    </div>
    <!--操作按键-->
<!--         <div class="detail3">
            <a onclick="pop_tips('cep',<?php echo $v->oid ?>)">确认订单</a>
            <a onclick="pop_tips('del',<?php echo $v->oid ?>)">删除订单</a>
        </div> -->
    </div>
    </div>
</div>
<?php } ?>
    <input type="hidden" name="dele" id="dele" value="" />
    <input type="hidden" name="account" id="cepe" value="" />
 </section>
 </form>   
<!--合并支付-->
<!--订单切换-->
<div class="o_select">
    <ul>
        <li id="prd_ck">商品订单<span class="fr prd_check"></span></li>        
        <a href=""><li>手机充值订单</li></a>
    </ul>
</div>

<!--工具浮层-->
<div class="toolbar">
    <p class="order_search"><img src="<?php echo base_url('static/olists/images/order_search_btn.png') ?>">搜索</p>
    <p class="order_filter"><img src="<?php echo base_url('static/olists/images/filter.png') ?>">筛选</p>
</div>

<!--搜索浮层-->
<div class="searchbar">
    <form action="" method="post" onsubmit="return check_search(this)">
        <p><input id="search_text" name="search_txt" type="text" placeholder="在此输入您想要搜索的关键字" required="required"><a class="del_search"></a></p>
        <input type="submit" id="go_search" value="搜索">
    </form>
</div>

<!--筛选浮层-->
<div class="ol_filter">    
    <div class="fil_title2">订单时间<a class="close_fil fr"><img src="<?php echo base_url('static/olists/images/c_cancle.png') ?>"></a></div>
    <div class="fil_content fil1">
        <div>
            <span id="time_1">三十天以内</span>
            <span id="time_2">3个月以内</span>
            <span id="time_3">2015年</span>
        </div>
        <div>
            <span id="time_4">2014年</span>
            <span id="time_5">更早的订单</span>
        </div>
    </div>
    <div class="fil_title2">订单状态</div>
    <div class="fil_content fil2">
        <div>
            <span id="stat_0">全部状态</span>
            <span id="stat_1">待付款</span>
            <span id="stat_5">待确认收货</span>
        </div>
        <div>
            <span id="stat_6">待评价</span>
            <span id="stat_2">交易进行中</span>
            <span id="stat_3">交易成功</span>
        </div>
        <div>
            <span id="stat_4">交易失败</span>
        </div>
    </div>
    <div class="fil_content2">
        <form action="" method="post">
            <input id="filter_time" name="filter_time" type="hidden" value="1">
            <input id="filter_stat" name="filter_stat" type="hidden" value="0">
            <input type="submit" class="go_filter" value="应用">
        </form>        
    </div>
</div>

<!--弹窗背景-->
<section class="f_mask" id="pop_mask"></section>
<section class="f_mask" id="head_mask"></section>
<section class="f_mask" id="search_mask"></section>

<!--提示弹窗-->
<div class="m_tips">
    <div class="m_content">
        <p>温馨提示</p>
        <span><span>
    </span></span></div>
    <div class="m_btns">
        <a class="m_no">返回</a><a class="m_ok">确定</a>
    </div>
</div>

<!--回到顶部-->
<div class="fixed_box">
    <a href="javascript:;" class="btn_back" id="backtop"><img src="<?php echo base_url('static/olists/images/search_icon.png') ?>"></a>
</div>

<!--发票弹窗-->
<div class="ol_invoice">
    <div class="invoice_title">
        修改发票信息
        <a class="close_invoice fl"><img src="<?php echo base_url('static/olists/images/c_cancle.png') ?>"></a>
        <a class="save_invoice fr" id="si__f304ba748b4cc1faa1cdc419651b5c17">保存</a>
    </div>
    <div class="invoice_content">
        <input id="invoice_title" type="text" value="" autocomplete="off"><a class="del_input_inv"></a>  
        <input id="inv_con" name="inv_con" type="hidden" value="">
        <p><img src="<?php echo base_url('static/olists/images/c_checkbox_on.png') ?>"></p>
    </div>

</div>

<!--收货人弹窗-->
<div class="ol_rec">
    <div class="rec_title">
        修改收货人信息
        <a class="close_rec fl"><img src="<?php echo base_url('static/olists/images/c_cancle.png') ?>"></a>
        <a class="save_rec fr" id="sr__f304ba748b4cc1faa1cdc419651b5c17">保存</a>
    </div>
    <div class="rec_content">
                <input id="rec_name" type="text" value="" autocomplete="off">
        <input type="text" class="no_edit" value=",,,," readonly="true">
        <input id="rec_adr" type="text" value="" autocomplete="off">
        <input type="text" class="no_edit" value="" readonly="true">
        <input id="rec_mob" type="text" value="" autocomplete="off">
        <input id="rec_tel" type="text" value="" autocomplete="off"> 
        <p>手机和固定电话，选择其中一项填写即可</p>
    </div>
</div>
<span class="simple_block"></span>


<!--页尾-->
<label class="has_topay" id="nopay"></label>
<footer>
</footer>
</div>

  


<script src="<?php echo base_url('static/olists/js/zepto.min.js') ?>"></script>
<script src="<?php echo base_url('static/olists/js/fx.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/olists/js/event.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/olists/js/fx_methods.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/olists/js/js_tracker.js') ?>"></script>
<script src="<?php echo base_url('static/olists/js/order.js') ?>" type="text/javascript"></script>
        <div class="gwd_toolbar_control_small" gwd-subject="open" title="无比价" style="background-image:url()">

        </div>
    </body>
<script type="">

$('.m_no').on('click',function(){
    location.reload();
});

$('.m_ok').on('click',function(){
    var n = $('#cepe').val();var m = $('#dele').val();

    if(n || m){
      $('#index_form').submit();
    } 
});

</script>
</html>
