<?php foreach($all_product as $row){ 
	$main_title = $row['product_name'];
	$final_main_title = str_replace(' ', '-', strtolower($main_title));
	
	$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
	?>
	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
		<div class="listWrapper">
			<img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>" class="img-fluid">
			<h4 class="texture_name">
				<input class="product_textures" type="checkbox"> <label for="5943"><?php echo $row['product_name']; ?></label>
			</h4>
			<a href="<?php echo base_url(); ?>our_range/product_details/<?php echo $row['product_id']; ?>/<?php echo $final_main_title2; ?>"><img src="<?php echo base_url(); ?>uploads/images/arrow-right.png" class="ml-2 icn"></a>
			<a class="listingOverlay">
				<i class="fas fa-heart"></i>
			</a>
		</div>
	</div>
<?php } ?>
<input type="hidden" class="next_page" id="next_page_<?php echo @$next_page; ?>" value="<?php echo @$next_page; ?>">