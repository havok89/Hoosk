<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-dashboard"></i>
              <h3><?php echo $this->lang->line('dash_welcome'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                    <div class="text">
                    <p><?php echo $this->lang->line('dash_message'); ?></p>
                    </div>
                <!-- /widget-content --> 
            </div>
          </div>
          <!-- /widget -->

         
        </div>
        <!-- /span6 -->
        <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3><?php echo $this->lang->line('dash_recent'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items">
				<?php 
				function wordlimit($string, $length = 40, $ellipsis = "...")
					{
						$string = strip_tags($string, '<div>');
						$string = strip_tags($string, '<p>');
						$words = explode(' ', $string);
						if (count($words) > $length)
							return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
						else
							return $string.$ellipsis;
					}
				foreach ($recenltyUpdated as $p) {
                echo "<li>";
                	echo '<div class="news-item-date"><span class="news-item-day">'.date("jS", strtotime($p["pageUpdated"])).'</span> <span class="news-item-month">'.date("M", strtotime($p["pageUpdated"])).'</span> </div>';
                  	echo '<div class="news-item-detail"> <a href="/admin/pages/edit/'.$p['pageID'].'" class="news-item-title" target="_blank">'.$p['pageTitle'].'</a>';
                   	echo '<p class="news-item-preview">'.wordlimit($p['pageContentHTML']).'</p>';
                  	echo '</div>';
				echo '</li>';
				} ?>
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->


        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

<?php echo $footer; ?>