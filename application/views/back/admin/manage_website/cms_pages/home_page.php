<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('home_page');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/manage_website/cms_pages"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin/manage_website/cms_pages" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($home_page_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/manage_website/update_home_page/' . $row['home_page_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'form_edits',
										'enctype' => 'multipart/form-data'
									));
								?>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview fulllabel">
										<div class="panel-body">
											<div class="tab-base">
												 <div class="tab-content">
													<div id="vendor_details" class="tab-pane fade active in">
														<h4 class="pagetitless">Main Slider Section</h4>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftzero">
																<div class="form-group ">
																	<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('main_banner_show_/_hide');?></label>
																	<div class="col-sm-12">
																		<select name="main_slider_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="main_slider_show_hide">
																		<option value="">Choose one</option>
																			<option value="yes" <?php if($row['main_slider_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																			<option value="no" <?php if($row['main_slider_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftzero">
																<div class="form-group ">
																	<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('header_social_media_show_/_hide');?></label>
																	<div class="col-sm-12">
																		<select name="header_social_media_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="header_social_media_show_hide">
																		<option value="">Choose one</option>
																			<option value="yes" <?php if($row['header_social_media_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																			<option value="no" <?php if($row['header_social_media_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="demo-hor-2">
																		<?php echo translate('tag_line_image');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_tag_line_image');?>
																			<input type="file" name="tag_line_image" id="tag_line_image" accept="image">
																		</span>
																		<span id="tag_line_image_wrap" class=" show_iin_image" style="width: 150px;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:0px;">
																			<?php
																				if($row['tag_line_image'] != ''){
																					if(file_exists('uploads/other_images/'.$row['tag_line_image'])){
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['tag_line_image']; ?>" width="100%" id="tag_line_image_blah" />  
																				<?php
																					} else {
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="tag_line_image_blah" />
																				<?php
																					}
																				}else{?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="tag_line_image_blah" />
																				<?php }
																			?> 
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<hr/>
														<h4 class="pagetitless">About Us Section</h4>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 paddingleftzero">
																<div class="form-group ">
																	<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('about_us_show_/_hide');?></label>
																	<div class="col-sm-12">
																		<select name="about_us_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="about_us_show_hide">
																		<option value="">Choose one</option>
																			<option value="yes" <?php if($row['about_us_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																			<option value="no" <?php if($row['about_us_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="about_us_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $row['about_us_title']; ?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('content');?></label>
																	<div class="col-sm-12">
																		<textarea rows="9"  class="textarea" data-height="200" name="about_us_content" placeholder="content"><?php echo $row['about_us_content']; ?></textarea>
																	</div>
																</div>
																
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingrightzero">
																<div class="form-group ">
																	<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('more_details_show_/_hide');?></label>
																	<div class="col-sm-12">
																		<select name="moredetails_button_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="moredetails_button_show_hide">
																		<option value="">Choose one</option>
																			<option value="yes" <?php if($row['moredetails_button_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																			<option value="no" <?php if($row['moredetails_button_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="demo-hor-2">
																		<?php echo translate('about_us_image');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_about_us_image');?>
																			<input type="file" name="about_us_image" id="about_us_image" accept="image">
																		</span>
																		<span id="about_us_image_wrap" class="show_iin_image" style="width: 100%;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;">
																			<?php
																				if($row['about_us_image'] != ''){
																					if(file_exists('uploads/other_images/'.$row['about_us_image'])){
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['about_us_image']; ?>" width="100%" id="about_us_image_blah" />  
																				<?php
																					} else {
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="about_us_image_blah" />
																				<?php
																					}
																				}else{?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="about_us_image_blah" />
																				<?php }
																			?> 
																		</span>
																	</div>
																</div>
															</div>
														</div>
														
														<h4 class="pagetitless" style="display:none;">Second Slider Section</h4>
														<div style="display:none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('second_slider_show_/_hide');?></label>
																<div class="col-sm-12">
																	<select name="second_slider_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="second_slider_show_hide">
																	<option value="">Choose one</option>
																		<option value="yes" <?php if($row['second_slider_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																		<option value="no" <?php if($row['second_slider_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2">
																	<?php echo translate('second_slider_bottom_image');?>
																</label>
																<div class="col-sm-12">
																	<span class="pull-left btn btn-default btn-file">
																		<?php echo translate('select_about_us_image');?>
																		<input type="file" name="second_slider_bottom_image" id="second_slider_bottom_image" accept="image">
																	</span>
																	<span id="about_us_image_wrap" class=" show_iin_image" style="width: 50px;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-left:10px;">
																		<?php
																			if($row['second_slider_bottom_image'] != ''){
																				if(file_exists('uploads/other_images/'.$row['second_slider_bottom_image'])){
																			?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['second_slider_bottom_image']; ?>" width="100%" id="second_slider_bottom_image_blah" />  
																			<?php
																				} else {
																			?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="second_slider_bottom_image_blah" />
																			<?php
																				}
																			}else{?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="second_slider_bottom_image_blah" />
																			<?php }
																		?> 
																	</span>
																</div>
															</div>
														</div>
														
														<h4 style="display:none;" class="pagetitless">Our Brand Portfolio Section</h4>
														<div style="display:none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingleftzero">
																<div class="form-group ">
																	<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('our_brand_section_show_/_hide');?></label>
																	<div class="col-sm-12">
																		<select name="our_brand_section_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="our_brand_section_show_hide">
																		<option value="">Choose one</option>
																			<option value="yes" <?php if($row['our_brand_section_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																			<option value="no" <?php if($row['our_brand_section_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('item_show');?></label>
																	<div class="col-sm-12">
																		<input type="number" min="6" name="our_brand_show_item" id="demo-hor-1" placeholder="<?php echo translate('item_show');?>" class="number form-control" value="<?php if($row['our_brand_show_item'] == ''){ echo '6'; }else{ echo $row['our_brand_show_item']; }  ?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('first_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="our_brand_first_title" id="demo-hor-1" placeholder="<?php echo translate('first_title');?>" class="form-control" value="<?php echo $row['our_brand_first_title']; ?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('second_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="our_brand_second_title" id="demo-hor-1" placeholder="<?php echo translate('second_title');?>" class="form-control" value="<?php echo $row['our_brand_second_title']; ?>">
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('content');?></label>
																<div class="col-sm-12">
																	<textarea rows="9"  class="textarea" data-height="200" name="our_brand_content" placeholder="content"><?php echo $row['our_brand_content']; ?></textarea>
																</div>
															</div>
														</div>
														
														<h4 style="display:none;" class="pagetitless">Our Technology Section</h4>
														<div style="display:none;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingleftzero">
																<div class="form-group ">
																	<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('our_technolgy_show_/_hide');?></label>
																	<div class="col-sm-12">
																		<select name="our_technolgy_show_hide" class="demo-chosen-select" data-placeholder="Choose a option" id="our_technolgy_show_hide">
																		<option value="">Choose one</option>
																			<option value="yes" <?php if($row['our_technolgy_show_hide'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																			<option value="no" <?php if($row['our_technolgy_show_hide'] == 'no'){ echo 'selected'; } ?>>No</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('item_show');?></label>
																	<div class="col-sm-12">
																		<input type="number" min="6" name="our_technolgy_show_item" id="demo-hor-1" placeholder="<?php echo translate('item_show');?>" class="number form-control" value="<?php if($row['our_technolgy_show_item'] == ''){ echo '6'; }else{ echo $row['our_technolgy_show_item']; }  ?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('first_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="our_technolgy_first_title" id="demo-hor-1" placeholder="<?php echo translate('first_title');?>" class="form-control" value="<?php echo $row['our_technolgy_first_title']; ?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('second_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="our_technolgy_second_title" id="demo-hor-1" placeholder="<?php echo translate('second_title');?>" class="form-control" value="<?php echo $row['our_technolgy_second_title']; ?>">
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('content');?></label>
																<div class="col-sm-12">
																	<textarea rows="9"  class="textarea" data-height="200" name="our_technolgy_content" placeholder="content"><?php echo $row['our_technolgy_content']; ?></textarea>
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
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('successfully_edited!'); ?>');"><?php echo translate('update');?></span> 
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
</div>
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script type="text/javascript">
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
  
    $(document).ready(function() {
        set_select();
    });
	
	function tag_line_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#tag_line_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#tag_line_image").change(function() {
		tag_line_image(this);
	});
	
	function about_us_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#about_us_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#about_us_image").change(function() {
		about_us_image(this);
	});
	function second_slider_bottom_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#second_slider_bottom_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>