<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('add_our_network');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/manage_website/our_network<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin/manage_website/our_network_do_add/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'our_network_add',
									'enctype' => 'multipart/form-data'
								));
							?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
									<div class="panel-body">
										<div class="tab-base">
											<div class="tab-content">
												<div id="vendor_details" class="tab-pane fade active in">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('state_name');?></label>
															<div class="col-sm-10">
																<input type="text" name="our_net_state" id="demo-hor-1" placeholder="<?php echo translate('state_name');?>" class="form-control">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
															<div class="col-sm-10">
																<input type="text" name="our_net_title" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('our_net_address');?></label>
															<div class="col-sm-10">
																<textarea rows="9"  class="textareas" style="height:100px" name="our_net_address"></textarea>
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('contact_number');?></label>
															<div class="col-sm-10">
																<input type="text" name="our_net_contact" id="demo-hor-1" placeholder="<?php echo translate('contact_number');?>" class="form-control">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('gmap_iframe_link');?></label>
															<div class="col-sm-10">
																<textarea rows="9"  class="textareas" style="height:100px" name="our_net_map"></textarea>
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('our_network_add','<?php echo translate('our_network_has_been_added!'); ?>','manage_website/our_network');"><?php echo translate('submit');?></span>
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
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>