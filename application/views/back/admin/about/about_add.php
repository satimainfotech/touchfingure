<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('add_new_about');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/about<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin/about/do_add/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'about_add',
									'enctype' => 'multipart/form-data'
								));
							?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview fulllabel">
									<div class="panel-body">
										<div class="tab-base">
											<div class="tab-content">
												<div id="vendor_details" class="tab-pane fade active in">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 responsivezero">
														<div class="form-group ">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('title');?></label>
															<div class="col-sm-12 responsivezero">
																<input type="text" name="about_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-2">
																<?php echo translate('about_image');?>
															</label>
															<div class="col-sm-12 responsivezero">
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_image');?>
																	<input type="file" name="about_image" id="about_image" accept="about_image">
																</span>
																<span id="profile_image_wrap" class=" show_iin_image" style="width: 460px;float:left;border:1px solid #ddd;border-radius:5px;padding:5px;margin-top: 5px;">
																	<img src="<?php echo base_url(); ?>uploads/about_image/default.jpg" width="100%" id='about_image_blah' />
																</span>
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
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " 
											onclick="page_reload(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('about_add','<?php echo translate('about_has_been_added!'); ?>','about');"><?php echo translate('submit');?></span>
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
</script>