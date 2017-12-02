<?php foreach ($latest_articles as $row) { ?>
<div class="col-sm-6"> 
<div class="ipost BorderJ clearfix">
	<div class="col_one_fourth bottommargin-sm">
		<div class="entry-image">
			<a href="#"><img class="image_fade" src="<?php echo base_url(); ?>wp-content/uploads/<?php echo $row['journal_image'];  ?>" alt="Image"></a>
		</div>
	</div>
	<div class="col_three_fourth bottommargin-sm col_last">
		<div class="entry-title">
			<h3><a href="#"> <?php echo $row['journal_name']; ?> </a></h3>
		</div> 
		<div class="entry-content">
			<p> <?php echo $row['journal_description'] ?> </p>
			
			<div style="padding-top:20px;">
			<a href="#" class="button button-rounded button-reveal button-large button-border tright"><i class="icon-angle-right"> </i><span> Home  Page </span></a> </div>
			 
		</div>
	</div>
</div> 
</div>
<?php } ?>