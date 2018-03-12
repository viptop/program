<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?php echo current_url()?>" >
<div class='panel panel-default'>
	<div class='panel-heading'>
		<i class='icon-edit icon-large'></i>
		<?php echo $is_edit?"修改":"新增"?>商品信息
		<div class='panel-tools'>

			<div class='btn-group'>
				<?php aci_ui_a($folder_name,'store','index','',' class="btn  btn-sm "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
			</div>
		</div>
	</div><?php //var_dump($this->method_config); ?>
	<div class='panel-body'>
		<fieldset>
				<legend>基本信息</legend>
<?php if(!$is_edit):?>
					<div class="form-group">
						<label class="col-sm-2 control-label">商品名称</label>
						<div class="col-sm-4">
							<input type="text" name="username"  id="username"  class="form-control validate[required]"  placeholder="请输入" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">兑换价格</label>
						<div class="col-sm-4">
						  <input name="changes" type="text" class="form-control" id="changes" placeholder="" value="" size="45" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-2 control-label">库存数量</label>
						<div class="col-sm-4">
						  <input name="reku" type="text" class="form-control validate[equals[reku]]" id="reku" placeholder="" value="" size="45" />
						</div>
					</div>
<?php else:?>
					<div class="form-group">
						<label class="col-sm-2 control-label">商品名称</label>
						<div class="col-sm-4">
							<input type="text" name="username"  id="username" readonly value="<?php echo $data_info['pnina'] ?>"  class="form-control validate[required]"  placeholder="请输入" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">兑换价格</label>
						<div class="col-sm-4">
						  <input name="changes" type="text" class="form-control" readonly value="<?php echo $data_info['pice'] ?>" id="changes" placeholder="" value="" size="45" />
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-2 control-label">库存数量</label>
						<div class="col-sm-4">
						  <input name="reku" type="text" class="form-control validate[equals[reku]]" id="repassword" readonly value="<?php echo $data_info['stock'] ?>" placeholder="" value="" size="45" />
						</div>
					</div>
<?php endif;?>

<!-- 					
					<div class="form-group">
						<label  class="col-sm-2 control-label"> </label>
						<div class="col-sm-4">
						  <select class="form-control validate[required]" name="group_id">
							  <?php echo group_options($data_info['group_id'])?>
							</select>
						</div>
					</div> 
-->

			</fieldset>

		<fieldset>
			<legend>商品图片</legend>

  	  		<div class="form-group">
				<label class="col-sm-2 control-label">商品图片</label>
				<div class="col-sm-9">
					<img  width="100" id="thumb_SRC" border="1" src="<?php echo $this->method_config['upload']['thumb']['upload_url']?>/<?php if(!empty($data_info)) echo $data_info['pimg'] ?>"/><input type="hidden" id="thumb" name="thumb" value="<?php ?>" /> 
                    <?php aci_ui_a('','','','',' class="btn btn-default btn-sm uploadThumb_a"','选择图片 ...')?><span class="help-block">只支持图片上传.</span>
				</div>
			</div>
            <div class="form-group">
				<label  class="col-sm-2 control-label">是否锁定</label>
				<div class="col-sm-4">
                  	<label class="radio-inline">
                      <input type="radio" name="is_lock" id="is_lock1" value="1" <?php ?> /> 是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="is_lock" id="is_lock2" value="0" <?php ?> /> 否
                    </label>
				</div>
			</div>
	      </fieldset>


		<div class='form-actions'>
			<?php aci_ui_button($folder_name,'store','edit',' type="submit" id="dosubmit" class="btn btn-primary " ','保存')?>
		</div>
     </div>

</form>

<script language="javascript" type="text/javascript">

	var id = <?php echo !empty($data_info)?$data_info['id']:"0"; ?>;
	var edit= <?php echo $is_edit?"true":"false"?>;
	var folder_name = "<?php echo $folder_name?>";
	function getThumb(v,s,w,h){
		$("#thumb").val(v);
		$("#thumb_SRC").attr("src","<?php echo $this->method_config['upload']['thumb']['upload_url']?>"+v);
		$("#dialog" ).dialog("close");
	}

	require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
		require(['<?php echo SITE_URL?>scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/edit.js']);
	});
</script>