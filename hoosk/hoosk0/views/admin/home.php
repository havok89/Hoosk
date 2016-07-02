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
                            echo '<p><a href="/admin/pages/edit/'.$p['pageID'].'" class="news-item-title" target="_blank">'.$p['pageTitle'].'</a></p>';
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