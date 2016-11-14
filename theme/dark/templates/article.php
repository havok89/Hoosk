<?php echo $header; ?>
<!-- CONTENT
=================================-->

<div class="container content-padding">
    <div class="row">
    	<div class="col-md-3"><div class="row">
           <div class="col-md-12"><h3>Latest Articles:</h3><?php getLatestNewsSidebar(); ?></div>
           <div class="col-md-12"><h3>Categories:</h3><?php getCategories(); ?></div></div>
        </div>
         <div class="col-md-9">
			<div class="row">
            <div class="col-md-12"><h2><?php echo $page['pageTitle']; ?></h2><p class="meta">Posted: <?php echo $page['datePosted']; ?>, in category <a href="<?php echo BASE_URL."/category/".$page['categorySlug']; ?>"><?php echo $page['categoryTitle']; ?></a></p></div>
			</div>
            <hr />
            <div class="row">
            <div class="col-md-12"><?php echo $page['postContent']; ?></div>
            </div>
            </div>
        </div>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>
