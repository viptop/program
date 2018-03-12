<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title>新建收货地址</title>
		<link rel="stylesheet" href="<?php echo base_url('static/css/modifyt.css') ?>" />
		<!-- <script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js" ></script> -->
		<script src="<?php echo base_url('static/js/modifyt.js') ?>" ></script>
	</head>
	<body>
	<form method="post" >
		<div class="modify">
			<div class="modify-top"><a href="<?php echo site_url('homes/') ?>"><img src="<?php echo base_url('static/img/fanhui@3x.png') ?>"></a>新建收货地址<span class="span"><a onclick="checkPhone()">保存</a></span></div>
			<div class="centent" >
				<ul>
					<li>姓名<input type="text" class="text1" placeholder="至少两位"></li>
					<li>电话<input type="text" class="text2" placeholder="至少7位" id="tel"></li>
					<li id="check_1">*请输入手机号</li>
					<li>地区<input type="text" class="text3" ></li>
					<li>地址<input type="text" class="text4"placeholder="5~60个之，且不能全为数字"></li>
					<li>邮编<input type="number" class="text5" min="1"  max="5" placeholder="六位邮政编码"></li>
				</ul>
			</div>
		</div>
	</form>
	</body>
</html>

