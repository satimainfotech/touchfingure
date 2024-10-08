<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_area');?></h1>
		<?php
			if(@$country != '' || @$state != '' || @$district != '' || @$city != '' || @$area != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//master_manage/area?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&d_i=<?php echo @$district; ?>&ct_i=<?php echo @$city; ?>&a_n=<?php echo @$area; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin//master_manage/area?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&d_i=<?php echo @$district; ?>&ct_i=<?php echo @$city; ?>&a_n=<?php echo @$area; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="page_return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//master_manage/area<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin//master_manage/area<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="page_return_url">
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							foreach($area_data as $row){
							echo form_open(base_url() . 'admin//master_manage/area_update/'. $row['area_id'], array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'area_edit',
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
														<label class="col-sm-3 control-label" for="demo-hor-2"><?php echo translate('taluka_m');?></label>
														<div class="col-sm-9">
														
														<select name="taluka_m" class="demo-chosen-select" data-placeholder="Choose a Taluka_m" id="taluka_m" onchange="select_country(this.value)">
																<option value="">Choose one</option>
																<?php foreach($taluka_m_data as $t_row){ 
																if($t_row['taluka_m_id'] == $row['taluka_m_id']){
																		$selected = "selected='selected'";
																	}else{
																		$selected = "";
																	}
																?>
																	<option value="<?php echo $t_row['taluka_m_id']; ?>" <?php echo $selected; ?> ><?php echo $t_row['taluka_m_name']; ?></option>
																<?php } ?>
															</select>
															
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label paddingfive" for="demo-hor-1"><?php echo translate('area_name');?></label>
														<div class="col-sm-9 paddingfive">
															<input type="text" name="area_name" id="demo-hor-1" placeholder="<?php echo translate('area_name');?>" class="form-control required" value="<?php echo $row['area_name'];?>">
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="master_manage_submit('area_edit','<?php echo translate('area_successfully_updated!'); ?>');" ><?php echo translate('submit');?></span>
									</div>
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
	var selected_country = '<?php echo $area_data[0]["country_id"]; ?>';
	var selected_state = '<?php echo $area_data[0]["state_id"]; ?>';
	var selected_district = '<?php echo $area_data[0]["district_id"]; ?>';
	var selected_city = '<?php echo $area_data[0]["city_id"]; ?>';
	
	$(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
		if(selected_country != ''){
			select_country(selected_country);
			$("#country").val(selected_country).trigger("chosen:updated");
		}
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
						select_state(selected_state);
					}
				}
			});
		}
	}
	
	function select_state(state_id){
		var base_url = $('#base_url').val();
		var country_id = $('#country').val();
		if(state_id == ''){
			
		}else{
			$.ajax({
				url : base_url+'master_manage/get_district_data',
				type: 'POST',
				dataType: 'html',
				data: {country_id:country_id,state_id:state_id},
				success: function(data){
					if(data != ''){
						$('#district_data').html(data);
						if($.trim(selected_district) != ''){
							$("#district").val(selected_district).trigger("chosen:updated");
						}
						select_district(selected_district);
					}
				}
			});
		}
	}
	
	function select_district(district_id){
		var base_url = $('#base_url').val();
		var country_id = $('#country').val();
		var state_id = $('#state').val();
		if(district_id == ''){
			
		}else{
			$.ajax({
				url : base_url+'master_manage/get_city_data',
				type: 'POST',
				dataType: 'html',
				data: {country_id:country_id,state_id:state_id,district_id:district_id},
				success: function(data){
					if(data != ''){
						$('#city_data').html(data);
						if($.trim(selected_city) != ''){
							$("#city").val(selected_city).trigger("chosen:updated");
						}
					}
				}
			});
		}
	}
</script>