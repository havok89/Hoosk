<?php echo $header; ?>
<!-- JUMBOTRON
=================================-->

<div class="jumbotron text-center">
	<?php if ($page['enableSlider'] == 1) { ?>
    <div id="carousel" class="carousel slide " data-ride="carousel">
        <?php getCarousel($page['pageID']); ?>
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <?php } ?>
		<?php if ($page['enableJumbotron'] == 1) { ?>
	    <div class="container content-padding">
	      <div class="row">
					<div class="col-md-12">
						<?php echo $page['jumbotronHTML']; ?>
					</div>
        </div>
      </div>
		<?php } ?>
</div>
<!-- /JUMBOTRON container-->
<!-- CONTENT
=================================-->
<?php $totSegments = $this->uri->total_segments();
		if(!is_numeric($this->uri->segment($totSegments))){
		$offset = 0;
		} else if(is_numeric($this->uri->segment($totSegments))){
		$offset = $this->uri->segment($totSegments);
		}
		$limit = 10;
?>
<div class="container content-padding">
    <?php echo $page['pageContentHTML']; ?>
    <div class="row">
    	<div class="col-md-3"><div class="row">
           <div class="col-md-12"><h3>Latest Articles:</h3><?php getLatestNewsSidebar(); ?></div>
           <div class="col-md-12"><h3>Categories:</h3><?php getCategories(); ?></div></div>
        </div>
        <div class="col-md-9">
			<div class="row">
			<div class="col-md-12"><?php getLatestNews($limit,$offset); ?></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php getPrevBtn($limit,$offset); ?>
                    <?php getNextBtn($limit,$offset); ?>
                </div>
            </div>
        	<div class="col-md-12 text-center"><p class="meta"><?php countPosts($limit,$offset); ?></p></div>
        </div>
    </div>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>
