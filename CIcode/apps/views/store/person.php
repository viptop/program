<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title></title>
		<link rel="stylesheet" href="<?php echo base_url('static/css/PersonalCenter.css') ?>" />
	</head>
	<body>
		<!--头部信息-->
		<div class="avatar">
			<!--背景-->
			<div class="avatar_position">
				<div class="top">
					个人中心
				<a href="<?php echo site_url('homes') ?>" class="a_img"><img src="<?php echo base_url('static/img/fanhui@3x.png') ?>"></a>
				
				</div>
			</div>
			<div class="head_portrait">
				<div class="pic_rudius"><img src="<?php echo base_url('static/img/5981841d6f7507dca99f685d05a518b5.jpg') ?>">
					<p>wind</p>
				</div>
				<div class="wenzi">
					<a style="color: rgb(85,109,164);">2000</a>
					<p>积分</p>
				</div>
			</div>
			<div class="menu">
				<div class="menu_one">
					<ul>
						<a href="<?php echo site_url('homes/orders') ?>"><li>我的订单<img src="<?php echo base_url('static/img/fanhui@12x.png') ?>"></li></a>
					</ul>
				</div>
				<div class="menu_two">
					<ul>
						<a href="<?php echo site_url('homes/records') ?>"><li>兑换记录<img src="<?php echo base_url('static/img/fanhui@12x.png') ?>"></li></a>
					</ul>
				</div>
				<div class="menu_three">
					<ul>
						<a href="<?php echo site_url('homes/carts') ?>"><li>我的地址<img src="<?php echo base_url(
						'static/img/fanhui@12x.png') ?>"></li></a>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>
