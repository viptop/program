<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="application-name" content="">
        <title><?php if($s=='edit'){ ?>编辑收货地址<?php }else{ ?> 添加收货地址 <?php }?></title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="version" content="ddtouch">
        <meta http-equiv="Cache-Control" content="must-revalidate,no-cache">
        <script src="<?php echo base_url('static/pcarts/js/zepto-1.1.6.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('static/pcarts/js/fx.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('static/pcarts/js/fastclick.js') ?>" type="text/javascript"></script>
        <?php include 'stor-header.php'; ?>
        <script type="text/javascript">
            var sid = "d256b1d537fe186e53c0444399341c24";
        </script>
    </head>
<body style="height: 891px;"><script type="text/javascript">
    var gifts = $.parseJSON('{"1100604422":{"maiyizengduo":[],"maiazengb":[],"huangou":[]}}');//console.log(gifts);
    var hasChecked = "1";
</script>
<link rel="stylesheet" href="<?php echo base_url('static/pcarts/css/cart_v3.css') ?>">
<header class="header" style="">
    <a href="javascript:history.back();" class="back">返回</a>
    <div class="h_label" style="color:#464646;"><?php if($s=='edit'){ ?>编辑收货地址<?php }else{ ?> 添加收货地址 <?php }?></div>
    <nav class="t-nav"></nav>
<?php include 'yeld.php'; ?>
</header>
<!--<header class="navbar" style="">
    <div class="nav_main">
        <span class="center" style="color:#464646;">购物车</span>
        <a class="fl c_back" style="color:#464646;background-image:url(../images/c_back_btn.png);">返回</a>
        <span><a>编辑</a></span>
    </div>
</header>-->
<div id="wrapper" style="height: 689px;">
    <div class="viewport" id="scroller" style="-webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(0px, 0px) translateZ(0px);">
    <form action="<?php echo site_url('homes/sales/'.$h) ?>" id="forem" method="post" accept-charset="utf-8">
        <section class="content">
                <div class="block">
                        <div class="cart_list">
                    <div class="shop_title" shop_id="6860">
    <!-- <input type="checkbox" class="fl c_checkbox"> -->
    <div class="fl"><span class="shopLink eclipse" href=""></span></div>
        <!-- <a class="fl right_arrow" href="#"></a> -->
</div>

                <?php if($s=='edit') { ?>
                    <div class="cart_item" id="1100604422" item_id="" stock="195">
                        <input type="hidden" name="ites" value="<?php if($pdtor) echo $pdtor->id ?>" class="fl c_checkbox"/>
                        <input type="hidden" name="ituid" value="<?php if($pdtor) echo $pdtor->uid ?>" class="fl"/>
                        <input type="hidden" name="itsign" value="<?php echo $s ?>" class="fl"/>
                               <!-- <img src="images/1100604422-1_h.jpg" class="fl pro_pic"> -->
                        <div class="detail">
                            <!-- <p class="fr prd_price">￥69.00</p> -->
                            <p class="fl prd_tit" style="padding-left:5%;"><textarea name="textdid" rows="6" cols="60" value="<?php if($pdtor) echo $pdtor->adds ?>" ><?php if($pdtor) echo $pdtor->adds ?></textarea></p>
                            <p class="clear tags">
                            </p>
                        </div>
                        <div class="bottom_line"></div>
                    </div>
                    <?php }else{ ?>
                    <div class="cart_item" id="1100604422" item_id="" stock="195">
                        <input type="radio" name="ites" value="" class="fl c_checkbox"/>
                        <input type="hidden" name="ituid" value="" class="fl"/>
                        <input type="hidden" name="itsign" value="<?php echo $s ?>" class="fl"/>
                               <!-- <img src="images/1100604422-1_h.jpg" class="fl pro_pic"> -->
                        <div class="detail">
                            <!-- <p class="fr prd_price">￥69.00</p> -->
                            <p class="fl prd_tit"><textarea name="textdid" rows="6" cols="60" placeholder="请输入收货地址" value=""></textarea></p>
                            <p class="clear tags">
                            </p>
                        </div>
                        <div class="bottom_line"></div>
                    </div>
                    <?php } ?>

                        </div>
                </div>
            </section>
            </form>    
                    
    </div>
         <footer class="total_result" style="">
         
<!-- <div class="fl ">
    <input type="checkbox" class="c_checkbox" id="cart_check_all" style="">
    <span style="color:">全选</span>
</div> -->
       
<div class="fr"> 
    <a style="color:;background-color:;border:.1rem solid red;" class="c_btn payBtn" href="javascript: charse(<?php if($pdtor) echo $pdtor->id ?>) ;">确认修改</a> 
</div>


                <form id="cart_form" action="" method="post">
                        <input type="hidden" value="touch" name="user_client">
                        <input type="hidden" value="1.0" name="client_version">
                        <input type="hidden" value="get_order_flow" name="action">
                        <input type="hidden" value="" name="union_id">
                        <input type="hidden" value="20151007171938214237638454188786121" name="permanent_id">
                        <input type="hidden" value="0" name="shop_id">
                        <input type="hidden" value="d256b1d537fe186e53c0444399341c24" name="udid">
                        <input type="hidden" value="1444445736" name="timestamp">
                        <input type="hidden" value="12a421d5328d6fe614213acfd06f0442" name="time_code">
                        <input type="hidden" value="ckadd" name="ref">
                </form>
        </footer>
        </div>

<section class="loading"></section>
<section class="f_mask"></section>
<section class="simple_block"></section>
<section class="m_block">
    <div class="m_content"></div>
    <div class="m_btns">
        <a class="m_ok_2">确定</a>
        <a class="m_cancel">取消</a><a class="m_ok">确定</a>
    </div>
</section>
<section direction="0" class="jp_block">
    <p class="jp_title"><a class="c_ok"></a>修改购买数量<a class="c_close"></a></p>
    <div class="jp_content">
        <div class="jp_show">
            <div></div>
            <div><input type="number" pattern="[0-9]*"></div>
            <div></div>
        </div>
    </div>
</section>
<section direction="1" class="f_block" id="gift_block">
    <p class="f_title"><span></span><a class="c_close"></a></p>
    <div class="f_content">
        <div class="cart_list"></div>
    </div>
    <div class="f_foot">
        <a class="c_btn">确认</a>
    </div>
</section>

<section direction="0" class="f_block" id="choose_color_size">
    <p class="sel_title"><a class="c_close"></a></p>
    <div class="f_content">

        <div class="select_box"></div>
        <ul class="sel_list">
            <li><img src=""><a class="f_del"></a><div class="detail"><p class="prd_price"></p><p class="prd_tit"></p></div></li>
        </ul>

    </div>


<div class="f_foot">
    <a class="c_btn">确认</a>
</div>
</section>

<script src="<?php echo base_url('static/pcarts/js/util.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/pcarts/js/iscroll5.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/pcarts/js/cart.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/pcarts/js/stack.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('static/pcarts/js/js_tracker.js') ?>"></script>
</body>
</html><!--LHC-2015-10-10-->
