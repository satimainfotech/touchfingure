<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('add_sliders');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/manage_website/sliders<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin/manage_website/sliders_do_add/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'sliders_add',
									'enctype' => 'multipart/form-data'
								));
							?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
									<div class="panel-body">
										<div class="tab-base">
											<div class="tab-content">
												<div id="vendor_details" class="tab-pane fade active in">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-2">
																<?php echo translate('slider_image');?>
															</label>
															<div class="col-sm-10">
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_slider_image');?>
																	<input type="file" name="slider_image" id='slider_image' accept="image">
																</span>
																<span id='slider_image_wrap' class=" show_iin_image" style="width: 200px;float:right; border:1px solid #ddd;border-radius:5px;padding:5px">
																	<img src="<?php echo base_url(); ?>uploads/slider_image/default.png" width="100%" id='slider_image_blah' />
																</span>
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('text_one');?></label>
																	<div class="col-12">
																		<input type="text" name="text_one" id="demo-hor-1" placeholder="<?php echo translate('text_one');?>" class="form-control">
																	</div>
																</div>
															</div>
															<!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('text_align');?></label>
																	<div class="col-sm-12">
																		<select name="text_one_text_align" class="demo-chosen-select" data-placeholder="Choose a Text Align" id="text_one_text_align">
																			<option value="">Choose one</option>
																			<option value="right" >Right</option>
																			<option value="left" >Left</option>
																			<option value="center" selected>Center</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('text color');?></label>
																	<div class="col-12">
																		<input type="color" name="text_one_color" id="demo-hor-1" placeholder="<?php echo translate('text color');?>" class="form-control">
																	</div>
																</div>
															</div> -->
														</div>
														<hr/>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('text_two');?></label>
																	<div class="col-12">
																		<input type="text" name="text_tow" id="demo-hor-1" placeholder="<?php echo translate('text_two');?>" class="form-control">
																	</div>
																</div>
															</div>
															<!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('text_align');?></label>
																	<div class="col-sm-12">
																		<select name="text_two_text_align" class="demo-chosen-select" data-placeholder="Choose a Text Align" id="text_two_text_align">
																			<option value="">Choose one</option>
																			<option value="right" >Right</option>
																			<option value="left" >Left</option>
																			<option value="center" selected>Center</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('text color');?></label>
																	<div class="col-12">
																		<input type="color" name="text_two_color" id="demo-hor-1" placeholder="<?php echo translate('text color');?>" class="form-control">
																	</div>
																</div>
															</div> -->
														</div>
														<!-- <hr/>
														 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddingallzero min-height-8px">
																<div class="form-group ">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('content');?></label>
																	<div class="col-sm-12 paddinglzero">
																		<textarea rows="9"  class="texteditertextarea" data-height="200" name="content"></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 min-height-8px paddinglzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('text_align');?></label>
																	<div class="col-sm-12 paddinglzero">
																		<select name="content_text_align" class="demo-chosen-select" data-placeholder="Choose a Text Align" id="content_text_align">
																			<option value="">Choose one</option>
																			<option value="right" >Right</option>
																			<option value="left" >Left</option>
																			<option value="center" selected>Center</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 min-height-8px">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('text color');?></label>
																	<div class="col-12">
																		<input type="color" name="content_color" id="demo-hor-1" placeholder="<?php echo translate('text color');?>" class="form-control">
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 paddinglzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('main_font_size');?></label>
																	<div class="col-12">
																		<input type="text" name="content_font_size" id="demo-hor-1" placeholder="<?php echo translate('main_font_size');?>" class="form-control">
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('font_size_min_360px');?></label>
																	<div class="col-12">
																		<input type="text" name="content_min_360px" id="demo-hor-1" placeholder="<?php echo translate('font_size_min_360px');?>" class="form-control">
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 paddinglzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('font_size_min_767px');?></label>
																	<div class="col-12">
																		<input type="text" name="content_min_767px" id="demo-hor-1" placeholder="<?php echo translate('font_size_min_767px');?>" class="form-control">
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
																<div class="form-group">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('font_size_min_992px');?></label>
																	<div class="col-12">
																		<input type="text" name="content_min_992px" id="demo-hor-1" placeholder="<?php echo translate('font_size_min_992px');?>" class="form-control">
																	</div>
																</div>
															</div>
														</div>
														<hr/>-->
														
														
														<!-- <div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('button_show_/_hide');?></label>
															<div class="col-sm-10">
																<select name="button_show_hide" class="demo-chosen-select" data-placeholder="Choose a Button show / hide" id="button_show_hide">
																	<option value="">Choose one</option>
																	<option value="yes" >Yes</option>
																	<option value="no" >No</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('text_align');?></label>
															<div class="col-sm-10 ">
																<select name="button_text_align" class="demo-chosen-select" data-placeholder="Choose a Text Align" id="button_text_align">
																	<option value="">Choose one</option>
																	<option value="right" >Right</option>
																	<option value="left" >Left</option>
																	<option value="center" selected>Center</option>
																</select>
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('button_title');?></label>
															<div class="col-sm-10">
																<input type="text" name="button_text" id="demo-hor-1" placeholder="<?php echo translate('button_title');?>" class="form-control">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('button_link');?></label>
															<div class="col-sm-10">
																<input type="text" name="button_link" id="demo-hor-1" placeholder="<?php echo translate('button_link');?>" class="form-control">
															</div>
														</div> -->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " 
											onclick="page_reload(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('sliders_add','<?php echo translate('sliders_has_been_added!'); ?>','manage_website/sliders');"><?php echo translate('submit');?></span>
									</div>
								</div>
							</form>
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
<script>
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function other(){
	    set_select();
    }
    $(document).ready(function() {
        set_select();
	});
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	
	function slider_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#slider_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#slider_image").change(function() {
		slider_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>