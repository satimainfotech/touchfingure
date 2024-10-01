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
			<input type="hidden" value="<?php echo base_url(); ?>admin/product<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							//echo "<pre>"; print_r($product_data); 
							foreach($product_data as $row){	
						?>
						<?php
							echo form_open(base_url() . 'admin/product/product_update/' . $row['product_id'], array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'product_edit',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="product_details" class="tab-pane fade active in">
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('product_name');?></label>
														<div class="col-sm-12">
															<input type="text" name="product_name" id="demo-hor-1" placeholder="<?php echo translate('product_name');?>" class="form-control required" value="<?php echo $row['product_name']; ?>">
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<div class="col-sm-6 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('category');?></label>
															<div class="col-sm-12">
																<select id="category" name="category_id" placeholder="Select a category" class="demo-chosen-select required" onchange="select_category(this.value);">
																	<option value="">Select a Category</option>
																	<?php foreach($category_data as $row1) { ?>
																		<option value="<?php echo $row1['category_id']; ?>"><?php echo $row1['category_name']; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-sm-6 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-3"><?php echo translate('sub-category');?></label>
															<div class="col-sm-12" id="sub_cat">
																<select id="sub_category" name="sub_category_id" placeholder="Select a Sub Category" class="demo-chosen-select">
																	<option value="">First select a Category</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('product_main_images');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="product_main_images" accept="image" id="product_main_images" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="product_main_images_wrap">
																	<?php
																		if($row['main_product_image'] != ''){
																			if(file_exists('uploads/product_image/'.$row['main_product_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>" width="100%" id="product_main_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/product_image/default.png" width="100%" id="product_main_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/product_image/default.png" width="100%" id="product_main_images_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('Product 3D image');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="product_second_images" accept="image" id="product_second_images" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="product_second_images_wrap">
																	<?php
																		if($row['second_product_image'] != ''){
																			if(file_exists('uploads/product_image/'.$row['second_product_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['second_product_image']; ?>" width="100%" id="product_second_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/product_image/3d_common_image.jpg" width="100%" id="product_second_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/product_image/3d_common_image.jpg" width="100%" id="product_second_images_blah" />
																		<?php }
																	?> 
																</span>
															</div>
														</div>
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<div class="form-group">
																<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('our_range');?></label>
																<div class="col-sm-12">
																	<select id="our_range" name="our_range" placeholder="Select a brand" class="demo-chosen-select required" >
																		<option value="">Select a Our range</option>
																		<?php foreach($our_range_data as $row2) { ?>
																			<option value="<?php echo $row2['our_range_id']; ?>"><?php echo $row2['our_range_name']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('brand');?></label>
																<div class="col-sm-12">
																	<select id="brand" name="brand" placeholder="Select a brand" class="demo-chosen-select required" >
																		<option value="">Select a Brand</option>
																		<?php foreach($brand_data as $row1) { ?>
																			<option value="<?php echo $row1['brand_id']; ?>"><?php echo $row1['brand_name']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<h6 class="setitle">Product details</h6>
														<div class="col-sm-6 col-xs-12 paddingzeroall">
															<?php if($row['product_details'] != ''){ ?>
															<?php
																$decode_data = json_decode($row['product_details'],true);
																$total_row = array();
																for($j=1; $j<=count($decode_data); $j++){ 
																	$total_row[] = $j;
																} 
																
																$final_total_row = implode(",",$total_row);
															?>
																<div class="form-group">
																	<input type="hidden" id="added_new_option_id" name="added_new_option_id" value="<?php echo $final_total_row; ?>">
																	<input type="hidden" id="added_total_new_option" name="added_total_new_option" value="<?php echo count($decode_data); ?>">
																</div>
																<div class="col-sm-12 paddingzeroall" id="new_option">
																	<?php $i = 1;
																	foreach($decode_data as $rows){?>
																		<div class="col-sm-12 paddingzeroall pb-5" id="option<?php echo $i; ?>" style="float: left;width: 100%;">
																			<input type="hidden" id="new_option_new_ids" value="<?php echo $i; ?>">
																			<div class="col-sm-5 col-xs-5 paddingonlyfive">
																				<label class="var_label"><?php echo translate('title');?></label>
																				<input type="text" name="option_name_<?php echo $i; ?>" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control readonlytext" value="<?php echo $rows['option_name']; ?>" readonly>
																			</div>
																			<div class="col-sm-5 col-xs-5 paddingonlyfive">
																				<label class="var_label"><?php echo translate('value');?></label>
																				<input type="text" name="option_value_<?php echo $i; ?>" id="demo-hor-1" placeholder="<?php echo translate('value');?>" class="form-control" value="<?php echo $rows['option_value']; ?>">
																			</div>
																		</div>
																	<?php $i++; } ?>
																</div>
															<?php } ?>
														</div>
														<div class="col-sm-6 col-xs-12 paddingzeroall">
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
																<div class="form-group">
																	<input type="hidden" id="added_new_option_ids" name="added_new_option_ids" value="<?php echo $final_total_rows; ?>">
																	<input type="hidden" id="added_total_new_options" name="added_total_new_options" value="<?php echo count($decode_datas); ?>">
																</div>
																<div class="col-sm-12 paddingzeroall" id="new_options">
																	<?php $is = 1;
																	foreach($decode_datas as $rowss){?>
																	<div class="col-sm-12 paddingzeroall pb-5" id="options<?php echo $is; ?>" style="float: left;width: 100%;">
																		<input type="hidden" id="new_option_new_idss" value="<?php echo $is; ?>">
																		<div class="col-sm-5 col-xs-5 paddingonlyfive">
																			<label class="var_label"><?php echo translate('title');?></label>
																			<input type="text" name="title_<?php echo $is; ?>" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $rowss['title']; ?>">
																		</div>
																		<div class="col-sm-5 col-xs-5 paddingonlyfive">
																			<label class="var_label" for="demo-hor-12"><?php echo translate('images');?></label>
																			<div class="col-sm-12 paddingzeroall">
																			<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																				<input type="hidden" name="m_images<?php echo $is; ?>" accept="image" id="m_images<?php echo $is; ?>" class="form-control" value="<?php echo $rowss['image']; ?>">
																				<input type="file" name="images<?php echo $is; ?>" accept="image" id="images<?php echo $is; ?>" class="form-control" onchange="select_image(this,'<?php echo $is; ?>')">
																				</span>
																				<span style="width: 32px;float:left; border:1px solid #ddd;border-radius:2px; padding:2px;margin-left:10px;" id="images_wrap<?php echo $is; ?>">
																					<?php
																					if($rowss['image'] != ''){
																						if(file_exists('uploads/product_op_image/'.$rowss['image'])){
																					?>
																						<img src="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>" width="100%" id="images_blah<?php echo $is; ?>" />  
																					<?php
																						} else {
																					?>
																						<img src="<?php echo base_url(); ?>uploads/product_op_image/default.png" width="100%" id="images_blah<?php echo $is; ?>" />
																					<?php
																						}
																					}else{?>
																						<img src="<?php echo base_url(); ?>uploads/product_op_image/default.png" width="100%" id="images_blah<?php echo $is; ?>" />
																					<?php }
																				?> 
																				</span>
																			</div>
																		</div>
																		<div class="col-sm-2 col-xs-4">
																			<?php if($is == '1'){ ?>
																				<span class="add_new_button" onclick="open_new_options();"><i class="fa fa-plus"></i></span>
																			<?php }else{ ?>
																				<span class='remove_button' onclick='remove_new_options("<?php echo $is; ?>");'><i class="fa fa-minus"></i></span>
																			<?php } ?>
																		</div>	
																	</div>
																	<?php $is++; } ?>
																</div>
																<?php  }else{ ?>
																	<div class="form-group">
																		<input type="hidden" id="added_new_option_ids" name="added_new_option_ids" value="1">
																		<input type="hidden" id="added_total_new_options" name="added_total_new_options" value="1">
																	</div>
																	<div class="col-sm-12 paddingzeroall" id="new_options">
																		<div class="col-sm-12 paddingzeroall pb-5" id="options1" style="float: left;width: 100%;">
																			<input type="hidden" id="new_option_new_idss" value="1">
																			<div class="col-sm-5 col-xs-5 paddingonlyfive">
																				<label class="var_label"><?php echo translate('title');?></label>
																				<input type="text" name="title_1" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control">
																			</div>
																			<div class="col-sm-5 col-xs-5 paddingonlyfive">
																				<label class="var_label" for="demo-hor-12"><?php echo translate('images');?></label>
																				<div class="col-sm-12 paddingzeroall">
																				<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																					<input type="file" name="images1" accept="image" id="images1" class="form-control" onchange="select_image(this,'1')">
																					</span>
																					<span style="width: 32px;float:left; border:1px solid #ddd;border-radius:2px; padding:2px;margin-left:10px;" id="images_wrap1">
																						<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="images_blah1" />
																					</span>
																				</div>
																			</div>
																			<div class="col-sm-2 col-xs-4">
																				<span class="add_new_button" onclick="open_new_options();"><i class="fa fa-plus"></i></span>
																			</div>	
																		</div>
																	</div>
																<?php } ?>
															<?php } ?>
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('product_edit','<?php echo translate('product_has_been_updated!'); ?>');" ><?php echo translate('upload');?></span>
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
	
	
    function other_forms(){}
	var selected_category_id = '<?php echo @$product_data[0]["category_id"]; ?>';
	var selected_sub_category_id = '<?php echo @$product_data[0]["sub_category_id"]; ?>';
	var selected_brand_logo = '<?php echo @$product_data[0]["brand_logo"]; ?>';
	var selected_our_range = '<?php echo @$product_data[0]["our_range"]; ?>';
	$(document).ready(function() {
		set_select();
		if(selected_category_id != ''){
			select_category(selected_category_id);
			$("#category").val(selected_category_id).trigger("chosen:updated");
		}
		if(selected_brand_logo != ''){
			$("#brand").val(selected_brand_logo).trigger("chosen:updated");
		}
		if(selected_our_range){
			$("#our_range").val(selected_our_range).trigger("chosen:updated");
		}
    });
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	
	function select_category(category_id){
		if(category_id == ''){
			
		}else{
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'product/get_sub_category',
				type: 'POST',
				dataType: 'html',
				data: {category_id:category_id},
				success: function(data){
					if(data != ''){
						$('#sub_cat').html(data);
						if(selected_sub_category_id != ''){
							$("#sub_category").val(selected_sub_category_id).trigger("chosen:updated");
						}
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
	function product_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#product_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#product_main_images").change(function() {
		product_main_images(this);
	});
	function product_second_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#product_second_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#product_second_images").change(function() {
		product_second_images(this);
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