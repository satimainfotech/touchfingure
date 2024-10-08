<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('add_new_social_media');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//manage_website/social_media<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin//manage_website/social_media_do_add/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'social_media_add',
									'enctype' => 'multipart/form-data'
								));
							?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview fulllabel">
									<div class="panel-body">
										<div class="tab-base">
											<div class="tab-content">
												<div id="vendor_details" class="tab-pane fade active in">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
															<div class="col-sm-12">
																<input type="text" name="name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('link');?></label>
															<div class="col-sm-12">
																<input type="text" name="link" id="demo-hor-1" placeholder="<?php echo translate('link');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-2">
																<?php echo translate('image');?>
															</label>
															<div class="col-sm-12">
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_image');?>
																	<input type="file" name="social_icon" id="social_icon" accept="image">
																</span>
																<span id="social_media_wrap" class=" show_iin_image" style="width: 50px;float:right;
																border:1px solid #ddd;border-radius:5px;padding:5px">
																	<img src="<?php echo base_url(); ?>uploads/web_social_icon/default.png" width="100%" id='social_media_blah' />
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('social_media_add','<?php echo translate('social_media_has_been_added!'); ?>','/manage_website/social_media');"><?php echo translate('submit');?></span>
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
	
	function social_media(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#social_media_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#social_media").change(function() {
		social_media(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>