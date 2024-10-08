<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('about_us');?></h1>
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
								foreach($about_us_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin//manage_website/update_about_us/' . $row['aboutus_id'], array(
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
															<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 paddingleftzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('page_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="page_title" id="demo-hor-1" placeholder="<?php echo translate('page_title');?>" class="form-control " value="<?php echo $row['page_title']; ?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('page_title_bottom_text');?></label>
																	<div class="col-sm-12">
																		<textarea rows="9"  class="textarea" data-height="200" name="page_title_bottom_text" placeholder="content"><?php echo $row['page_title_bottom_text']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingrightzero">
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="demo-hor-2">
																		<?php echo translate('header_image');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_image');?>
																			<input type="file" name="header_image" id="header_image" accept="image">
																		</span>
																		<span id="about_image_wrap" class=" show_iin_image" style="width: 100%;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;">
																			<?php
																				if($row['header_image'] != ''){
																					if(file_exists('uploads/other_images/'.$row['header_image'])){
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['header_image']; ?>" width="100%" id="header_image_blah" />  
																				<?php
																					} else {
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="header_image_blah" />
																				<?php
																					}
																				}else{?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="header_image_blah" />
																				<?php }
																			?> 
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero" style="display:none;">
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('achivement_show_/_hide');?></label>
																<div class="col-sm-12">
																	<select name="show_achivement" class="demo-chosen-select" data-placeholder="Choose a option" id="show_achivement">
																	<option value="">Choose one</option>
																		<option value="yes" <?php if($row['show_achivement'] == 'yes'){ echo 'selected'; } ?> >Yes</option>
																		<option value="no" <?php if($row['show_achivement'] == 'no'){ echo 'selected'; } ?>>No</option>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero" >
															<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 paddingleftzero">
																<div class="form-group mainpagetext1">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('team_title');?></label>
																	<div class="col-sm-12">
																	<input type="text" name="content" id="content" placeholder="<?php echo translate('team_title');?>" class="form-control " value="<?php echo $row['content']; ?>">
																		
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddingrightzero" style="display:none;">
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="demo-hor-2">
																		<?php echo translate('image');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_image');?>
																			<input type="file" name="about_image" id="about_image" accept="image">
																		</span>
																		<span id="about_image_wrap" class=" show_iin_image" style="width: 100%;float:right; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;">
																			<?php
																				if($row['about_image'] != ''){
																					if(file_exists('uploads/other_images/'.$row['about_image'])){
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['about_image']; ?>" width="100%" id="about_image_blah" />  
																				<?php
																					} else {
																				?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="about_image_blah" />
																				<?php
																					}
																				}else{?>
																					<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="about_image_blah" />
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
	function header_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#header_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#header_image").change(function() {
		header_image(this);
	});
	function about_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#about_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#about_image").change(function() {
		about_image(this);
	});
    $(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>