<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('create_new_district_M');?></h1>
		<?php
			if(@$country != '' || @$state != '' || @$district != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_m?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&c_n=<?php echo @$district; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/master_manage/district_m?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&c_n=<?php echo @$district; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="page_return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_m<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/master_manage/district_m<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="page_return_url">
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							echo form_open(base_url() . 'admin/abdaily/master_manage/district_m_added/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'district_add',
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
														<label class="col-sm-3 control-label" for="demo-hor-2"><?php echo translate('division');?></label>
														<div class="col-sm-9">
															<select name="division" class="demo-chosen-select" data-placeholder="Choose a Division" id="division" >
																<option value="">Choose one</option>
																<?php foreach($division_data as $d_row){ 
																?>
																	<option value="<?php echo $d_row['division_id']; ?>" ><?php echo $d_row['division_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-3 control-label paddingfive" for="demo-hor-1"><?php echo translate('district_m_name');?></label>
														<div class="col-sm-9 paddingfive">
															<input type="text" name="district_name" id="demo-hor-1" placeholder="<?php echo translate('district_name');?>" class="form-control required">
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="master_manage_submit('district_add','<?php echo translate('district_successfully_created!'); ?>');" ><?php echo translate('submit');?></span>
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
	function other(){
	    set_select();
    }
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	$(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });
	
	function select_country(country_id){
		var base_url = $('#base_url').val();
		if(country_id == ''){
			
		}else{
			$.ajax({
				url : base_url+'master_manage/get_state_data',
				type: 'POST',
				dataType: 'html',
				data: {country_id:country_id},
				success: function(data){
					if(data != ''){
						$('#state_data').html(data);
						if($.trim(selected_state) != ''){
							$("#state").val(selected_state).trigger("chosen:updated");
						}
					}
				}
			});
		}
	}
</script>