<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('our_range_edit');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/our_range<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin/our_range<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							foreach($our_range_data as $row){	
						?>
						<?php
							echo form_open(base_url() . 'admin/our_range/our_range_update/' . $row['our_range_id'], array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'our_range_edit',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="our_range_details" class="tab-pane fade active in">
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('our_range_name');?></label>
														<div class="col-sm-12">
															<input type="text" name="our_range_name" id="demo-hor-1" placeholder="<?php echo translate('our_range_name');?>" class="form-control required" value="<?php echo $row['our_range_name']; ?>">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('brand');?></label>
														<div class="col-sm-12">
															<select id="brand" name="brand" placeholder="Select a brand" class="demo-chosen-select required" onchange="select_category(this.value);">
																<option value="">Select a brand</option>
																<?php foreach($brand_data as $row1) { ?>
																	<option value="<?php echo $row1['brand_id']; ?>"><?php echo $row1['brand_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<div class="col-sm-3 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('our_range_main_image');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="our_range_main_image" accept="image" id="our_range_main_image" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="our_range_main_image_wrap">
																	<?php
																		if($row['our_range_main_image'] != ''){
																			if(file_exists('uploads/our_range_image/'.$row['our_range_main_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_main_image']; ?>" width="100%" id="our_range_main_image_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_main_image_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_main_image_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														<div class="col-sm-3 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('images_1');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="our_range_image_1" accept="image" id="our_range_image_1" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="our_range_image_1_wrap">
																	<?php
																		if($row['our_range_image_1'] != ''){
																			if(file_exists('uploads/our_range_image/'.$row['our_range_image_1'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_image_1']; ?>" width="100%" id="our_range_image_1_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_image_1_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_image_1_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														<div class="col-sm-3 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('images_2');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="our_range_image_2" accept="image" id="our_range_image_2" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="our_range_image_2_wrap">
																	<?php
																		if($row['our_range_image_2'] != ''){
																			if(file_exists('uploads/our_range_image/'.$row['our_range_image_2'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_image_2']; ?>" width="100%" id="our_range_image_2_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_image_2_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_image_2_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														<div class="col-sm-3 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('image_3');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="our_range_image_3" accept="image" id="our_range_image_3" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="our_range_image_3_wrap">
																	<?php
																		if($row['our_range_image_3'] != ''){
																			if(file_exists('uploads/our_range_image/'.$row['our_range_image_3'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_image_3']; ?>" width="100%" id="our_range_image_3_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_image_3_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/our_range_image/default.png" width="100%" id="our_range_image_3_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-13"><?php echo translate('content'); ?></label>
														<div class="col-sm-12">
															<textarea rows="9"  class="editertextarea textarea" data-height="200" name="our_range_content"><?php echo $row['our_range_content']; ?></textarea>
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('our_range_edit','<?php echo translate('our_range_has_been_updated!'); ?>');" ><?php echo translate('upload');?></span>
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
	var module = 'our_range/our_ranges';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	var extra = '';
	
    function other_forms(){}
	var selected_brand = '<?php echo @$our_range_data[0]["our_range_brand"]; ?>';
	$(document).ready(function() {
		set_select();
		if(selected_brand != ''){
			$("#brand").val(selected_brand).trigger("chosen:updated");
		}
		
    });
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	$("#our_range_main_image").change(function() {
		our_range_main_image(this);
	});
	function our_range_image_1(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#our_range_image_1_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#our_range_image_1").change(function() {
		our_range_image_1(this);
	});
	function our_range_image_2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#our_range_image_2_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#our_range_image_2").change(function() {
		our_range_image_2(this);
	});
	function our_range_image_3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#our_range_image_3_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#our_range_image_3").change(function() {
		our_range_image_3(this);
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
	
	function brand_logo_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#brand_logo_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#brand_logo_images").change(function() {
		brand_logo_images(this);
	});
</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>