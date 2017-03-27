<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('dash_welcome'); ?>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                <i class="fa fa-dashboard"></i>
                	<?php echo $this->lang->line('nav_dash'); ?>
                </li>
            </ol>
        </div>
        <?php if($maintenaceActive){ ?>
        <div class="col-md-12">
        	<div class="alert alert-warning">
        		<p><?php echo $this->lang->line('dash_maintenance_message'); ?></p>
        	</div>
        </div>
        <?php } ?>
    </div>
</div>
<div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
        	<div class="panel panel-default">
            	<div class="panel-body">
					<p><?php echo $this->lang->line('dash_message'); ?></p>
                </div>
            </div>
            <?php if(RSS_FEED) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        <i class="fa fa-newspaper-o fa-fw"></i>
                        <?php echo $this->lang->line('feed_heading'); ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                        <?php
                        if($hooskFeed) {
                            foreach ($hooskFeed as $item) {
                                $date = date_create($item['pubDate']);
                                echo '<li class="list-group-item"><span class="badge">' . date_format($date, "jS M y") . '</span>';
                                echo '<p><a href="' . $item['link'] . '" class="news-item-title" target="_blank">' . $item['title'] . '</a></p>';
                                echo '<p>' . wordlimit($item['description']) . '</p>';
                                echo '</li>';
                            }
                        } else {
                            echo '<p>'.$this->lang->line('dash_unreachable').'</p>';
                        }?>
                      </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- /colmd6 -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <i class="fa fa-long-arrow-right fa-fw"></i>
                    <?php echo $this->lang->line('dash_recent'); ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                    <?php 
                    foreach ($recenltyUpdated as $p) {
                        echo '<li class="list-group-item"><span class="badge">'.date("jS", strtotime($p["pageUpdated"])).' '.date("M", strtotime($p["pageUpdated"])).'</span>';
                            echo '<p><a href="'.BASE_URL.'/admin/pages/edit/'.$p['pageID'].'" class="news-item-title" target="_blank">'.$p['pageTitle'].'</a></p>';
                            echo '<p>'.wordlimit($p['pageContentHTML']).'</p>';
                        echo '</li>';
                    } ?>
                  </ul>
                </div>
            </div>
        </div>
        <!-- /colmd6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
<?php echo $footer; ?>