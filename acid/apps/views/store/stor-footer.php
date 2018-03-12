<script src="<?php echo base_url('static/list/js/zepto.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/underscore.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/iscroll5.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/fastclick.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/mod_countdown.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/mod_suggest.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/mdd_index.min.js') ?>"></script>
<script src="<?php echo base_url('static/list/js/js_tracker.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    var v = <?php echo empty($phone)?'0':$phone ?>;
    if(v==0)
	var text = '请在游戏中绑定手机后，再尝试兑换。';alert(text);
  });
</script>
</body>

</html>