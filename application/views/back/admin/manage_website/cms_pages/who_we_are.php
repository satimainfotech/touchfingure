<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('who_we_are');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//manage_website/cms_pages"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin//manage_website/cms_pages" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($who_we_are_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin//manage_website/update_who_we_are/' . $row['who_we_are_id'], array(
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
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('small_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="page_small_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $row['page_small_title']; ?>">
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingleftzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('main_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="page_main_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $row['page_main_title']; ?>">
																	</div>
																</div>
															</div>
														</div>
														<hr/>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 paddingleftzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="section_one_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $row['section_one_title']; ?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('content');?></label>
																	<div class="col-sm-12">
																		<textarea rows="9"  class="textarea" data-height="200" name="section_one_content" placeholder="content"><?php echo $row['section_one_content']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="demo-hor-2">
																		<?php echo translate('image');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_image');?>
																			<input type="file" name="who_we_are_image" id="who_we_are_image" accept="image">
																		</span>
																		<span id="who_we_are_image_wrap" class="show_iin_image" style="width: 100%;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;">
																			<?php
																				if($row['who_we_are_image'] != ''){
																					if(file_exists('uploads/other_images/'.$row['who_we_are_image'])){
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['who_we_are_image']; ?>" width="100%" id="who_we_are_image_blah" />  
																				<?php
																					} else {
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="who_we_are_image_blah" />
																				<?php
																					}
																				}else{?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="who_we_are_image_blah" />
																				<?php }
																			?> 
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<hr/>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="form-group">
																<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
																<div class="col-sm-12">
																	<input type="text" name="section_two_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $row['section_two_title']; ?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('content');?></label>
																<div class="col-sm-12">
																	<textarea rows="9"  class="textarea" data-height="200" name="section_two_content" placeholder="content"><?php echo $row['section_two_content']; ?></textarea>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('our_technolgy_item_show');?></label>
																<div class="col-sm-12">
																	<input type="number" min="6" name="our_technolgy_item_show" id="demo-hor-1" placeholder="<?php echo translate('item_show');?>" class="number form-control" value="<?php if($row['our_technolgy_item_show'] == ''){ echo '6'; }else{ echo $row['our_technolgy_item_show']; }  ?>">
																</div>
															</div>
														</div>
														<hr/>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2">
																	<?php echo translate('full_width_image');?>
																</label>
																<div class="col-sm-12">
																	<span class="pull-left btn btn-default btn-file">
																		<?php echo translate('select_full_width_image');?>
																		<input type="file" name="section_three_image" id="section_three_image" accept="image">
																	</span>
																	<span id="section_three_image_wrap" class="show_iin_image" style="width: 20%;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;">
																		<?php
																			if($row['section_three_image'] != ''){
																				if(file_exists('uploads/other_images/'.$row['section_three_image'])){
																			?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['section_three_image']; ?>" width="100%" id="section_three_image_blah" />  
																			<?php
																				} else {
																			?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="section_three_image_blah" />
																			<?php
																				}
																			}else{?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="section_three_image_blah" />
																			<?php }
																		?> 
																	</span>
																</div>
															</div>
														</div>
														<hr/>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 paddingleftzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('content_(HTML Format)');?></label>
																	<div class="col-sm-12">
																		<textarea rows="9"  class="textareas" style="height:350px" name="section_four_content" placeholder="content"><?php echo $row['section_four_content']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="demo-hor-2">
																		<?php echo translate('image');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_image');?>
																			<input type="file" name="section_four_image" id="section_four_image" accept="image">
																		</span>
																		<span id="section_four_image_wrap" class="show_iin_image" style="width: 100%;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;">
																			<?php
																				if($row['section_four_image'] != ''){
																					if(file_exists('uploads/other_images/'.$row['section_four_image'])){
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['section_four_image']; ?>" width="100%" id="section_four_image_blah" />  
																				<?php
																					} else {
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="section_four_image_blah" />
																				<?php
																					}
																				}else{?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="section_four_image_blah" />
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
	
	function who_we_are_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#who_we_are_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#who_we_are_image").change(function() {
		who_we_are_image(this);
	});
	
	function section_three_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#section_three_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#section_three_image").change(function() {
		section_three_image(this);
	});
	
	function section_four_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#section_four_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#section_four_image").change(function() {
		section_four_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>