<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title>博森积分商城</title>
		<link rel="stylesheet" href="<?php echo base_url('static/css/index.css') ?>" />
		<?php $h='/u/'.$u.'/n/'.$n.'/a/'.$a; ?>
		<link rel="stylesheet" href="<?php echo base_url('static/css/madie-index.css') ?>" />
		<script type="text/javascript" src="<?php echo base_url('static/js/stor.js') ?>"></script>
	</head>
	<body>
		<!--整体-->
		<div class="head">
			<div class="search">
				<div class="Search-box">
					<input type="text" placeholder="搜索你需要的物品" id="sear_box"/>
					<div class="searchsrc"></div>
					<div class="Personal"><a href="<?php echo site_url('homes/personal') ?>"></a></div>
					<div class="Slide">
					<ul>
						<li id="li">←</li>
						<li>啤酒</li>
						<li>电器</li>
						<li>家具</li>
						<li>玩具熊</li>
						<li>手机</li>
						<li>装饰品</li>
						<li>→</li>
					</ul>
				</div>
				</div>
				<!--滑动-->
				
			</div>	
			<div class="Content">
				<div class="content-warp">
					<ul>
						<li>
							<a href="<?php echo site_url('homes/shop'.$h.'/1') ?>"><img src="<?php echo base_url('static/img/timg.jpg') ?>"></a>
							<span><img src="<?php echo base_url('static/img/2x.png') ?>"><a>2000</a></span>
						</li>
						<li>
							<a href="<?php echo site_url('homes/shop'.$h.'/2') ?>"><img src="<?php echo base_url('static/img/timg3.jpg') ?>"></a>
							<span><img src="<?php echo base_url('static/img/2x.png') ?>"><a>3000</a></span>
						</li>
						<li>
							<a href="<?php echo site_url('homes/shop'.$h.'/3') ?>"><img src="<?php echo base_url('static/img/timg4.jpg') ?>"></a>
							<span><img src="<?php echo base_url('static/img/2x.png') ?>"><a>2000</a></span>
						</li>
						<li>
							<a href="<?php echo site_url('homes/shop'.$h.'/4') ?>"><img src="<?php echo base_url('static/img/timg2.jpg') ?>"></a>
							<span><img src="<?php echo base_url('static/img/2x.png') ?>"><a>3000</a></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>

<script>
	
</script>