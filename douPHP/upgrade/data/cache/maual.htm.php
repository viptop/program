<?php /* Smarty version 2.6.26, created on 2015-07-27 20:58:58
         compiled from maual.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link href="template/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
 <div class="logo"><a href="http://www.douco.com" target="_blank"><img src="template/logo.gif" alt="DouPHP" title="DouPHP" /></a></div>
 <div class="maual"> 
  <h3><?php echo $this->_tpl_vars['lang']['maual']; ?>
</h3>
  <ul>
   <li><i>1</i>请先下载需要更新的几个模板文件并覆盖到对应目录。<a href="http://down.douco.com/DouPHP_1.2_Theme.rar" target="_blank">下载需要更新的模板文件</a></li>
   <li><i>2</i>请先下载最新的伪静态规则覆盖到您的站点根目录和手机版“m”目录。<a href="http://down.douco.com/rewrite.rar" target="_blank">下载最新伪静态规则</a></li>
   <li class="o"><i>3</i>可选操作，如要体验新版文章搜索功能则需将新版DouPHP中"theme/default"目录完整地覆盖到您的站点对应目录。</li>
  </ul>
  <p class="action">
   <a href="index.php?step=upgrade" class="btn"><?php echo $this->_tpl_vars['lang']['maual_next']; ?>
</a>
  </p>
 </div>
</div>
</body>
</html>