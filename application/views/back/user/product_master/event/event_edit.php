<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('product_edit');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/product?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/event<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
						
							foreach($event_data as $row){	
						?>
						<?php
							echo form_open(base_url() . 'admin/event/event_update/' . $row['event_id'], array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'event_edit',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="product_details" class="tab-pane fade active in">
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('event_name');?></label>
														<div class="col-sm-12">
															<input type="text" name="event_name" id="demo-hor-1" placeholder="<?php echo translate('event_name');?>" class="form-control required" value="<?php echo $row['event_name']; ?>">
														</div>
													</div>
												</div>
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('event_time');?></label>
														<div class="col-sm-12">
															<input type="text" name="event_time" id="demo-hor-1" placeholder="10:00 AM - 2:00 PM" class="form-control required"  value="<?php echo $row['event_time']; ?>">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														
															<div class="col-sm-6 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('city');?></label>
															<div class="col-sm-12">
																<select id="city_id" name="city_id" placeholder="Select a city" class="demo-chosen-select required" >
																	<option value="">Select a Category</option>
																	<?php foreach($city_data as $city_row) { 
																	   
																	if( $city_row['city_id'] == $row['city_id'] ) { ?>
																		<option selected='selected' value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
																	<?php } else { ?>
																	<option  value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
																	<?php } } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
													<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('start_date');?></label>
														<div class="col-sm-12">
															<input type="date" name="start_date" id="demo-hor-1" placeholder="<?php echo translate('start_date');?>" value="<?php echo $row['start_date']; ?>" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('end_date');?></label>
														<div class="col-sm-12">
															<input type="date" name="end_date" id="demo-hor-1" placeholder="<?php echo translate('end_date');?>" value="<?php echo $row['end_date']; ?>" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('description');?></label>
														<div class="col-sm-12">
														<textarea rows="5" class="textarea form-control required" data-height="100" name="description" placeholder="description" > <?php echo $row['description']; ?></textarea>
															
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('address');?></label>
														<div class="col-sm-12">
														<textarea rows="5" class=" form-control required" data-height="100" name="address" placeholder="address" ><?php echo $row['address']; ?></textarea>
															
														</div>
													</div>
												</div>
											
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('event_main_images');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="event_main_images" accept="image" id="event_main_images" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="event_main_images_wrap">
																	<?php 
																		if($row['main_event_image'] != ''){
																			if(file_exists('uploads/event_main_images/'.$row['main_event_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/event_main_images/<?php echo $row['main_event_image']; ?>" width="100%" id="event_main_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/event_main_images/default.png" width="100%" id="event_main_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/event_main_images/default.png" width="100%" id="event_main_images_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('event_pass_images');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="event_pass" accept="image" id="event_pass" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="event_main_images_wrap">
																	<?php 
																		if($row['event_pass'] != ''){
																			if(file_exists('uploads/event_pass/'.$row['event_pass'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/event_pass/<?php echo $row['event_pass']; ?>" width="100%" id="event_pass_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/event_pass/default.png" width="100%" id="event_pass_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/event_pass/default.png" width="100%" id="event_pass_images_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														
													
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12 paddingzeroall">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " onclick="form_reset(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('event_edit','<?php echo translate('event_has_been_updated!'); ?>');" ><?php echo translate('upload');?></span>
									</div>
								</div>
							</div>
						</form>
						<?php } ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>    
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'product/products';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	var extra = '';
	
   
	

	
	/*$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});*/
	function event_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#event_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#event_main_images").change(function() {
		event_main_images(this);
	});
	
	function event_pass(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#event_pass_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#event_pass").change(function() {
		event_pass(this);
	});

	
</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>