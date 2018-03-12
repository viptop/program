<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title></title>
		<link rel="stylesheet" href="<?php echo base_url('static/css/shopping.css') ?>" />
		<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-mobile/1.4.5/jquery.mobile.min.css" />
	</head>
	<body>
		<div class="head">
		<form id='valid' action="<?php echo site_url('homes/carts/'.$p) ?>" method="post">
			<div class="Above">
				<div class="Retrun"><a href="<?php echo site_url('homes/index') ?>"><img src="<?php echo base_url('static/img/fanhui@2x.png') ?>"></a></div>
				<div class="centx">兑换商品详情</div>
				<a href="<?php echo site_url('homes/personal') ?>"><div class="geren"></div></a>
			</div>
			<div class="shopp-pic"><img src="<?php echo base_url('static/img/timg.jpg') ?>"></div>
			<div class="Settlement">
				<p class="p">啤酒</p>
				<div class="Settlement-left">
					<a><img src="<?php echo base_url('static/img/2x.png') ?>" /></a>
					<a class="a">2000</a>
				</div>
				<div class="Settlement-right3"><input type="button"  name="" class="input1" /></div>
				<div class="Settlement-right2"><input type="text" name="tex" value="1"  class="input2" /></div>
				<div class="Settlement-right1"><input type="button"  name="" class="input3" /></div>
				<div class="Settlement-right">
					<a>库存10000箱</a>
				</div>
			</div>
			<button type="submit" class="fool">
				<a class="letgo">兑换成功</a>
			</button>
			<div class="lable">
				<a class="lable-a">手机</a>
				<a>啤酒</a>
				<a>家具</a>
			</div>
		</form>
		</div>
	</body>
</html>
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js" ></script>
<script>
	var i=1;
	
	$('.input1').mousedown(function(){
		i++;
		$('.input2').val(i)	
	})
	
	$('.input3').click(function(){
		if(i==0){
			i=0;
		}else{
			i--;
		$('.input2').val(i)
		}
	})

	$('.letgo').click(function(){
		var integral=$('.a').text();
		var numbers = $('.input2').val();
		$.get('/index',
				{
					user1:integral,user2:numbers
				},
		function(result){
			
		})
		
	})
	
</script>