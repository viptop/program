<!DOCTYPE html>
<html class="search-page"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>商品列表</title>
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="Cache-Control" content="must-revalidate,no-cache">
	<meta name="application-name" content=>
    <meta name="description" content=>
    <meta name="keywords" content="">
    <link rel="stylesheet" href="<?php echo base_url('static/plists/css/app.css') ?>">
    <script type="text/javascript" src=""></script>
    <style type="text/css">
        .lifloat{float:left;}
    </style>
    <script>
        var ddTouchIndex = "";
        var proxyPath  = "";
        var proxyAssets = "";
        var pageUrl = location.href;
        var searchUrl = pageUrl.slice(0, pageUrl.lastIndexOf("/")+1);
    </script>
</head> 
<body>
<section class="_pre">
    <!-- 搜索框 -->
<header id="head_search_box" dd_name="结果页头部" style="position: fixed; top: 0px; -webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);">
<div class="search_header">
    <a href="javascript:;" class="back search_back" id="search_back" dd_name="返回"></a>
    <div class="search">
        <form id="search_form" dd_name="搜索部分" method="get" action="" target="_parent" onsubmit="return submit_search();">
            <div class="text_box" name="list_search_text_box" dd_name="搜索框" onclick="return 1;">
                <input id="_keyword" name="key" type="text" placeholder="指甲油套装 共35个结果" class="text" value="">
            </div>
            <input type="hidden" value="d256b1d537fe186e53c0444399341c24" name="sid">
            <input type="submit" value="" class="submit" id="list_search_submit" dd_name="提交">
        </form>
    </div>
</div>
</header>
<section id="suggest_box">
    <div class="search_list" style="display: none;"></div>
    <div class="shadow_box" style="display: none;"></div>
</section>
<div style="height:47px;" class="empty_div">&nbsp;</div>
<section cite="0" dd_name="你是不是想找" id="hot_search" class="hot_search">
    <ul class="clearfix">
                <li><a name="relatedItem" href="">指甲油货到付款</a></li>
                <li><a name="relatedItem" href="">渐变指甲油</a></li>
                <li><a name="relatedItem" href="">opi指甲油</a></li>
                <li><a name="relatedItem" href="">美甲套装</a></li>
                <li><a name="relatedItem" href="">指甲油 可剥</a></li>
                <li><a name="relatedItem" href="">指甲油工具</a></li>
                <li><a name="relatedItem" href="">护甲油</a></li>
            </ul>
</section><!-- 排序 -->
<section class="filtrate_term" id="product_sort" dd_name="商品排序" style="">
    <ul>
        <li class="on"><a href="javascript:void(0);" name="list_sort_index">默认</a></li><li class=""><a href="" name="list_sort_sales">销量</a></li><li class=""><a href="" name="list_sort_score">评分</a></li><li class=""><a href="" name="list_sort_price">价格<span class="arrow_up"></span><span class="arrow_down"></span></a></li><li class=""><a href="" name="list_sort_date">最新</a></li>
    </ul>
</section>
<!-- result -->
<section class="goods_list" id="goods_list" name="goods_list" dd_name="商品列表" style="">
<input type="hidden" value="0" id="scrolltop" name="scrolltop">
    <div class="clearfix">
<!--     <ul class="clearfix">

    </ul> -->
     
        <ul class="clearfix">

    <?php foreach ($list as $v) { ?>
        <li class="clearfix p_left"><div><a href="<?php echo site_url('homes/shop/'.$v->pid) ?>" name="product_item" dd_name="商品"><p class="img"><img  src="<?php echo $v->pimg ?>" alt="<?php echo $v->pnina ?>" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name"> <?php echo $v->pnina ?> </p></a><p class="price"><span class="red">¥ <?php echo $v->pice ?></span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_0_1100604422&#39;,&#39;1100604422&#39;)" id="search_a_0_1100604422" flag="add"></span></p></div></li>
    <?php } ?>
<!-- 
            <li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img  src="images/1100604422-1_h.jpg" alt="Sweet City/都市甜心油性指甲油美甲套装 魅影OL裸色系列7+1礼盒 TC03" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">Sweet City/都市甜心油性指甲油美甲套装 魅影OL裸色系列7+1礼盒 TC03</p></a><p class="price"><span class="red">¥69.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_0_1100604422&#39;,&#39;1100604422&#39;)" id="search_a_0_1100604422" flag="add"></span></p></div></li>

            <li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1059780222-1_h.jpg" alt="Sweet City/都市甜心油性指甲油美甲套装 魅影星期色系列7+1礼盒 TC01" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">Sweet City/都市甜心油性指甲油美甲套装 魅影星期色系列7+1礼盒 TC01</p></a><p class="price"><span class="red">¥69.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_2_1059780222&#39;,&#39;1059780222&#39;)" id="search_a_2_1059780222" flag="add"></span></p></div></li>
            <li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1227833822-1_h_2.jpg" alt="UPLUS优 家4色指甲油套装8ml*4瓶" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">UPLUS优 家4色指甲油套装8ml*4瓶</p></a><p class="price"><span class="red">¥36.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_4_1227833822&#39;,&#39;1227833822&#39;)" id="search_a_4_1227833822" flag="add"></span></p></div></li><li><div><a href="" dd_name="商品"><p class="img"><img data-original="" src="images/1150466322-1_h.jpg" alt="Sweet City/都市甜心油性指甲油套装 浪漫花海5+1美甲套装礼盒" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">Sweet City/都市甜心油性指甲油套装 浪漫花海5+1美甲套装礼盒</p></a><p class="price"><span class="red">¥59.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_6_1150466322&#39;,&#39;1150466322&#39;)" id="search_a_6_1150466322" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1227829522-1_h_2.jpg" alt="UPLUS 优家4色指甲油套装 8ml*4瓶" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">UPLUS 优家4色指甲油套装 8ml*4瓶</p></a><p class="price"><span class="red">¥36.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_8_1227829522&#39;,&#39;1227829522&#39;)" id="search_a_8_1227829522" flag="add"></span></p></div></li>        <li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/1068957122-1_h_1.jpg" alt=" " style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">Sweet City/都市甜心油性指甲油 美甲礼盒套装 节日礼物 情人节礼物礼盒 </p></a><p class="price"><span class="red">¥149.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_0_1068957122&#39;,&#39;1068957122&#39;)" id="search_2_0_1068957122" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0"  src="images/1375641602-1_h.jpg" alt=" "></p><p class="name">BGIRL指甲油套装12ml*3(M812+M818+M805) </p></a><p class="price"><span class="red">¥17.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_2_1375641602&#39;,&#39;1375641602&#39;)" id="search_2_2_1375641602" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/1216469906-1_h.jpg" alt=" "></p><p class="name">2013新品迪士尼儿童彩妆公主多彩指甲油美甲套装组合假指甲 </p></a><p class="price"><span class="red">¥62.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_4_1216469906&#39;,&#39;1216469906&#39;)" id="search_2_4_1216469906" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/1104239334-1_h_1.jpg" alt=" "></p><p class="name">Hello Kitty凯蒂猫儿童化妆品6色创意美甲笔套装 指甲油 </p></a><p class="price"><span class="red">¥84.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_6_1104239334&#39;,&#39;1104239334&#39;)" id="search_2_6_1104239334" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/1101921400-1_h.jpg" alt=" "></p><p class="name">zero nana美甲胶工具套装 光疗胶芭比胶QQ胶蔻丹胶 指甲油胶套组 初学/全能版 </p></a><p class="price"><span class="red">¥253.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_8_1101921400&#39;,&#39;1101921400&#39;)" id="search_2_8_1101921400" flag="add"></span></p></div></li>
 -->             
        </ul>
<!-- 
        <ul class="clearfix p_right">
            <li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img  src="images/1012542452-1_h_1.jpg" alt="美宝莲 色秀指甲油新潮波点套装裸色亮片糖果色快干美甲" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">美宝莲 色秀指甲油新潮波点套装裸色亮片糖果色快干美甲</p></a><p class="price"><span class="red">¥15.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_1_1012542452&#39;,&#39;1012542452&#39;)" id="search_a_1_1012542452" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1155013922-1_h.jpg" alt="Sweet City/都市甜心油性指甲油礼盒 闪粉红色渐变搭配5+1美甲套装" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">Sweet City/都市甜心油性指甲油礼盒 闪粉红色渐变搭配5+1美甲套装</p></a><p class="price"><span class="red">¥59.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_3_1155013922&#39;,&#39;1155013922&#39;)" id="search_a_3_1155013922" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1378008002-1_h.jpg" alt="BGIRL指甲油套组20色套装6mlx20" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">BGIRL指甲油套组20色套装6mlx20</p></a><p class="price"><span class="red">¥28.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_5_1378008002&#39;,&#39;1378008002&#39;)" id="search_a_5_1378008002" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1227836522-1_h.jpg" alt="UPLUS优家4色指甲油套装8ml*4瓶" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">UPLUS优家4色指甲油套装8ml*4瓶</p></a><p class="price"><span class="red">¥36.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_7_1227836522&#39;,&#39;1227836522&#39;)" id="search_a_7_1227836522" flag="add"></span></p></div></li><li><div><a href= name="product_item" dd_name="商品"><p class="img"><img data-original="" src="images/1100595022-1_h.jpg" alt="Sweet City/都市甜心油性指甲油套装 魅影系列糖果系列7+1美甲礼盒" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">Sweet City/都市甜心油性指甲油套装 魅影系列糖果系列7+1美甲礼盒</p></a><p class="price"><span class="red">¥69.00</span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_9_1100595022&#39;,&#39;1100595022&#39;)" id="search_a_9_1100595022" flag="add"></span></p></div></li>        <li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/1196582830-1_h_1.jpg" alt=" " style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name">都市甜心水性可剥指甲油套装 可撕可剥美甲5件套 美甲用品 </p></a><p class="price"><span class="red">¥119.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_1_1196582830&#39;,&#39;1196582830&#39;)" id="search_2_1_1196582830" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/ha3.jpg" alt=" "></p><p class="name">UPLUS 优家4色指甲油套装8ml*4瓶 (02#金砂焕彩)</p></a><p class="price"><span class="red">¥36.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_3_1227830522&#39;,&#39;1227830522&#39;)" id="search_2_3_1227830522" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/ha2.jpg" alt=" "></p><p class="name">迪士尼公主系列儿童化妆品 单套指甲油组合 美甲套装 D22018 </p></a><p class="price"><span class="red">¥28.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_5_1310911107&#39;,&#39;1310911107&#39;)" id="search_2_5_1310911107" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/ha3.jpg" alt=" "></p><p class="name">Sweetcity/都市甜心油性指甲油套装 白屋海岸5+1美甲套餐礼盒 </p></a><p class="price"><span class="red">¥59.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_7_1150466422&#39;,&#39;1150466422&#39;)" id="search_2_7_1150466422" flag="add"></span></p></div></li><li><div><a href="" name="product_item" dd_name="商品"><p class="img"><img class="img_lazy_0" data-original="" src="images/1375805902-1_h.jpg" alt=" "></p><p class="name">BGIRL指甲油套装12ml*3(M807+M814+M801) </p></a><p class="price"><span class="red">¥17.00</span><span name="item_collect" dd_name="收藏" class="span_sc " onclick="m_collect.searchWishlist(&#39;2_9_1375805902&#39;,&#39;1375805902&#39;)" id="search_2_9_1375805902" flag="add"></span></p></div></li>
            </ul>
 -->
    </div>
</section>
<section class="error_mm" style="display:none;"><span class="text" id="customer_load">收藏中 ...</span></section>
<!-- 加载更多 -->
<input type="hidden" id="curr_page" value="2">
<!-- <section class="load"><div><span style="">上一页</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="">下一页</span></div></section> -->

</section>



<section id="mix_search_div" dd_name="搜索浮层" style="display: none;">
    <header id="bd">
<header class="con floatsearch">
    <div id="component_1434612"></div>
    <section class="mix_new_header">
        <a href="javascript:void(0)" class="mix_back"></a>
        <form id="index_search_form" method="get" action="" target="_parent" onsubmit="return mix_submit_search();">
            <div class="search">
                <div class="text_box">
                    <input id="keyword" name="keyword" type="text" value="指甲油套装 共35个结果" placeholder="搜索商品、品牌、种类" class="keyword text" onkeydown="this.style.color=&#39;#404040&#39;;" maxlength="70" autocomplete="off">
                </div>
                <span class="mix_submit"></span>
                <a href="javascript:void(0)" class="clear_input" id="clear_input" style="display: block;"></a>
                <input type="hidden" value="0" name="cid" id="cid">
                <input type="hidden" value="d256b1d537fe186e53c0444399341c24" name="sid">
            </div>
            <input type="submit" value="搜索" class="mix_filtrate">
        </form>
    </section>
    <section class="mix_search_list"></section>

    <section class="mix_recently_search"><h3>搜索历史</h3><div class="recently_search_null">没有搜索记录</div></section>
    <div class="spacer"></div>
</header>
</header></section>

<script src="<?php echo base_url('static/plists/js/zepto.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/fx.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/fx_methods.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/zepto.lazyload.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/zepto.cookie.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/common.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/search.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/filter.min.js') ?>"></script>
<script src="<?php echo base_url('static/plists/js/mix_suggest.min.js') ?>"></script>
<script>
    var sid = "d256b1d537fe186e53c0444399341c24";
    $(document).ready(function(){
        //图片延迟加载
        $("img[data-original]").lazyload();
        //初始化收藏功能
        $.extend(m_collect, {
            mdd_token : '',
            search_login_url : ''
        });
        //初始化加载更多功能
        var fromType = location.href.indexOf("search\.php") > 0 ? 'search' : 'category';
        $.extend(m_loadMore, {
            p : '{"keyword":"指甲油套装","act":"get_more","from":"'+fromType+'","cid":"0","sid":"'+sid+'","page":1}',
            big_pic_class : "",
            type : 1
        });
        m_loadMore.init();
        //筛选浮层显示控制
        var filtrate = $(".filtrate"), submit = $(".submit,.back");
        filtrate.bind("click", function () {
            $("._next").show();
            $("._pre").hide();
            window.scrollTo(0, 0);
        });
        submit.bind("click", function () {
            $("._next").hide();
            $("._pre").show();
        });
        //初始化筛选浮层
        bizFilter.init();
        //初始化suggest模块，老版无搜索浮层情况
        /*function submit_search() {
            var key = $('#keyword');
            var value = key.val();
            if (value == "") {
                return false;
            }
            key.val(value.replace(/\s+共\d+个结果/, ''));
            return true;
        }
        new Suggest({
            operator: "#_keyword",
            defaultVal: "",
            hasFocus: false,
            ajaxUrl: "?req=suggest",
            formEl: "#search_form"
        });*/
        //返回顶部逻辑
        $("#backtop").click(function(){
            window.scrollTo(0, 0);
        });
    });
</script>
<script>
    $(function(){
        //搜索浮层显示逻辑
        var sbox = $("#head_search_box"),
                sort = $('#product_sort'),
                related = $("#hot_search"),
                g_list = $("#goods_list"),
                g_m1 = "0", g_m2 = "90px";
        var initCss = function (type) {
            if (type == 1) {
                sort.css({"position":"static","width":"100%"});
                g_list.css("margin-top", g_m1);
            } else {
                sort.attr("style", "");
                g_list.css("margin-top", g_m2);
            }
        };
        var m = {
            input: $("#_keyword"),
            rawAll: '',
            dd: $(".text_box"),
            cancel: $(".mix_back"),
            rawKey: '指甲油套装',
            main: function () {
                this.init();
                this.be();
            },
            init: function () {
                this.rawAll = this.input.val();
            },
            be: function () {
                var _this = this;
                this.input.focus(function () {
                    var mix_search = $("#mix_search_div");
                    if (mix_search.length > 0) {
                        _this.dd.trigger("click");  //for ddclick
                        $("._pre").hide();
                        mix_search.show();
                        $("#keyword").val(_this.rawKey).focus();
                        return;
                    }
                    var newKey = _this.input.val();
                    if (newKey != _this.rawKey && newKey != _this.rawAll) {
                        $(this).val(newKey);
                    } else {
                        $(this).val(_this.rawKey);
                    }
                    if ($(window).scrollTop() > 0) {
                        initCss(1);
                        window.scrollTo(0, 0);
                        _this.dd.trigger("click");  //for ddclick
                    }
                }).blur(function () {
                            var newKey = _this.input.val();
                            if (newKey === _this.rawKey) {
                                $(this).val(_this.rawAll);
                            } else {
                                $(this).val(newKey);
                            }
                        });
                this.cancel.bind("click", function () {
                    $("#mix_search_div").hide();
                    $("._pre").show();
                });
            }
        };
        m.main();
        $(window).resize(function () {
            sbox.css("width", "100%");
            sort.css("width", "100%");
        });

        //顶部sticky效果
        setTimeout(function () {
            var sboxH = sbox.height();
            var relatedH = related.height();
            relatedH <= 20 && related.remove();
            var sortH = sort.height();
            var sortStart = sort.offset().top - sboxH;
            var showEnd = sort.offset().top;
            var init = function () {
                sbox.css({"position":"fixed", "top":"0"});
                window.scrollTo(0, 0);
            };
            var rawScroll = 0, nowScroll = 0;
            var upOrDown = function () {
                var delta = 30;
                if (nowScroll > rawScroll + delta) {
                    return 1;
                } else if (nowScroll < rawScroll - delta) {
                    return 2;
                } else {
                    return 0;
                }
            };
            var sticky = function () {
                nowScroll = $(window).scrollTop();
                if (nowScroll >= sortStart) {
                    sort.css({"position":"fixed","top":sboxH});
                    g_list.css({"margin-top":sortH});
                } else {
                    sort.attr("style", "");
                    g_list.attr("style", "");
                }
                if (nowScroll > showEnd + sortH) {
                    var up = upOrDown();
                    if (up == 1) {
                        if (sbox.css("display") != "none") {
                            sbox.hide();
                            sort.hide();
                        }
                        rawScroll = nowScroll;
                    } else if (up == 2) {
                        if (sbox.css("display") == "none") {
                            sbox.show();
                            sort.show();
                        }
                        rawScroll = nowScroll;
                    }
                } else {
                    if (sbox.css("display") == "none") {
                        sbox.show();
                        sort.show();
                    }
                }
            };
            init();
            $(document).on("touchmove", sticky);
            $(window).on("scroll", sticky);
        }, 500);
    });
</script>
<script src="<?php echo base_url('static/plists/js/js_tracker.js') ?>"></script>

</body>
</html>
