<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('create_new_state');?></h1>
		<?php
			if(@$country != '' || @$state != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//master_manage/state?c_i=<?php echo @$country; ?>&s_n=<?php echo @$state; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin//master_manage/state?c_i=<?php echo @$country; ?>&s_n=<?php echo @$state; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="page_return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//master_manage/state<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin//master_manage/state<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="page_return_url">
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							echo form_open(base_url() . 'admin//master_manage/state_added/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'state_add',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="vendor_details" class="tab-pane fade active in">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingfive">
													<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('country');?></label>
														<div class="col-sm-10">
															<select name="country" class="demo-chosen-select" data-placeholder="Choose a Country" id="country">
																<option value="">Choose one</option>
																<?php foreach($country_data as $c_row){ 
																?>
																	<option value="<?php echo $c_row['country_id']; ?>" ><?php echo $c_row['country_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label paddingfive" for="demo-hor-1"><?php echo translate('name');?></label>
														<div class="col-sm-10 paddingfive">
															<input type="text" name="state_name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required">
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
									<div>
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " onclick="form_reset(); "><?php echo translate('reset');?>
										</span>
									</div>
									<div class="col-md-10">
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="master_manage_submit('state_add','<?php echo translate('state_successfully_created!'); ?>');" ><?php echo translate('submit');?></span>
									</div>
								</div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>    
<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	$(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });
</script>