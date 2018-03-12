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
<?php $h=rand().'/'; ?>
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
        <ul class="clearfix p_left">
        <?php foreach ($list as $v) { ?>
            <li><div><a href="<?php echo site_url('homes/modify/'.$h.$v->id) ?>" name="product_item" dd_name="商品"><p class="img"><img  src="<?php echo base_url('static/plists/images/1100604422-1_h.jpg') ?>" alt="Sweet City/都市甜心油性指甲油美甲套装 魅影OL裸色系列7+1礼盒 TC03" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);"></p><p class="name"> <?php echo $v->pnina ?> </p></a><p class="price"><span class="red">¥ <?php echo $v->pice ?></span><span name="item_collect" dd_name="收藏" class="span_sc" onclick="m_collect.searchWishlist(&#39;a_0_1100604422&#39;,&#39;1100604422&#39;)" id="search_a_0_1100604422" flag="add"></span></p></div></li>
        <?php } ?>
        </ul>
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
<script src="<?php echo base_url('static/plists/s/js_tracker.js') ?>j"></script>

</body>
</html><!--LHC-2015-10-09-->
