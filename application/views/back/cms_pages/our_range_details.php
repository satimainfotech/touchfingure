<style>
.redTitle h1 {
    color: #000;
    text-transform: uppercase;
    font-family: "montserratregular";
    font-size: 1.5rem;
}
</style>
<!-- product section -->
<?php foreach($product_data as $row){ ?>
	<section class="pt-5">
		<div class="container">
			<div class="row py-lg-5">
				<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
					
					<div class="product-details-tab">
						<div class="leftimg">
							<img id="zoom_01" src='<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>' data-zoom-image="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>" class="vimg" />
							<a class="rotateImg">
								<i class="fas fa-search"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
					<!-- product -->
					<div class="row desktopView">
						<div class="col-md-6 col-sm-6 col-6 ">
							<div class="prdct-img">
								<h4><a href="#" class="product-title"><?php echo $row['product_name']; ?></a></h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-6">
							<div class="prdct-img text-right">
								<img src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['brand_image']; ?>">
							</div>
						</div>
					</div>
					<div class="row py-2">
						<div class="col-md-12">
							<table class="table table-striped mt-4 custom-tbl">
								<tbody>
									<?php if($row['product_details'] != ''){ ?>
									<?php
										$decode_data = json_decode($row['product_details'],true);
										$total_row = array();
										for($j=1; $j<=count($decode_data); $j++){ 
											$total_row[] = $j;
										} 
										
										$final_total_row = implode(",",$total_row);
									?>
										<?php foreach($decode_data as $rows){ ?>
											<tr>
												<td><span><?php echo $rows['option_name'];?></span></td>
												<td><span><?php echo $rows['option_value']?></span></td>
											</tr>
										<?php }?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 ">
							<img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['second_product_image']; ?>" class="img-fluid imgRight">
						</div>
					</div>

				</div>
			</div>
			<?php if($row['product_options'] != ''){ ?>
			<?php
				$decode_datas = json_decode($row['product_options'],true);
				//echo "<pre>"; print_r($decode_datas);
				$total_rows = array();
				for($js=1; $js<=count($decode_datas); $js++){ 
					$total_rows[] = $js;
				} 
				
				$final_total_rows = implode(",",$total_rows);
				if(!empty($decode_datas)){
			?>
			<div class="row pb-2 pt-sm-0 pt-4">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="prdct-img">
						<h4><a href="#" class="product-title">Select Your Texture</a></h4>
					</div>
				</div>
			</div>
			<!-- texture -->
			 <div class="row pb-0 pb-sm-5 pt-sm-5 pt-lg-0 pt-0">
				<?php foreach($decode_datas as $rowss){ 
				$title = $rowss['title'];
				$final_title = str_replace(' ', '-', strtolower($title));
				?>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
						<div class="texture-img-block">
							<label><div id="texture-4786" class="zoomWrapper single-zoom"><img class="imagezoomeffect" id="txt-zoom4786" src="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>" data-zoom-image="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>" alt=""> </div>
							<h4 class="texture_name"><label><input class="product_textures" type="checkbox" id="s_<?php echo $final_title; ?>" onclick="set_in_list('<?php echo $final_title; ?>','<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>','<?php echo $rowss['title']; ?>','<?php echo $rowss['image']; ?>');"> <?php echo $rowss['title'];?></label></h4></label>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php } } ?>
			<!-- button -->
			<div class="row">
				<div class="col-md-12 text-center">
					<a class="btn btn btnRed mb-5 " data-toggle="modal" onclick="open_quick_product_modal_button();">
						Enquire Now
					</a>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="quick_product_modal_button">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title mdl-title"><?php echo $row['product_name']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
						<div id="msg_popup"></div>
                        <?php
							echo form_open(base_url() . 'our_range/submit_enquiry/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'enquiry_now',
								'enctype' => 'multipart/form-data'
							));
						?>
                            <div class="row">
								<input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
								<div class="form-group col-md-6">
                                    <label for="name">Your Name</label>
                                    <input type="text" class="form-control required" name="name" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control required" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control required" name="phone" placeholder="Phone">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cname">Company Name</label>
                                    <input type="text" class="form-control required" name="cname" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control required" name="city" placeholder="City">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="comment">Message</label>
                                    <textarea class="form-control required" rows="3" name="comment" placeholder="Message"></textarea>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-md-12 texture-blocks">
                                    <strong class="mt-4"><?php echo $row['product_name']; ?></strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
                                    <div>                                       
                                        <img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-6 d-flex  align-items-end">
                                    <table class="table table-striped  custom-tbl">
                                        <tbody>
											<?php if($row['product_details'] != ''){ ?>
											<?php
												$decode_data = json_decode($row['product_details'],true);
												$total_row = array();
												for($j=1; $j<=count($decode_data); $j++){ 
													$total_row[] = $j;
												} 
												
												$final_total_row = implode(",",$total_row);
											?>
												<?php foreach($decode_data as $rows){ ?>
													<tr>
														<td><span><?php echo $rows['option_name'];?></span></td>
														<td><span><?php echo $rows['option_value']?></span></td>
													</tr>
												<?php }?>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- product -->

                            <div class="row py-3">
                                <div class="col-md-12 texture-blocks">
                                    <strong class="mt-4">Selected Your Texture</strong>
                                </div>
                            </div>

                            <!-- texture -->
                            <div class="row" id="selected_items_box">
								<?php if($row['product_options'] != ''){ ?>
								<?php
									$decode_datas = json_decode($row['product_options'],true);
									//echo "<pre>"; print_r($decode_datas);
									$total_rows = array();
									for($js=1; $js<=count($decode_datas); $js++){ 
										$total_rows[] = $js;
									} 
									
									$final_total_rows = implode(",",$total_rows);
									if(!empty($decode_datas)){
								?>
									<?php foreach($decode_datas as $rowss){ 
									$title = $rowss['title'];
									$final_title = str_replace(' ', '-', strtolower($title));
									?>
										<div class="col-md-4" style="display:none" id="<?php echo $final_title;?>">
											<div class="texture-img-block">
												<img src="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>" data-zoom-image="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>" class="img-fluid">
												<h6 class="texture_name"><?php echo $rowss['title'];?></h6>
											</div>
										</div>
									<?php } ?>
								<?php } } ?>
                            </div>
							<div id="selected_item_list">
								
							</div>
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                    <span class="btn btnRed my-3 enterer" onclick="ajax_form_submit('enquiry_now','<?php echo translate('cricket_coupon_has_been_added!'); ?>','cricket_coupon');"><?php echo translate('submit');?></span>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
<script>
	function set_in_list(title,image,main_title,main_image){
		if($('#s_'+title).prop("checked") == true){
			$('#selected_item_list').append("<div id='pop_"+title+"'><input type='hidden' name='selected_texture[]' value='"+main_title+"$//$"+main_image+"'></div>");
			$('#'+title).show();
		}else if($('#s_'+title).prop("checked") == false){
			$('#'+title).hide();
			$('#pop_'+title).remove();
		}
	}
	function open_quick_product_modal_button(){
		$('#enquiry_now')[0].reset();
		$('#quick_product_modal_button').modal({ backdrop: 'static'});
	}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url('template/front/js/jquery.elevatezoom.js')?>"></script>