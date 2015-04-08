<?php echo $header; ?>
<!-- JUMBOTRON 
=================================-->

<div class="jumbotron text-center <?php if ($page['enableJumbotron'] == 1) { echo "jumbo-padding"; } ?>">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
			<?php if ($page['enableJumbotron'] == 1) { echo $page['jumbotronHTML']; } ?>        
        </div>
      </div>
    </div> 
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
<div class="container">
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
  	<hr>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>