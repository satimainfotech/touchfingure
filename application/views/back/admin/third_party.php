<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow custompagetitle"><?php echo translate('third_party_setting');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
			<div class="row">
				<div class="col-md-12">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 customtabview">
						<ul class="nav nav-tabs">
							<?php if($this->crud_model->admin_permission('google_map')){ ?>
								<li class="active">
									<a data-toggle="tab" href="#demo-stk-lft-tab-4"><?php echo translate('google_map');?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 customtabcontentview">
						<div class="tab-content">
							<?php if($this->crud_model->admin_permission('google_map')){ ?>
								<div id="demo-stk-lft-tab-4" class="tab-pane fade active in">
									<div class="panel">
									<?php 
										$api_key = $this->db->get_where('general_settings',array('type'=>'google_api_key'))->row()->value;
									?>
										<?php
											echo form_open(base_url() . 'admin/third_party/google_api_key/', array(
												'class' => 'form-horizontal',
												'method' => 'post',
												'id' => '',
												'enctype' => 'multipart/form-data'
											));
										?>
											<div class="panel-heading margin-bottom-15">
												<h3 class="panel-title"><?php echo translate('google_map_api_settings');?></h3>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="demo-hor-inputkey">
													<?php echo translate('api_key');?>
												</label>
												<div class="col-sm-8">
													<div class="col-sm-8">
														<div class="col-sm-">
															<input type="text" name="api_key" value="<?php echo $api_key; ?>" class="form-control" >
														</div>
													</div>
												</div>
											</div>
											<br />
											<div class="panel-footer text-left">
												<span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
													<?php echo translate('save');?>
												</span>
											</div>
										</form> 
									</div>                
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin/third_party';
    var module = 'general_settings';
    var list_cont_func = '';
    var dlt_cont_func = '';

$(document).ready(function() {
	$('.demo-chosen-select').chosen();
	$('.demo-cs-multiselect').chosen({
		width: '100%'
	});
	set_summer();
});

function set_summer(){
	$('.summernotes').each(function() {
		var now = $(this);
		var h = now.data('height');
		var n = now.data('name');
		if(now.closest('div').find('.val').length == 0){
			now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
		}
		now.summernote({
			height: h,
			onChange: function() {
				now.closest('div').find('.val').val(now.code());
			}
		});
		now.closest('div').find('.val').val(now.code());
	});
}

$(document).ready(function() {
	$("form").submit(function(e){
		return false;
	});

});
</script>