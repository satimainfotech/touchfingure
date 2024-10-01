	<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_agent');?></h1>
		<?php if(@$agent != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/agent?b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/agent?b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/agent<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/agent<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($agent_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/agent/agent_update/' . $row['agent_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'agent_edit',
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
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent name');?></label>
																<div class="col-sm-10">
																	<input type="text" name="agent_name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['agent_name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent mobile');?></label>
																<div class="col-sm-10">
																	<input type="text" name="agent_mobile" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['agent_mobile']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent email');?></label>
																<div class="col-sm-10">
																	<input type="text" name="agent_email" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['agent_email']; ?>">
																</div>
															</div>
															<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent Address');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="agent_address" id="demo-hor-1" placeholder="<?php echo translate('agent_address');?>" class="form-control required"><?php echo $row['agent_address']; ?></textarea>
															</div>
														</div>
															<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent code');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="agent_code" id="demo-hor-1" placeholder="<?php echo translate('agent_code');?>" class="form-control required"><?php echo $row['agent_code']; ?></textarea>
															</div>
														</div>
															<div class="form-group " style="display:none;">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent intrest rate');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="agent_intrest_rate" id="demo-hor-1" placeholder="<?php echo translate('agent_intrest_rate');?>" class="form-control "><?php echo $row['agent_intrest_rate']; ?></textarea>
															</div>
														</div >
														
															<div class="form-group" style="display:none">
																<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Bank branch');?></label>
																<div class="col-sm-10">
																	<select name="bank_id" class="demo-chosen-select" data-placeholder="Choose a branch" id="bank_id" >
																		<option value="">Choose Branch</option>
																		<?php foreach($bank_data as $b_row){ 
																			if($b_row['bank_id'] == $row['bank_id']){
																				$selected = "selected='selected'";
																			}else{
																				$selected = "";
																			}
																		?>
																			<option value="<?php echo $b_row['bank_id']; ?>" <?php echo $selected; ?>><?php echo $b_row['bank_name']; ?>-<?php echo $b_row['branch_name']; ?>- <?php echo $b_row['ifsc_code']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
															
																	<div class="col-sm-12 paddingzeroall" id="new_options">
																	<?php $i=1;foreach($agent_prodcut_data as $ag_prod){?>
															
															
															
																<div class="col-sm-12 paddingzeroall pb-5" id="options<?php echo $i;?>" style="float: left;width: 100%;">
																	<input type="hidden" id="new_option_new_idss" value="<?php echo $i;?>">
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('product');?></label>
																			<select name="product[]" class="demo-chosen-select required" data-placeholder="Choose a Product" id="title_1" >
																			<option value="">Choose any product </option>
																			<?php foreach($products_data as $p_row){ 
																			 ?>
																			<option <?php if($p_row['products_id'] == $ag_prod['product_id']){?> selected <?php }else{ }?>} value="<?php echo $p_row['products_id']; ?>-<?php echo $p_row['products_name']; ?>" ><?php echo $p_row['products_name']; ?></option>
																			<?php } ?>
																			</select>
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('intrest rate');?></label>
																		<input value="<?php echo $ag_prod['intrest_rate'];?>" type="text" name="intrest_rate[]" id="demo-hor-1" placeholder="<?php echo translate('intrest rate');?>" class="form-control required">
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('Days');?></label>
																		<input value="<?php echo $ag_prod['days'];?>" type="text" name="days[]" id="demo-hor-1" placeholder="<?php echo translate('intrest rate');?>" class="form-control required">
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('Due Date Intrest');?></label>
																		<input value="<?php echo $ag_prod['due_date_intrest_rate'];?>" type="text" name="due_intrest[]" id="demo-hor-1" placeholder="<?php echo translate('Due Date Intrest Rate');?>" class="form-control required">
																	</div>
																	
																	<div class='col-sm-2 col-xs-4'><span class='remove_button' onclick='remove_new_options(<?php echo $i;?>);'><i class='fa fa-minus'></i></span></div>	
																</div>
															
															<?php $i++;}?>
															</div>
															
														<div class="form-group">
															<div class="col-sm-12 col-xs-12 paddingzeroall">
															
																<input type="hidden" id="added_new_option_ids" name="added_new_option_ids" value="<?php echo $i;?>">
																<input type="hidden" id="added_total_new_options" name="added_total_new_options" value="<?php echo $i;?>">
															</div>
															<div class="col-sm-12 paddingzeroall" id="new_options">
																<div class="col-sm-12 paddingzeroall pb-5" id="options<?php echo $i+1; ?>" style="float: left;width: 100%;">
																	<input type="hidden" id="new_option_new_idss" value="<?php echo $i+1; ?>">
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('product');?></label>
																			<select name="product[]" class="demo-chosen-select " data-placeholder="Choose a Product" id="title_1" >
																			<option value="">Choose any product </option>
																			<?php foreach($products_data as $p_row){ 
																			?>
																			<option value="<?php echo $p_row['products_id']; ?>" ><?php echo $p_row['products_name']; ?></option>
																			<?php } ?>
																			</select>
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('intrest rate');?></label>
																		<input value="0" type="text" name="intrest_rate[]" id="demo-hor-1" placeholder="<?php echo translate('intrest rate');?>" class="form-control ">
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('Days');?></label>
																		<input value="1" type="text" name="days[]" id="demo-hor-1" placeholder="<?php echo translate('intrest rate');?>" class="form-control ">
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('Due Date Intrest');?></label>
																		<input value="0" type="text" name="due_intrest[]" id="demo-hor-1" placeholder="<?php echo translate('Due Date Intrest Rate');?>" class="form-control ">
																	</div>
																	
																	<div class="col-sm-2 col-xs-2">
																		<span class="add_new_button" onclick="open_new_options();"><i class="fa fa-plus"></i></span>
																	</div>	
																</div>
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
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('agent_edit','<?php echo translate('successfully_edited!'); ?>','agent');" ><?php echo translate('update');?></span> 
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
<script>

	
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
	

	
	function open_new_options(){
		var added_row_id = $('#added_new_option_ids').val();
		var added_total_new_option = $('#added_total_new_options').val();
		var new_row_id = parseInt(added_total_new_option)+1;
		$('#new_options').append("<div class='col-sm-12 paddingzeroall pb-5' id='options"+new_row_id+"' style='float: left;width: 100%;'><input type='hidden' id='new_option_new_idss' value='"+new_row_id+"'><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('product');?></label><select name='product[]' class='demo-chosen-select required' data-placeholder='Choose a Products' id='title_'"+new_row_id+"'><option value=''>Choose any product </option><?php foreach($products_data as $p_row){?><option value='<?php echo $p_row['products_id']; ?>'><?php echo $p_row['products_name']; ?></option><?php } ?></select></div><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('intrest_rate');?></label><input type='text' name='intrest_rate[]' value='0' id='demo-hor-1' placeholder='<?php echo translate('intrest_rate');?>' class='form-control required'></div><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('Days');?></label><input value='1'  type='text' name='days[]' id='demo-hor-1' placeholder='<?php echo translate('intrest rate');?>' class='form-control required'></div><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('Due Date Intrest');?></label><input value='0'  type='text' name='due_intrest[]' id='demo-hor-1' placeholder='<?php echo translate('Due Date Intrest Rate');?>' class='form-control required'></div><div class='col-sm-2 col-xs-4'><span class='remove_button' onclick='remove_new_options("+new_row_id+");'><i class='fa fa-minus'></i></span></div></div>");
		$('#added_total_new_options').val(new_row_id);
		
		
		
		var selected = new Array();
		$('#new_options #new_option_new_idss').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_ids').val(selected.join(','));
		$('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
	}
	
	function remove_new_options(remove_id){
		var added_new_option_id = $('#options'+remove_id).remove();
		var selected = new Array();
		$('#new_options #new_option_new_idss').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_ids').val(selected.join(','));
	}

</script>