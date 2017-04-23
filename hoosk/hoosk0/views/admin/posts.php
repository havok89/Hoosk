<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header">
                <?php echo $this->lang->line('posts_header'); ?>
            </h1>
		</div>
         <div class="col-lg-4">
        	<div class="input-group searchContainer">
			  <input type="text" class="form-control" id="searchString">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button" id="searchBtn" onClick="doPostSearch();"><span class="fa fa-search"></span></button>
			  </span>
			</div><!-- /input-group -->
        </div>
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-newspaper-o"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/posts"><?php echo $this->lang->line('nav_posts_all'); ?></a>
                </li>
            </ol>
        </div>
        
    </div>
</div>

    <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
			<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                        <th> <?php echo $this->lang->line('posts_table_post'); ?> </th>
                        <th> <?php echo $this->lang->line('posts_table_category'); ?> </th>
                        <th> <?php echo $this->lang->line('posts_table_posted'); ?> </th>
                        <th> <?php echo $this->lang->line('posts_table_published'); ?> </th>
                        <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody id="postContainer">
                    <?php 
					foreach ($posts as $p) {
						echo '<tr>';
							echo '<td>'.$p['postTitle'].'</td>';
							echo '<td>'.$p['categoryTitle'].'</td>';
							echo '<td>'.$p['datePosted'].'</td>';
                            echo '<td>'.($p['published'] ? '<span class="fa fa-2x fa-check-circle"></span>' : '<span class="fa fa-2x fa-times-circle"></span>').'</td>';
							echo '<td class="td-actions"><a href="'.BASE_URL.'/admin/posts/edit/'.$p['postID'].'" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a> <a data-toggle="modal" data-target="#ajaxModal" class="btn btn-danger btn-small" href="'.BASE_URL.'/admin/posts/delete/'.$p['postID'].'"><i class="fa fa-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <div class="text-center" id="loadingSpinner">
              	<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
              </div>
              <div id="paginationContainer">
				  <?php echo $this->pagination->create_links(); ?>
			  </div>
            </div>
          </div>
         
     </div>

<?php echo $footer; ?>