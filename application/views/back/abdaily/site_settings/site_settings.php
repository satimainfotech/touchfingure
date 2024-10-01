<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow custompagetitle"><?php echo translate('site_settings');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
			<div class="row">
				<div class="col-md-12">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 customtabview">
						<ul class="nav nav-tabs">
							<li class="active">
								<a data-toggle="tab" href="#demo-stk-lft-tab-1"><?php echo translate('general_settings');?></a>
							</li>
							<li>
								<a data-toggle="tab" href="#demo-stk-lft-tab-5"><?php echo translate('smtp_settings');?></a>
							</li>
						</ul>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 customtabcontentview">
						<div class="tab-content">
							<div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"><?php echo translate('general_settings');?></h3>
									</div>
									<?php
										echo form_open(base_url() . 'admin/site_settings/general_settings/set/', array(
											'class' => 'form-horizontal',
											'method' => 'post',
											'id' => 'gen_set',
											'enctype' => 'multipart/form-data'
										));
									?>
										<div class="panel-body">
											<div class="form-group">
												<label class="col-sm-3 control-label"><?php echo translate('system_name');?></label>
												<div class="col-sm-6">
													<input type="text" name="system_name" value="<?php echo $this->crud_model->get_type_name_by_id('general_settings','1','value'); ?>"  class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" ><?php echo translate('system_email');?></label>
												<div class="col-sm-6">
													<input type="text" name="system_email" value="<?php echo $this->crud_model->get_type_name_by_id('general_settings','2','value'); ?>"  class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" ><?php echo translate('system_title');?></label>
												<div class="col-sm-6">
													<input type="text" name="system_title" value="<?php echo $this->crud_model->get_type_name_by_id('general_settings','3','value'); ?>" class="form-control">
												</div>
											</div>
											<input type="hidden" id="nowslide">
										</div>
										<div class="panel-footer text-right">
											<span class="btn btn-success btn-labeled fa fa-check submitter enterer" type="submit"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
												<?php echo translate('save');?>
											</span>
										</div>
									</form>
								</div>
							</div>
							<span id="genset"></span>
							<!-- SMTP SETTINGS -->
							<div id="demo-stk-lft-tab-5" class="tab-pane fade <?php if($tab_name=="smtp_settings") {?>active in<?php } ?>">
								<div class="panel">
									<div class="panel-heading">
										<h3 class="panel-title"><?php echo translate('smtp_settings');?></h3>
									</div>
									<?php
										echo form_open(base_url(). 'admin/site_settings/smtp_settings/set/', array(
											'class' => 'form-horizontal',
											'method' => 'post',
											'id' => '',
											'enctype' => 'multipart/form-data'
										));
									?>
										<div class="panel-body">
											<!-- Smtp Host  -->
											<div class="form-group">
												<label class="col-sm-3 control-label" >
													<?php echo translate('smtp_status');?>
												</label>
												<div class="col-sm-6">
													<input id="mail_status" class='sw4' data-set='mail_status' type="checkbox" <?php if($this->crud_model->get_settings_value('general_settings','mail_status','value') == 'smtp'){ ?>checked<?php } ?> />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">
													<?php echo translate('smtp_host');?>
												</label>
												<div class="col-sm-6">
													<input type="text" name="smtp_host" class="form-control"
														value="<?php echo $this->crud_model->get_settings_value('general_settings','smtp_host','value');?>">
												</div>
											</div>
											<!-- Smtp Port  -->
											<div class="form-group">
												<label class="col-sm-3 control-label">
													<?php echo translate('smtp_port');?>
												</label>
												<div class="col-sm-6">
													<input type="text" name="smtp_port" class="form-control"
														value="<?php echo $this->crud_model->get_settings_value('general_settings','smtp_port','value');?>">
												</div>
											</div>
											<!-- Smtp User  -->
											<div class="form-group">
												<label class="col-sm-3 control-label">
													<?php echo translate('smtp_user');?>
												</label>
												<div class="col-sm-6">
													<input type="text" name="smtp_user" class="form-control"
														value="<?php echo $this->crud_model->get_settings_value('general_settings','smtp_user','value');?>">
												</div>
											</div>
											<!-- Smtp Password  -->
											<div class="form-group">
												<label class="col-sm-3 control-label">
													<?php echo translate('smtp_password');?>
												</label>
												<div class="col-sm-6">
													<input type="password" name="smtp_pass" class="form-control" value="<?php echo $this->crud_model->get_settings_value('general_settings','smtp_pass','value');?>" >
												</div>
											</div>
										</div>
										<!--SAVE---------->
										<div class="panel-footer text-right">
											<span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
												<?php echo translate('save');?>
											</span>
										</div>
									</form>
								</div>
							</div>
							<!-- SMTP SETTINGS ENDS -->
							
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<script>
    function load_logos(){
        ajax_load('<?php echo base_url(); ?>admin/logo_settings/show_all','list','');
    }
$(document).ready(function() {
        $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
            now.summernote({
                height: h,
                onChange: function() {
                    now.closest('div').find('.val').val(now.code());
                }
            });
			now.closest('div').find('.val').val(now.code());
			now.focus();
        });
    });

    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'logo_settings';
    var list_cont_func = 'show_all';
    var dlt_cont_func = 'delete_logo';

$(document).ready(function() {
	$('.demo-chosen-select').chosen();
	$('.demo-cs-multiselect').chosen({width:'100%'});
});


$(document).ready(function() {
	$("form").submit(function(e){
		return false;
	});

});

</script>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>
