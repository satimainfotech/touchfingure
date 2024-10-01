<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('our_range_add');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/our_range<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/our_range<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							echo form_open(base_url() . 'admin/our_range/our_range_added/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'our_range_add',
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
															<input type="text" name="our_range_name" id="demo-hor-1" placeholder="<?php echo translate('our_range_name');?>" class="form-control required">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('brand');?></label>
														<div class="col-sm-12">
															<select id="brand" name="brand" placeholder="Select a brand" class="demo-chosen-select required" onchange="select_category(this.value);">
																<option value="">Select a brand</option>
																<?php foreach($brand_data as $row) { ?>
																	<option value="<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></option>
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
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="our_range_main_image_blah" />
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
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="our_range_image_1_blah" />
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
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="our_range_image_2_blah" />
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
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="our_range_image_3_blah" />
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-13"><?php echo translate('content'); ?></label>
														<div class="col-sm-12">
															<textarea rows="9"  class="editertextarea textarea" data-height="200" name="our_range_content"></textarea>
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('our_range_add','<?php echo translate('our_range_has_been_added!'); ?>');" ><?php echo translate('upload');?></span>
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
	function our_range_main_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#our_range_main_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
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
	
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $(document).ready(function() {
        set_select();
	});

    function other(){
	    set_select();
        $('#sub').show('slow');
    }
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	function select_category(category_id){
		if(category_id == ''){
			
		}else{
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'our_range/get_sub_category',
				type: 'POST',
				dataType: 'html',
				data: {category_id:category_id},
				success: function(data){
					if(data != ''){
						$('#sub_cat').html(data);
					}
				}
			});
		}
	}
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	
	function open_new_option(){
		var added_row_id = $('#added_new_option_id').val();
		var added_total_new_option = $('#added_total_new_option').val();
		var new_row_id = parseInt(added_total_new_option)+1;
		$('#new_option').append("<div class='col-sm-12 paddingzeroall pb-5' id='option"+new_row_id+"' style='float: left;width: 100%;'><input type='hidden' id='new_option_new_ids' value='"+new_row_id+"'><div class='col-sm-5 col-xs-5 paddingonlyfive'><label class='var_label'><?php echo translate('option_name');?></label><input type='text' name='option_name_"+new_row_id+"' id='demo-hor-1' placeholder='<?php echo translate('option_name');?>' class='form-control'></div><div class='col-sm-5 col-xs-5 paddingonlyfive'><label class='var_label'><?php echo translate('option_value');?></label><input type='text' name='option_value_"+new_row_id+"' id='demo-hor-1' placeholder='<?php echo translate('option_value');?>' class='form-control'></div><div class='col-sm-2 col-xs-4'><span class='remove_button' onclick='remove_new_option("+new_row_id+");'><i class='fa fa-minus'></i></span></div></div>");
		set_select();
		$('#added_total_new_option').val(new_row_id);
		$('.textarea'+new_row_id).wysihtml5();
		var selected = new Array();
		$('#new_option #new_option_new_ids').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_id').val(selected.join(','));
	}
	
	function remove_new_option(remove_id){
		var added_new_option_id = $('#option'+remove_id).remove();
		var selected = new Array();
		$('#new_option #new_option_new_ids').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_id').val(selected.join(','));
	}
	
	function open_new_options(){
		var added_row_id = $('#added_new_option_ids').val();
		var added_total_new_option = $('#added_total_new_options').val();
		var new_row_id = parseInt(added_total_new_option)+1;
		$('#new_options').append("<div class='col-sm-12 paddingzeroall pb-5' id='options"+new_row_id+"' style='float: left;width: 100%;'><input type='hidden' id='new_option_new_idss' value='"+new_row_id+"'><div class='col-sm-5 col-xs-5 paddingonlyfive'><label class='var_label'><?php echo translate('title');?></label><input type='text' name='title_"+new_row_id+"' id='demo-hor-1' placeholder='<?php echo translate('title');?>' class='form-control'></div><div class='col-sm-5 col-xs-5 paddingonlyfive'><label class='var_label' for='demo-hor-12'><?php echo translate('images');?></label><div class='col-sm-12 paddingzeroall'><span class='pull-left btn btn-default btn-file'> <?php echo translate('choose_file');?><input type='file' name='images"+new_row_id+"' accept='image' id='images"+new_row_id+"' class='form-control' onchange='select_image(this,"+new_row_id+")'></span><span style='width: 32px;float:left; border:1px solid #ddd;border-radius:2px; padding:2px;margin-left:10px;' id='images_wrap"+new_row_id+"'><img src='<?php echo base_url(); ?>uploads/other_images/default.png' width='100%' id='images_blah"+new_row_id+"' /></span></div></div><div class='col-sm-2 col-xs-4'><span class='remove_button' onclick='remove_new_options("+new_row_id+");'><i class='fa fa-minus'></i></span></div></div>");
		$('#added_total_new_options').val(new_row_id);
		var selected = new Array();
		$('#new_options #new_option_new_idss').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_ids').val(selected.join(','));
	}
	
	function remove_new_options(remove_id){
		var added_new_option_id = $('#options'+remove_id).remove();
		var selected = new Array();
		$('#new_options #new_option_new_idss').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_ids').val(selected.join(','));
	}
</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>