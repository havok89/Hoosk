<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('posts_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-newspaper-o"></i>
                	<a href="/admin/posts"><?php echo $this->lang->line('nav_posts_all'); ?></a>
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
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					foreach ($posts as $p) {
						echo '<tr>';
							echo '<td>'.$p['postTitle'].'</td>';
							echo '<td>'.$p['categoryTitle'].'</td>';
							echo '<td>'.$p['datePosted'].'</td>';
							echo '<td class="td-actions"><a href="/admin/posts/edit/'.$p['postID'].'" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a> <a data-toggle="modal" data-target="#ajaxModal" class="btn btn-danger btn-small" href="'.BASE_URL.'/admin/posts/delete/'.$p['postID'].'"><i class="fa fa-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>

            </div>
          </div>
         
     </div>

<?php echo $footer; ?>