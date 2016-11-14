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
<div class="container content-padding">
    <?php echo $page['pageContentHTML']; ?>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>
