<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<title>修改收货地址</title>
		<link rel="stylesheet" href="<?php echo base_url('static/css/modify.css') ?>" />
		<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdn.bootcss.com/jquery-validate/1.17.0/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('static/js/modify.js') ?>" ></script>
	</head>
	<body>
		<div class="modify">
		<form id='valid' action="<?php echo site_url('homes/versy') ?>" method="post">
			<div class="modify-top"><img src="<?php echo base_url('static/img/fanhui@3x.png') ?>">修改收货地址<span class="span"><a class="ajax" onclick="checkPhone()">保存</a></span></div>
			<div class="centent" >
				<ul>
					<li>姓名<input type="text" class="text1" placeholder="至少两位" ></li>
					<li>电话<input type="text" name="mobile" class="text2" placeholder="至少7位" maxlength="11" id="tel"></li>
					<li id="check_1">*请输入手机号</li>
					<li>地区<input type="text" class="text3" ></li>
					<li>地址<input type="text" class="text4"placeholder="5~60个字，且不能全为数字"></li>
					<li>邮编<input type="number" class="text5" maxlength="6" placeholder="六位邮政编码" ></li>
				</ul>
			</div>
		</form>
		</div>
	</body>
</html>
