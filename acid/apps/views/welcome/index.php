<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<?php echo template('public','header_view',array('date'=>$date))?>
 <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">

          </div>

          <div class="inner cover">
            <?php (version_compare(PHP_VERSION, '5.3.0'))?>
                  <a href="<?php echo site_url('adminpanel')?>" class="btn btn-lg btn-default">进入后台管理</a>
                </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <!-- <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p> -->
            </div>
          </div>

        </div>

      </div>

    </div>
<?php echo template('public','footer_view')?>