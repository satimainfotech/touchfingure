<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('event_add');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$event_name != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/event?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$event_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/event?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$event_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/event<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
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
							echo form_open(base_url() . 'admin/event/event_added/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'product_add',
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
															<input type="text" name="event_name" id="demo-hor-1" placeholder="<?php echo translate('event_name');?>" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('event_time');?></label>
														<div class="col-sm-12">
															<input type="text" name="event_time" id="demo-hor-1" placeholder="10:00 AM - 2:00 PM" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
													
														<div class="col-sm-6 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('City');?></label>
															<div class="col-sm-12">
																<select id="city_id" name="city_id" placeholder="Select a City" class="demo-chosen-select required">
																	<option value="">Select a City</option>
																	<?php foreach($city_data as $city_row) { ?>
																		<option value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('start_date');?></label>
														<div class="col-sm-12">
															<input type="date" name="start_date" id="demo-hor-1" placeholder="<?php echo translate('start_date');?>" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('end_date');?></label>
														<div class="col-sm-12">
															<input type="date" name="end_date" id="demo-hor-1" placeholder="<?php echo translate('end_date');?>" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('description');?></label>
														<div class="col-sm-12">
														<textarea rows="5" class="textarea form-control required" data-height="100" name="description" placeholder="description" ></textarea>
															
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('address');?></label>
														<div class="col-sm-12">
														<textarea rows="5" class=" form-control required" data-height="100" name="address" placeholder="address" ></textarea>
															
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
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="event_main_images_blah" />
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
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="event_pass_images_blah" />
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
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12 paddingzeroall">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " onclick="form_reset(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('product_add','<?php echo translate('event_has_been_added!'); ?>');" ><?php echo translate('upload');?></span>
									</div>
								</div>
							</div>
						</form>
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
	
	
	
	function select_image(input,op) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#images_blah'+op).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	

	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $(document).ready(function() {
        set_select();
	});

  
	
	

</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>