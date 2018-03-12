<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title></title>
		<link rel="stylesheet" href="<?php echo base_url('static/css/ShoppingCarts.css') ?>" />
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js" ></script>
		
	</head>
	<body>
		<div class="head-warp" id="head-warp">
			<div class="head-top">
				<div class="blank"><img src="img/fanhui@3x.png" class="img1"/>我的收货地址</div>
			</div>
			
			<div class="address">
				<div class="address-top"><p>&nbsp;&nbsp;&nbsp;&nbsp;林德江  156****0647</p></div>
				<div class="address-buttom"><p>&nbsp;&nbsp;&nbsp;&nbsp;广东 广州市 天河区 吉山上街四巷4号</p></div>
				<div class="address-img"><a href="<?php echo site_url('homes/modifyt') ?>" style="text-decoration: none; color: black;"><img src="<?php echo base_url('static/img/bianxie.png') ?>" class="bianxie"></a><img src="<?php echo base_url('static/img/shangchu.png') ?>" class="shangchu"onclick="marck()"></div>
			</div>
			<?php if($k){ ?>
<a href="<?php echo site_url('homes/versy/'.$k) ?>"><div class="flood" id="flood">确定兑换</div></a>
			<?php }else{ ?>
<a href="<?php echo site_url('homes/modifyt/'.$k) ?>"><div class="flood" id="flood">新增收货地址</div></a>
			<?php } ?>
			
		</div>
		<div class="zhezao"></div>
		<div class="warning">
			<div class="warning-top">
				<h4>删除地址</h4>
				<h5>确定删除该收货地址吗？</h5>
			</div>
			<div class="warning-bottom">
				<div class="left" onclick="marckhide()">确定</div>
				<div class="right" onclick="cancel()">取消</div>
			</div>
		</div>
	</body>
</html>

<script>

function marck(){
	$('.zhezao').show();
	$('.warning').slideDown();

}

function marckhide(){
	var iktll=$('body .address');
	for(var i=0;i<iktll.length;i++){
		var g=$('#'+i).attr('id');
		$('.address').remove();
	}
	$('.zhezao').hide();
	$('.warning').hide();
	location.href="<?php echo site_url('homes/delcarts') ?>";
}
function cancel(){
	$('.zhezao').hide();
	$('.warning').hide();
}
</script>